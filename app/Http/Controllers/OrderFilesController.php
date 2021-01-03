<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Orders;
use App\OrderFiles;
use App\UploadFiles;

class OrderFilesController extends Controller
{
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        
        $order = Orders::find($id);
        $path = UploadFiles::uploadFile($request->file('file'), 'uploads\\orders\\' . $order->contractNumber, null, null, true, false);
                                
        $orderFile = new OrderFiles([
            'orderId' => $id,
            'path' => $path[0],
            'thumbnail' => $path[1],
            'created_by' => Auth::user()->id,
            'notes' => $request->input('notes')
        ]);
        $orderFile->save();
                
        return redirect('admin/orders/'.$id.'/edit')->with('success', 'File saved!');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        
        $file = OrderFiles::find($id);
        UploadFiles::DeleteFile($file->path);
        if (!is_null($file->thumbnail)) UploadFiles::DeleteFile($file->thumbnail);
        $file->delete();
        return redirect('admin/orders/'.$request->get('orderId').'/edit')->with('success', 'File deleted!');
        
    }
}
