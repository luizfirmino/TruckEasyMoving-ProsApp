<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Orders;
use App\OrderResources;
use App\Customers;
use App\EmailNotification;
use App\SMSNotification;

class TaskController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function prosReminders() {
        $confirmations = Orders::GetOrdersPendingConfirmation();
        foreach ($confirmations as $resource) {
            EmailNotification::prepareReminderPros($resource->orderId, $resource->resourceId);
            echo "Sending reminder: " . $resource->resource . " - Customer: " . $resource->customer . " - Service: " . $resource->service . "<br>";
        }
        return "200";
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function customerReminders() {
        
        $reminders = Orders::GetOrdersReminders();
        
        foreach ($reminders as $data) {
            
            // Email Reminder
            $template = "admin.emails.clients.reminder";
            $subject = "REMINDER: We are ready to go!";
            if(strlen($data->email)>0){
                EmailNotification::sendNotification("", "", $template, $subject, $data, $data);
                echo "Sending email reminder: " . $data->orderId . " <br>";;
            }
                
            // SMS Reminder
            $message = "Truck Easy here! This is a reminder that your order `#contractNumber#` is confirmed for tomorrow at `#timeScheduleAMPM#`. More details at https://bit.ly/3eOB9L5";
            $message = str_replace("#contractNumber#", $data->contractNumber, $message);
            $message = str_replace("#timeScheduleAMPM#", $data->timeScheduleAMPM, $message);
            SMSNotification::sendSMSNotification($data->phoneNumberSMS, $message);
            echo "Sending text message reminder: " . $data->orderId . " <br>";;
            
        }
        return "200";
    }
    
}