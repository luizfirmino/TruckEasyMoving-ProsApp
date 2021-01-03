<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Reports;
use App\Combos;
/*use App\Orders;
use App\Customers;
use App\OrderResources;
use App\OrderAddresses;
use App\OrderRevenue;
use App\EmailNotification;*/
use Illuminate\Support\Facades\Validator;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        return view('admin.reports.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function earningsByOrder(Request $request)
    {
        if(!($request->has("q_month"))){
            $request['q_month'] = date("m");
        }
        
        if(!($request->has("q_year"))){
            $request['q_year'] = date("Y");
        }
        
        $comboYears     = Combos::GetYears();
        $comboMonths    = Combos::GetMonths();
        $results        = Reports::GetEarningsByOrder($request);
        return view('admin.reports.earningsByOrder', compact('results',$results,'comboMonths',$comboMonths,'comboYears',$comboYears));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function accountingGroups(Request $request)
    {
        if(!($request->has("q_month"))){
            $request['q_month'] = date("m");
        }
        
        if(!($request->has("q_year"))){
            $request['q_year'] = date("Y");
        }
        
        $comboYears     = Combos::GetYears();
        $comboMonths    = Combos::GetMonths();
        $results        = Reports::GetAccountingGroups($request);
        return view('admin.reports.accountingGroups', compact('results',$results,'comboMonths',$comboMonths,'comboYears',$comboYears));
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ordersBySource(Request $request)
    {
    
        if(!($request->has("q_year"))){
            $request['q_year'] = date("Y");
        }
        
        $comboYears     = Combos::GetYears();
        $comboMonths    = Combos::GetMonths();
        $results        = Reports::GetOrdersBySource($request);
        return view('admin.reports.ordersBySource', compact('results',$results,'comboMonths',$comboMonths,'comboYears',$comboYears));
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
