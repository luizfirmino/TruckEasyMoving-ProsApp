<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Orders;
use App\Customers;
use App\Combos;
use App\OrderResources;
use App\OrderAddresses;
use App\OrderRevenue;
use App\OrderBilling;
use App\OrderFiles;
use App\OrderEquipments;
use App\Replacements;
use App\EmailNotification;
use App\SMSNotification;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Orders::GetOrders($request);
        $comboStatus = Combos::GetStatus();
        $comboServices = Combos::GetServices();
        return view('admin.orders.index', compact('orders',$orders,'comboStatus',$comboStatus,'comboServices',$comboServices));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comboStatus = Combos::GetStatus();
        $comboServices = Combos::GetServices();
        $comboSources = Combos::GetSources();
        $comboCustomers = Combos::GetCustomers();
        return view('admin.orders.create',compact('comboStatus',$comboStatus,'comboServices',$comboServices,'comboSources',$comboSources,'comboCustomers',$comboCustomers));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if($request->get('customerId') == ""){
        
            Validator::make($request->all(), [
                'dateSchedule'=>'required',
                'timeSchedule'=>'required',
                'customer_firstName'=>'required',
                'customer_phoneNumber'=>'required'
            ])->validate();
        
        } else {
            
             Validator::make($request->all(), [
                'dateSchedule'=>'required',
                'timeSchedule'=>'required'            
             ])->validate();
            
        }
        
        // Add CUSTOMER
        if($request->get('customerId') == ""){
            $customer = new Customers([
                'firstName' => $request->get('customer_firstName'),
                'lastName' => $request->get('customer_lastName'),
                'email' => $request->get('customer_email'),
                'phoneNumber' => $request->get('customer_phoneNumber')
            ]);
            $customer->save();
            $customerId = $customer->customerId;
        
        } else { $customerId = $request->get('customerId'); }
        
        // Add Order
        $order = new Orders([
            'orderStatusId' => $request->get('orderStatusId'),
            'customerId' => $customerId,
            'orderServiceId' => $request->get('orderServiceId'),
            'orderSourceId' => $request->get('orderSourceId'),
            'dateSchedule' => $request->get('dateSchedule'),
            'notes' => $request->get('notes'),
            'duration' => $request->get('duration'),
            'timeSchedule' => $request->get('timeSchedule')
        ]);
        $order->save();
        
        SMSNotification::checkSendNotification($order->orderId, $order->orderStatusId);
        if (!(empty($request->get('customer_email')))) {
            EmailNotification::checkSendNotification($order->orderId, $order->orderStatusId);
        }
        
        return redirect('admin/orders/' . $order->orderId . '/edit')->with('success', 'Order created!');
    }
    
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function processPayment(Request $request, $id)
    {
        $result = Orders::ProcessPayment($id, $request->get('payment'), $request->get('tip'), $request->get('duration'), $request->get('checkoutId'), $request->get('checkoutService'));
        if ($result[0]->code == 0){
            EmailNotification::checkSendNotification($id, Orders::orderStatusId_PAID);
            return redirect('admin/orders/' . $id . '/edit')->with('success', $result[0]->message);
        }
        else {
            return redirect('admin/orders/' . $id . '/payment')->with('error', $result[0]->message);
        }
            
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function payment($id)
    {
        $order = Orders::find($id);
        $orderBilling = OrderBilling::find($id);
        return view('admin.orders.payment', compact('orderBilling', $orderBilling, 'order', $order));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Orders::GetOrder($id);
                
        // Combos
        $comboStatus            = Combos::GetStatus();
        $comboServices          = Combos::GetServices();
        $comboSources           = Combos::GetSources();
        $comboCustomers         = Combos::GetCustomers();
        $comboResources         = Combos::GetResources();
        $comboRoles             = Combos::GetRoles();
        $comboRevenueCategories = Combos::GetRevenueCategories(2);
        $comboEquipments        = Combos::GetEquipments();
        $orderResources         = OrderResources::GetOrderResources($order->orderId);
        $orderAddresses         = OrderAddresses::GetOrderAddresses($order->orderId);
        $orderRevenues          = OrderRevenue::GetOrderRevenues($order->orderId);
        $orderFiles             = OrderFiles::where('orderId', $id)->get();
        $orderEquipments        = OrderEquipments::GetOrderEquipments($order->orderId);
        
        return view('admin.orders.edit', compact('order',$order,'comboStatus',$comboStatus,'comboServices',$comboServices,'comboSources',$comboSources,'comboCustomers',$comboCustomers,'comboResources',$comboResources,'comboRoles',$comboRoles,'orderResources',$orderResources,'orderAddresses',$orderAddresses,'orderRevenues',$orderRevenues,'comboRevenueCategories',$comboRevenueCategories, 'orderFiles', $orderFiles, 'comboEquipments', $comboEquipments, $orderEquipments,'orderEquipments')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'dateSchedule'=>'required',
            'timeSchedule'=>'required'
        ]);
        
        $order = Orders::find($id);
        $order->orderStatusId =  $request->get('orderStatusId');
        $order->customerId = $request->get('customerId');
        $order->orderServiceId = $request->get('orderServiceId');
        $order->orderSourceId = $request->get('orderSourceId');
        $order->dateSchedule = $request->get('dateSchedule');
        $order->duration = $request->get('duration');
        $order->timeSchedule = $request->get('timeSchedule');
        $order->notes = $request->get('notes');
        $order->save();
        
        // IF cancelling the whole order
        if ($order->orderStatusId == Orders::orderStatusId_CANCELLED){
            
            // Search for replacements active
            $replacementsActive = Replacements::where('orderId', $id)->where('active', 1)->get();
            
            if(!empty($replacementsActive)){ 
                
                // Desactivated all active replacements
                foreach($replacementsActive as $replacement){
                    $replacementTemp = Replacements::find($replacement->replacementId);
                    $replacementTemp->active = 0;
                    $replacementTemp->save();
                    Replacements::desactivateReplacementResources($replacement->replacementId);
                }
            }
            
        }

        EmailNotification::checkSendNotification($order->orderId, $order->orderStatusId);
        SMSNotification::checkSendNotification($order->orderId, $order->orderStatusId);
        
        return redirect('admin/orders/' . $id . '/edit')->with('success', 'Order updated!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
