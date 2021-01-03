<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Revenue;
use App\Combos;

class ExpensesController extends Controller
{
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Revenue::GetAdministrativeExpenses();
        $comboRevenueCategories = Combos::GetRevenueCategories(1);
        return view('admin.expenses.index', compact('expenses', $expenses, 'comboRevenueCategories', $comboRevenueCategories));
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
            'revenueCategoryId'=>'required',
            'date'=>'required',
            'value'=>'required'
        ]);
        
        $revenue = new Revenue([
            'revenueCategoryId' => $request->get('revenueCategoryId'),
            'date' => $request->get('date'),
            'value' => $request->get('value')
        ]);
        $revenue->save();
    
        return redirect('admin/expenses/')->with('success', 'Expense saved!');
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
        $revenue = Revenue::find($id);
        $revenue->delete();
        return redirect('/admin/expenses')->with('success', 'Expense deleted!');
    }

}
