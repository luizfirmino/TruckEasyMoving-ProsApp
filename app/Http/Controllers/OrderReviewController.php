<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderReviews;

class OrderReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = OrderReviews::paginate(10);

        return view('admin.reviews.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
        $data = OrderReviews::find($id);
        if ($data == null){
            return view('admin.reviews.create');
        }else{
            return view('admin.reviews.edit', compact('data'));
        }
            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $orderId)
    {
        //
        $request->validate([
            'review'=>'required',
            'stars'=>'required',
            'onwebsite'=>'required'
        ]);

        $data = new OrderReviews([
            'orderId' => $orderId,
            'review' => $request->get('review'),
            'stars' => $request->get('stars'),
            'onwebsite' => $request->get('onwebsite'),
            'created_at' => $request->get('created_at')
        ]);
        $data->save();
        return redirect('admin/orders/' . $orderId . '/edit' )->with('success', 'Review saved!');
        
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
        $data = OrderReviews::find($id);
        return view('admin.reviews.edit', compact('data'));   
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
            'review'=>'required',
            'stars'=>'required',
            'onwebsite'=>'required'
        ]);

        $data = OrderReviews::find($id);
        $data->review = $request->get('review');
        $data->stars = $request->get('stars');
        $data->onwebsite = $request->get('onwebsite');
        $data->save();

        return redirect('/admin/reviews')->with('success', 'Review updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = OrderReviews::find($id);
        $data->delete();

        return redirect('/admin/reviews')->with('success', 'Review deleted!');
    }
}
