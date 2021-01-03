<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Calendar;
use App\Orders;
use App\OrderReviews;
use App\EmailNotification;
use App\Replacements;

class AdminHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     *
    public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $orders = Orders::GetOrdersCalendar();
        $confirmations = Orders::GetOrdersPendingConfirmation();
        $replacements = Replacements::getReplacements(null, 1)->get();
        $ordersInProgress = Orders::GetOrdersInProgress();
        $ordersReceived = Orders::GetOrdersReceived();
        $reviews = OrderReviews::whereRaw("onwebsite = 0 AND datediff(current_date, created_at) < 4")->get();
        return view('admin.home', compact('orders',$orders,'confirmations', $confirmations, 'ordersInProgress', $ordersInProgress, 'ordersReceived', $ordersReceived, 'reviews', $reviews, 'replacements', $replacements));
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reminder(Request $request)
    {
        
        EmailNotification::prepareReminderPros($request->input("orderId"), $request->input("resourceId"));
        return redirect('/admin')->with('success', 'Reminder sent!');

    }
}
