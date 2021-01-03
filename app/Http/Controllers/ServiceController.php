<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services;
use App\Combos;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Services::paginate(10);

        return view('admin.services.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $comboRoles = Combos::GetRoles();
        return view('admin.services.create', ['comboRoles' => $comboRoles]);
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
            'service'=>'required',
            'hourRate'=>'required',
            'minimumHours'=>'required',
            'minuteIncrements'=>'required',
            'description'=>'required',
            'roles'=>'required'
        ]);

        $data = new Services([
            'service' => $request->get('service'),
            'minimumHours' => $request->get('minimumHours'),
            'minuteIncrements' => $request->get('minuteIncrements'),
            'hourRate' => $request->get('hourRate'),
            'description' => $request->get('description'),
            'preparation' => $request->get('preparation')
        ]);
        $data->save();
                
        //Roles
        if (!empty($request->get('roles'))){
            for ($i=0; $i < count($request->get('roles')); $i++){
                Services::InsertServiceRoles($data->orderServiceId, $request->get('roles')[$i], ($i+1));
            }
        }
        
        return redirect('admin/services/')->with('success', 'Service saved!');
        
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
        $data = Services::find($id);
        $comboRoles = Combos::GetRoles();
        $serviceRoles = Services::GetServiceRoles($data->orderServiceId);
        
        return view('admin.services.edit', ['data' => $data, 'comboRoles' => $comboRoles, 'serviceRoles' => $serviceRoles]);
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
            'service'=>'required',
            'hourRate'=>'required',
            'minimumHours'=>'required',
            'minuteIncrements'=>'required',
            'active'=>'required',
            'description'=>'required',
            'roles'=>'required'
        ]);

        $data = Services::find($id);
        $data->service =  $request->get('service');
        $data->hourRate = $request->get('hourRate');
        $data->minimumHours = $request->get('minimumHours');
        $data->minuteIncrements = $request->get('minuteIncrements');
        $data->active = $request->get('active');
        $data->description = $request->get('description');
        $data->preparation = $request->get('preparation');
        $data->save();
        
        //Roles
        Services::DeleteServiceRoles($data->orderServiceId);
        for ($i=0; $i < count($request->get('roles')); $i++){
            Services::InsertServiceRoles($data->orderServiceId, $request->get('roles')[$i], ($i+1));
        }

        return redirect('/admin/services')->with('success', 'Service updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Services::find($id);
        $data->active = 0;
        $data->save();

        return redirect('/admin/services')->with('success', 'Service desactived!');
    }
}
