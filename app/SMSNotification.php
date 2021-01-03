<?php

namespace App;
use App\Customers;
use App\Resources;
use App\Orders;
use App\OrderResources;
use App\OrderAddresses;

class SMSNotification {
    
    /**
     * Send a SMS message according to the order Status.
     *
     * @param  integer  $orderStatusId
     *
     * Reference
     * https://developer.nexmo.com/messaging/sms/guides/concatenation-and-encoding#encoding-examples
     * ATTENTION: 160 characters limit per SMS message
     */
    public static function checkSendNotification($orderId, $orderStatusId){
        
        switch ($orderStatusId) {
            
            case Orders::orderStatusId_BOOKED: //Booked
                
                /*
                $message = "Congrats! You were signed up for a new job. #customer#, #service#, #date#. Please, check details and confirm the job.";
                $orderResources = OrderResources::GetOrderResources($orderId);
                if(!empty($orderResources)) {
                    $order = Orders::GetOrder($orderId);
                    foreach ($orderResources as $resource) {
                        if($resource->accepted == null){
                            $message = str_replace("#customer#", $order->firstName, $message);
                            $message = str_replace("#service#", $order->service, $message);
                            $message = str_replace("#date#", $order->dateScheduleFormated, $message);
                            SMSNotification::sendSMSNotification($resource, $message);
                        }
                    }
                }
                */
                break;
                
            
            case Orders::orderStatusId_CANCELLED: //Cancelled
                
                /*
                $message = "ATTENTION: This job was cancelled by the customer! #customer#, #service#, #date#.";
                
                $orderResources = OrderResources::GetOrderResources($orderId);
                if(!empty($orderResources)) {
                    $order = Orders::GetOrder($orderId);
                    foreach ($orderResources as $resource) {
                        $message = str_replace("#customer#", $order->firstName, $message);
                        $message = str_replace("#service#", $order->service, $message);
                        $message = str_replace("#date#", $order->dateScheduleFormated, $message);
                        SMSNotification::sendSMSNotification($resource, $message);
                    }
                }
                */
                break;
            
            case Orders::orderStatusId_RECEIVED: //When the order is placed
                $message = "Truck Easy here! Thank you for considering us for your project. Your order number is `#contractNumber#` and the details are available at https://bit.ly/3eOB9L5";
                $order = Orders::GetOrder($orderId);
                $message = str_replace("#contractNumber#", $order->contractNumber, $message);
                SMSNotification::sendSMSNotification($order->phoneNumberSMS, $message);
                break;    
            
            case Orders::orderStatusId_IN_PROGRESS: //When the leader of the job does check in
                $message = "Truck Easy here! Our team just hit the road and we will be arriving soon. The details of your order '#contractNumber#' are available at https://bit.ly/3eOB9L5";
                $order = Orders::GetOrder($orderId);
                $message = str_replace("#contractNumber#", $order->contractNumber, $message);
                SMSNotification::sendSMSNotification($order->phoneNumberSMS, $message);
                break;    
                
            case Orders::orderStatusId_PENDING_PAYMENT: //Billing
                $message = "Truck Easy here! The bill and payment methods for your order '#contractNumber#' are available now at https://bit.ly/3eOB9L5";
                $order = Orders::GetOrder($orderId);
                $message = str_replace("#contractNumber#", $order->contractNumber, $message);
                SMSNotification::sendSMSNotification($order->phoneNumberSMS, $message);
                break;
                
        } 
        
    }

    /**
     * Send an e-mail reminder to the user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public static function sendSMSNotification($phoneNumber, $message)
    {
        
        //DEBUG
        $phoneNumber = "+18582919388";
        
        if(strlen($phoneNumber)>0){
            $basic  = new \Nexmo\Client\Credentials\Basic(env('NEXMO_KEY'), env('NEXMO_SECRET'));
            $client = new \Nexmo\Client($basic);

            $message = $client->message()->send([
                'to' => $phoneNumber,
                'from' => env('NEXMO_NUMBER'),
                'text' => $message
            ]);
        }
        
    }
    
    
    
    
}
