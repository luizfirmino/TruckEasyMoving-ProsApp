<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SMSNotification;
use App\EmailNotification;
use App\Resources;
use App\Replacements;
use App\OrderResources;


class ReplacementController extends Controller
{
    
    
     /**
     * Display a listing of the replacements.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $replacements = Replacements::getReplacements(null, null)->paginate(10);
        return view('admin.replacements.index', compact('replacements'));
    }
    
    public function show($id){
        $replacement    = Replacements::getReplacement($id);
        $replacements   = Replacements::getReplacementResourcesStatus($id);
        return view('admin.replacements.show', compact('replacements', $replacements, 'replacement', $replacement));
    }
    
    public function destroy($id)
    {
        $replacement = Replacements::find($id);
        $replacement->active = 0;
        $replacement->save();
        Replacements::desactivateReplacementResources($id);
        
        // Send notification to who request the replacement
        $resource = Resources::find($replacement->resourceId);
        SMSNotification::sendSMSNotification('+1' . $resource->phoneNumber, "Truck Easy here! Sorry but nobody was available to replace you on the job you requested replacement");
        
        return redirect('/admin/replacements/' . $replacement->replacementId)->with('success', 'Replacement deactivated!');
    }
    
}