<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Equipments;

class EquipmentController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipments = Equipments::paginate(10);

        return view('admin.equipments.index', compact('equipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.equipments.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'qtd'=>'required',
            'value'=>'required'
        ]);
        
        $equipment = new Equipments([
            'name' => $request->get('name'),
            'qtd' => $request->get('qtd'),
            'value' => $request->get('value')
        ]);
        $equipment->save();
        
        return redirect('admin/equipments/')->with('success', 'Equipment saved!');
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipment = Equipments::find($id);
        return view('admin.equipments.edit', compact('equipment'));
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
            'name'=>'required',
            'qtd'=>'required',
            'value'=>'required'
        ]);

        $equipment = Equipments::find($id);
        $equipment->name =  $request->get('name');
        $equipment->qtd = $request->get('qtd');
        $equipment->value = $request->get('value');
        $equipment->address = $request->get('address');
        $equipment->addressComp = $request->get('addressComp');
        $equipment->city = $request->get('city');
        $equipment->state = $request->get('state');
        $equipment->zipCode = $request->get('zipcode');
        $equipment->save();

        return redirect('/admin/equipments')->with('success', 'Equipment updated!');
    }
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipment = Equipments::find($id);
        $equipment->delete();
        return redirect('admin/equipments/')->with('success', 'Equipment deleted!');
    }
}
