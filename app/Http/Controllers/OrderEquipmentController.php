<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Combos;
use App\Order;
use App\OrderEquipments;

class OrderEquipmentController extends Controller
{
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'equipmentId'=>'required'
        ]);
        
        $equipment = new OrderEquipments([
            'orderId' => $id,
            'equipmentId' => $request->get('equipmentId'),
            'notes' => $request->get('notes')
        ]);
        $equipment->save();
        
        return redirect('admin/orders/'.$id.'/edit')->with('success', 'Equipment saved!');
    }
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        OrderEquipments::DeleteOrderEquipment($id, $request->get('equipmentId'));
        return redirect('admin/orders/'.$id.'/edit')->with('success', 'Equipment deleted!');
    }
}
