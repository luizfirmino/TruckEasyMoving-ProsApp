<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Orders;
use App\Combos;
use App\OrderRevenue;

class OrderRevenueController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'revenueCategoryId'=>'required',
            'value'=>'required'
        ]);
        
        $orderRevenue = new OrderRevenue([
            'revenueCategoryId' => $request->get('revenueCategoryId'),
            'orderId' => $request->get('orderId'),
            'resourceId' => $request->get('resourceId'),
            'date' => now(),
            'value' => $request->get('value')
        ]);
        $orderRevenue->save();
        return redirect('admin/orders/' . $request->get('orderId') . '/edit')->with('success', 'Order saved!');
    }
    
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($orderId, $revenueId)
    {
        $revenue = OrderRevenue::find($revenueId);
        $revenue->delete();
        return redirect('admin/orders/' . $orderId . '/edit')->with('success', 'Order saved!');
    }
}
