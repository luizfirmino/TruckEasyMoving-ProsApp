<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\UploadFiles;
use App\User;
use App\Resources;

class UserController extends Controller
{
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // Check if a profile image has been uploaded
        if ($request->has('profilePicture')) {
            
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
        
        
        $user = User::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'email' => $data['email'],
            'phoneNumber' => $data['phoneNumber'],
            'profilePicture' => $filePath,
            'password' => Hash::make($data['password']),
        ]);
        
        Resources::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'email' => $data['email'],
            'phoneNumber' => $data['phoneNumber'],
            'active' => '1',
            'userId' => $user->id,
        ]);
        
        return redirect('admin/users/')->with('success', 'User saved!');
        
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
        $user = User::find($id);
        $resource = Resources::find($id);
        return view('admin.users.edit', compact('user', $user, 'resource', $resource));
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
            'firstName'=>'required',
            'lastName'=>'required',
            'phoneNumber'=>'required',
            'email'=>'required',
        ]);
        
        //RESOURCE
        $resource               = Resources::find($id);
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
        $user = User::find($id);
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
        
        return redirect('/admin/users')->with('success', 'User updated!');
    }

}
