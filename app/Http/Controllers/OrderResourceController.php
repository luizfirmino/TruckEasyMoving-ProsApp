<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Combos;
use App\Order;
use App\OrderResources;
use App\Resources;
use App\Replacements;
use App\EmailNotification;

class OrderResourceController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'resourceId'=>'required',
            'roleId'=>'required'
        ]);
        
        $resource = new OrderResources([
            'orderId' => $request->get('orderId'),
            'resourceId' => $request->get('resourceId'),
            'roleId' => $request->get('roleId')
        ]);
        $resource->save();
        
        return redirect('admin/orders/'.$request->get('orderId').'/edit')->with('success', 'Resource saved!');
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
    public function edit($orderId, $resourceId)
    {
        $resource = OrderResources::GetOrderResource($orderId, $resourceId);
        $comboResources = Combos::GetResources();
        $comboRoles = Combos::GetRoles();
        return view('admin.orders.resources.edit', compact('resource', $resource, 'comboResources', $comboResources, 'comboRoles', $comboRoles)); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $orderId, $resourceId)
    {
        $request->validate([
            'resourceId'=>'required',
            'roleId'=>'required'
        ]);

        $resource = OrderResources::GetOrderResource($orderId, $resourceId);
        $resource->orderId =  $orderId;
        $resource->resourceId = $resourceId;
        $resource->roleId = $request->get('roleId');
        $resource->timeStarts = $request->get('timeStarts');
        $resource->timeEnds = $request->get('timeEnds');
        $resource->accepted = $request->get('accepted');
        OrderResources::UpdateOrderResource($resource);
        
        return redirect('admin/orders/'.$orderId.'/edit')->with('success', 'Resource updated!');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        if (empty(Replacements::checkReplacementActiveByOrderResource($request->get('orderId'), $request->get('resourceId')))){
            OrderResources::DeleteOrderResource($request->get('orderId'), $request->get('resourceId'));
            return redirect('admin/orders/'.$request->get('orderId').'/edit')->with('success', 'Resource deleted!');
        } else {
            return redirect('admin/orders/'.$request->get('orderId').'/edit')->with('error', 'There is a replacement active for this resource!');
        }
        
        
    }
}
