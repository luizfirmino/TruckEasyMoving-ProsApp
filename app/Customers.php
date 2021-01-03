<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    
    protected $primaryKey = 'customerId';
    
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'phoneNumber',
        'address',
        'addressComp',   
        'city',
        'state',   
        'zipcode'      
    ];
    
    public static function GetCustomers($request){

        $customers = Customers::whereRaw("1=1");
        
        if (!empty($request->get('q_name'))){
            $customers->whereRaw("CONCAT(firstName, ' ', IFNULL(lastName,'')) LIKE '%" . $request->get('q_name') . "%'");
        }
        
        if (!empty($request->get('q_phoneNumber'))){
            $customers->where('phoneNumber', 'like', $request->get('q_phoneNumber') . '%');
        }
        
        if (!empty($request->get('q_email'))){
            $customers->where('email', 'like', '%' . $request->get('q_email') . '%');
        }
        
        return $customers->orderBy('firstName')->paginate(10)->withPath('/admin/customers/search');
    }
    
    
}
