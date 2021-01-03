<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Combos;
use App\OrderResources;
use App\Bookings;

use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if (!($request->has('q_dateSchedule'))){

            if (empty(session()->get('q_dateSchedule'))){
                $request->request->add(['q_dateSchedule' => date("Y-m-d")]); 
            } else {            
                $request->request->add(['q_dateSchedule' => session()->get('q_dateSchedule')]); 
                $request->session()->forget('q_dateSchedule');
            }
        
        } 
                
        $request->request->add(['q_prevDay' => date('Y-m-d', strtotime("-1 day", strtotime($request->get('q_dateSchedule'))))]); 
        $request->request->add(['q_nextDay' => date('Y-m-d', strtotime("+1 day", strtotime($request->get('q_dateSchedule'))))]); 
        
        $orders = Bookings::where('dateSchedule', '=', $request->get('q_dateSchedule'))->get();
        $ordersToBook = Array();
        
        foreach ($orders as $item) {
            
            $roles = Bookings::GetServiceRoles($item->orderServiceId);
            foreach ($roles as $role) {
                $resources[$role->roleId] = Bookings::GetResourcesByRole($role->roleId);
            }
            $ordersToBook[] = collect([['orderId' => $item->orderId], ['timeSchedule' => $item->timeSchedule], ['roles' => $roles], ['resources' => $resources]]);
            
            // Retrieve the resources already booked for the job
            $orderResources = Bookings::GetOrderResources($item->orderId);
            foreach ($orderResources as $orderResource) {
                $request->merge(['orderId_' . $orderResource->orderId . '_num_' . $orderResource->number . '_roleId_' . $orderResource->roleId . '_resourceId' => $orderResource->resourceId]);
                //print 'orderId_' . $orderResource->orderId . '_num_' . $orderResource->number . '_roleId_' . $orderResource->roleId . '_resourceId => ' . $orderResource->resourceId . "<br>";
            }

        }    
                
        return view('admin.booking.index', ['orders' => $orders, 'ordersToBook' => $ordersToBook]);
    }
    
    

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        for($orderIdx=0; $orderIdx < count($request->get('ordersId')); $orderIdx++){
            
            $orderId = $request->get('ordersId')[$orderIdx];
            
            // Delete all the resources associated to the order
            OrderResources::DeleteOrderResources($orderId);

            foreach($request->all() as $key => $value) {
                
                if (Str::contains($key, 'orderId_' . $orderId . '_num_')){
                    
                    if (!empty($value) ){
                        
                        $roleId = Str::between($key, '_roleId_', '_resourceId');

                        // Add resource
                        $resource = new OrderResources([
                            'orderId' => $orderId,
                            'resourceId' => $value,
                            'roleId' => $roleId
                        ]);
                        $resource->save();
                    }
                }
                
            }
        }
        return redirect()->route('booking.index')->with('q_dateSchedule', $request->get('q_dateSchedule'))->with('success', 'Changes Saved!');

    }
    
}
