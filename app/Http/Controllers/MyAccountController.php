<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UploadFiles;
use App\Resources;
use App\User;

class MyAccountController extends Controller
{
    
    public function index()
    { 
        $account = User::find(Auth::user()->id);
        return view('myAccount', compact('account'));
    }
    
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'firstName'=>'required',
            'lastName'=>'required',
            'phoneNumber'=>'required',
            'email'=>'required',
            'address'=>'required',
            'addressComp'=>'required',
            'city'=>'required',
            'state'=>'required',
            'zipcode'=>'required', 
            'profilePicture'=>'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        //RESOURCE INFO
        $resource               = Resources::where('resourceId', '=', Auth::user()->id)->first();
        $resource->firstName    = $request->get('firstName');
        $resource->lastName     = $request->get('lastName');
        $resource->email        = $request->get('email');
        $resource->phoneNumber  = $request->get('phoneNumber');
        $resource->address      = $request->get('address');
        $resource->addressComp  = $request->get('addressComp');
        $resource->city         = $request->get('city');
        $resource->state        = $request->get('state');
        $resource->zipCode      = $request->get('zipcode');
        $resource->save();
        
        
        // Get current user
        $user = User::find(auth()->user()->id);
        $user->firstName    = $request->get('firstName');
        $user->lastName     = $request->get('lastName');
        $user->email        = $request->get('email');
        $user->phoneNumber  = $request->get('phoneNumber');
        
        // Check if a profile image has been uploaded
        if ($request->has('profilePicture')) {
            
            //DELETE CURRENT PROFILE PICTURE
            UploadFiles::deleteFile('/public/' . $user->profilePicture);
                        
            // Get image file
            $image = $request->file('profilePicture');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($request->input('firstName')).'_'.time();
            // Define folder path
            $folder = '/uploads/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            UploadFiles::uploadFile($request->file('profilePicture'), '/public' . $folder, $name, 600, null, null);
            // Set user profile image path in database to filePath
            $user->profilePicture = $filePath;
            
        }
        
        // Persist user record to database
        $user->save();
        
        return redirect('/myAccount')->with('success', 'Your information was updated successfully!');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = user::find(Auth::user()->id);
        $resource = Resources::find(Auth::user()->id);
        return view('myAccount.edit', ['user' => $user, 'resource' => $resource]);
    }
    
    
}