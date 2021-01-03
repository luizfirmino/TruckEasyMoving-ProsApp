<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SMSNotification;
use App\EmailNotification;
use App\Jobs;
use App\Resources;
use App\Replacements;
use App\OrderResources;


class JobReplacementController extends Controller
{
    
    
     /**
     * Display a listing of the replacements.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $replacements = Replacements::getReplacements(Auth::user()->id, null)->paginate(10);
        return view('jobReplacements', compact('replacements'));
    }
    
    public function show($id){
        $job                        = Jobs::where('orderId', $id)->first();
        $resourcesAvailable         = Replacements::getResourcesAvailable($id, Auth::user()->id);    
        return view('jobReplacement', compact('job', $job, 'resourcesAvailable', $resourcesAvailable));
    }
    
    
    public function store(Request $request){
                
        if($request->get('replacedBy') == "specific"){
            $request->validate([
                'resourceReplacementId'=>'required'
            ]);        
        }      
        
        $replacements = new Replacements([
            'orderId' => $request->input('orderId'),
            'resourceId' => Auth::user()->id,
            'notes' => $request->input('notes')
        ]);
        $replacements->save();
        
        // UPDATE THE RESOURCE TO CONFIRMED
        Jobs::setResourceJobConfirmation($request->input('orderId'), Auth::user()->id, 1);
        
        if($request->get('replacedBy') == "specific"){
            
            Replacements::InsertReplacementResources($replacements->replacementId, $request->get('resourceReplacementId'));
            $resource = Resources::find($request->get('resourceReplacementId'));
            SMSNotification::sendSMSNotification('+1' . $resource->phoneNumber, "Truck Easy here! There's a job waiting for you. Check the details at https://bit.ly/3eADk3A");
            $resource = null;
            
        } else {
            
            $resourcesAvailable = Replacements::getResourcesAvailable($request->input('orderId'), Auth::user()->id);
            
            foreach ($resourcesAvailable as $resource){
                Replacements::InsertReplacementResources($replacements->replacementId, $resource->resourceId);
                SMSNotification::sendSMSNotification('+1' . $resource->phoneNumber, "Truck Easy here! There's a job waiting for you. Check the details at https://bit.ly/3eADk3A");
            }
            
        }
        return redirect('jobReplacement/' . $replacements->replacementId . '/status/')->with('success', 'Replacement posted!');
    }
    
    
    public function status($id){
        
        $replacement    = Replacements::find($id);
        $job            = Jobs::where('orderId', $replacement->orderId)->first();
        $replacements   = Replacements::getReplacementResourcesStatus($id);
                
        return view('jobReplacementStatus', compact('job', $job, 'replacements', $replacements, 'replacement', $replacement));
    }

    
    public function destroy($id)
    {
        $replacement = Replacements::find($id);
        $replacement->active = 0;
        $replacement->save();
        Replacements::desactivateReplacementResources($id);
        return redirect('jobReplacement/' . $replacement->replacementId . '/status')->with('success', 'Replacement deactivated!');
    }
    
    
    public function update(Request $request, $id)
    {
        
        $replacement = Replacements::find($id);
        
        if ($replacement->active == "1"){
        
            Replacements::updateReplacementResource($id, Auth::user()->id, $request->get('accepted'));

            // If the replacement was accepted
            if($request->get('accepted') == "1"){

                $replacement->active = 0;
                $replacement->save();
                Replacements::desactivateReplacementResources($id);

                // Who Asked for replacement
                $resource = OrderResources::GetOrderResource($replacement->orderId, $replacement->resourceId);

                // Replace the current resource
                $resource->resourceId = Auth::user()->id;
                OrderResources::UpdateOrderResource($resource);

                // Delete who requested the replacement from the order
                OrderResources::DeleteOrderResource($replacement->orderId, $replacement->resourceId);

                // Send notification to who request the replacement
                $resource = Resources::find($replacement->resourceId);
                SMSNotification::sendSMSNotification($resource->phoneNumber, "Truck Easy here! Your replacement request was successfully done");

            // If not    
            } else {

                $count = Replacements::getReplacementsRemaining($id);
                // Check if this is the last resource for a replacement
                if (!($count[0]->replacementsRemaining > 0)) {

                    // Desactive replacement
                    $replacement->active = 0;
                    $replacement->save();

                    // Send notification to who request the replacement
                    $resource = Resources::find($replacement->resourceId);
                    SMSNotification::sendSMSNotification($resource->phoneNumber, "Truck Easy here! Sorry but nobody was available to replace you on the job.");

                }
            }
            
            return redirect('jobUpcoming/' . $replacement->orderId)->with('success', 'Thank you! We have received your decision for the job.');
            
        } else {
            return redirect('jobUpcoming/' . $replacement->orderId)->with('success', 'This job is no longer available for replacement');
        }
        
    }
    
}