<?php

namespace App;
use Mail;
use App\Customers;
use App\Resources;
use App\Orders;
use App\OrderResources;
use App\OrderAddresses;

class EmailNotification {
    
    /**
     * Send an e-mail reminder according to the order Status.
     *
     * @param  int  $orderStatusId
     * @param  int  $id
     * @return boolean
     */
    public static function checkSendNotification($orderId, $orderStatusId){
        
        switch ($orderStatusId) {
            case 1: //Received
                EmailNotification::prepareEmailClient($orderId, 'admin.emails.clients.notification', "Your order is confirmed!");
                break;
            case 2: //Booked
                EmailNotification::prepareEmailPros($orderId, 'admin.emails.pros.notification', "You got a new job!");
                break;
            case 5: //Paid
                EmailNotification::prepareEmailClient($orderId, 'admin.emails.clients.review', "Thank you for your business!");
                break;
            case 6: //Cancelled
                EmailNotification::prepareEmailClient($orderId, 'admin.emails.clients.cancelation', "We are going to miss you!");
                EmailNotification::prepareEmailPros($orderId, 'admin.emails.pros.cancelation', "Your job was cancelled!");
                break;
            case 7: //Pending Payment
                EmailNotification::prepareEmailClient($orderId, 'admin.emails.clients.billing', "Your bill is available!");
                break;    
        } 
        
    }
    
    /**
     * Send an e-mail reminder to all resources
     *
     * @param  int  $orderId
     * @return Response
     */
    public static function prepareEmailPros($orderId, $template, $subject)
    {
        
        $orderResources = OrderResources::GetOrderResources($orderId);
        if(!empty($orderResources)) {
            $order = Orders::GetOrder($orderId);            
            foreach ($orderResources as $resource) {
                EmailNotification::sendNotification('noreply@truckeasymoving.com', 'Pros Notification', $template, $subject, $order, $resource);
            }
        }
        
    }
    
    /**
     * Send an e-mail reminder to all resources
     *
     * @param  int  $orderId
     * @return Response
     */
    public static function prepareReminderPros($orderId, $resourceId)
    {
        $template = "admin.emails.pros.reminder";
        $subject = "REMINDER: We need your confirmation!";
        $order = Orders::GetOrder($orderId);
        $resource = Resources::find($resourceId);
        EmailNotification::sendNotification('noreply@truckeasymoving.com', 'Pros Notification', $template, $subject, $order, $resource);
    }
    
    
    /**
     * Send an e-mail reminder to all resources
     *
     * @param  int  $orderId
     * @return Response
     */
    public static function prepareEmailClient($orderId, $template, $subject)
    {
        $order = Orders::GetOrder($orderId);
        $customer = Customers::find($order->customerId);
        EmailNotification::sendNotification('bookings@truckeasymoving.com', 'Truck Easy Notification', $template, $subject, $order, $customer);
    }
    
    
    /**
     * Send an e-mail reminder to the user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public static function sendNotification($fromEmail, $fromName, $template, $subject, $data, $to)
    {
        
        $to->email = 'luiz.firmino@gmail.com';
        /*if(strlen($to->email)>0){            
            Mail::send($template, ['to' => $to, 'data' => $data], function ($message) use ($to,$subject) {
                $message->from('noreply@truckeasymoving.com', 'Truck Easy Notification');
                $message->bcc("getquotemoving@gmail.com", "Truck Easy Moving")->subject($subject);
                $message->to($to->email, $to->firstName)->subject($subject);
            });
        }*/
        
    }
    
    
    
    
}
