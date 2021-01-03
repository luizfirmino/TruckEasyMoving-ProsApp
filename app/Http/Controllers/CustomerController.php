<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customers;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customers::GetCustomers($request);
        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'firstName'=>'required',
            'phoneNumber'=>'required'
        ]);

        $customer = new Customers([
            'firstName' => $request->get('firstName'),
            'lastName' => $request->get('lastName'),
            'email' => $request->get('email'),
            'phoneNumber' => $request->get('phoneNumber'),
            'address' => $request->get('address'),
            'addressComp' => $request->get('addressComp'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zipcode' => $request->get('zipcode')
        ]);
        $customer->save();
        return redirect('admin/customers/')->with('success', 'Customer saved!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customers::find($id);
        return view('admin.customers.edit', compact('customer'));   
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
            'firstName'=>'required',
            'phoneNumber'=>'required'
        ]);

        $customer = Customers::find($id);
        $customer->firstName =  $request->get('firstName');
        $customer->lastName = $request->get('lastName');
        $customer->email = $request->get('email');
        $customer->phoneNumber = $request->get('phoneNumber');
        $customer->address = $request->get('address');
        $customer->addressComp = $request->get('addressComp');
        $customer->city = $request->get('city');
        $customer->state = $request->get('state');
        $customer->zipCode = $request->get('zipcode');
        $customer->save();

        return redirect('/admin/customers')->with('success', 'Customer updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customers::find($id);
        $customer->delete();

        return redirect('/admin/customers')->with('success', 'Customer deleted!');
    }
}
