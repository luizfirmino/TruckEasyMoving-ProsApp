<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Order;
use App\OrderAddresses;

class AddressController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.orders.address.create');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($orderId, $addressId)
    {
        $address = OrderAddresses::GetOrderAddress($orderId, $addressId);
        return view('admin.orders.address.edit', compact('address'));   
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $orderId)
    {
        
        $request->validate([
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'zipcode'=>'required',
            'order'=>'required'
        ]);
        
        $address = new OrderAddresses([
            'orderId' => $orderId,
            'address' => $request->get('address'),
            'addressComp' => $request->get('addressComp'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zipcode' => $request->get('zipcode'),
            'order' => $request->get('order'),
            'notes' => $request->get('notes')
        ]);
        $address->save();
        return redirect('admin/orders/'.$orderId.'/edit')->with('success', 'Address saved!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $orderId, $addressId)
    {
        $request->validate([
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'zipcode'=>'required',
            'order'=>'required'
        ]);

        $address = OrderAddresses::find($addressId);
        $address->address =  $request->get('address');
        $address->addressComp = $request->get('addressComp');
        $address->city = $request->get('city');
        $address->state = $request->get('state');
        $address->zipCode = $request->get('zipcode');
        $address->order = $request->get('order');
        $address->notes = $request->get('notes');
        
        $address->save();
        
        return redirect('admin/orders/'.$orderId.'/edit')->with('success', 'Address deleted!');   
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        OrderAddresses::DeleteOrderAddress($request->get('orderId'), $request->get('addressId'));
        return redirect('admin/orders/'.$id.'/edit')->with('success', 'Address deleted!');   
    }

}
