<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Resources;
use App\Combos;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Resources::paginate(10);

        return view('admin.resources.index', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $comboRoles = Combos::GetRoles();
        $comboUsers = Combos::GetUsers();
        return view('admin.resources.create',compact('comboUsers', $comboUsers, 'comboRoles', $comboRoles));
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

        $resource = new Resources([
            'firstName' => $request->get('firstName'),
            'lastName' => $request->get('lastName'),
            'email' => $request->get('email'),
            'phoneNumber' => $request->get('phoneNumber'),
            'address' => $request->get('address'),
            'addressComp' => $request->get('addressComp'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zipcode' => $request->get('zipcode'),
            'contractNumber' => $request->get('contractNumber'),
            'active' => 1
        ]);
        $resource->save();
        
        //Roles
        if (!empty($request->get('roles'))){
            for ($i=0; $i < count($request->get('roles')); $i++){
                Resources::InsertResourceRoles($resource->resourceId, $request->get('roles')[$i]);
            }
        }
        
        return redirect('admin/resources/')->with('success', 'Resource saved!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resource = Resources::find($id);
        $resourceRoles = Resources::getResourceRoles($id);
        
        $comboUsers = Combos::GetUsers();
        $comboRoles = Combos::GetRoles();
                
        return view('admin.resources.edit', ['resource' => $resource, 'comboUsers' => $comboUsers, 'comboRoles' => $comboRoles, 'resourceRoles' => $resourceRoles]);
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

        $resource = Resources::find($id);
        $resource->firstName =  $request->get('firstName');
        $resource->lastName = $request->get('lastName');
        $resource->email = $request->get('email');
        $resource->phoneNumber = $request->get('phoneNumber');
        $resource->address = $request->get('address');
        $resource->addressComp = $request->get('addressComp');
        $resource->city = $request->get('city');
        $resource->state = $request->get('state');
        $resource->zipCode = $request->get('zipcode');
        $resource->contractNumber = $request->get('contractNumber');
        $resource->userId = $request->get('userId');
        $resource->active = $request->get('active');;
        $resource->save();
        
        //Roles
        if (!empty($request->get('roles'))){
            Resources::DeleteResourceRoles($id);
            for ($i=0; $i < count($request->get('roles')); $i++){
                Resources::InsertResourceRoles($id, $request->get('roles')[$i]);
            }
        }

        
        return redirect('/admin/resources')->with('success', 'Resource updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resource = Resources::find($id);
        $resource->active = 0;
        $resource->save();

        return redirect('/admin/resources')->with('success', 'Resource deactivated!');
    }
}
