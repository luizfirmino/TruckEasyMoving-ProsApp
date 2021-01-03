<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Orders;
use App\Combos;
use App\OrderFiles;
use App\SMSNotification;
use App\EmailNotification;
use App\Jobs;
use App\Replacements;
use App\UploadFiles;


class JobController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    { 
        
        // TODAY's JOB
        $jobsToday = Jobs::getJobsToday(Auth::user()->id);

        // UPCOMING JOBS (BOOKED)
        $jobs = Jobs::getJobsComing(Auth::user()->id);
        
        // PENDING JOBS
        $pendings = Jobs::getJobsPending(Auth::user()->id);
        
        // ACTIVE Replacements
        $replacements = Replacements::where('resourceId', Auth::user()->id)->where('active', 1)->get();
        
        $overview_month = date("n");
        $overview = Jobs::getOverview(Auth::user()->id, $overview_month);
        
        $months = Combos::getMonths();
            
        return view('dashboard', ['jobs' => $jobs, 'jobsToday' => $jobsToday, 'pendings' => $pendings, 'replacements' => $replacements, 'overview' => $overview, 'months' => $months, 'overview_month' => $overview_month]);
    }
    
    
    public function overview(Request $request, $month)
    { 
        
        // TODAY's JOB
        $jobsToday = Jobs::getJobsToday(Auth::user()->id);

        // UPCOMING JOBS (BOOKED)
        $jobs = Jobs::getJobsComing(Auth::user()->id);
        
        // PENDING JOBS
        $pendings = Jobs::getJobsPending(Auth::user()->id);
        
        // ACTIVE Replacements
        $replacements = Replacements::where('resourceId', Auth::user()->id)->where('active', 1)->get();
        
        $overview_month = $month;
        $overview = Jobs::getOverview(Auth::user()->id, $overview_month);
        
        $months = Combos::getMonths();
                
        return view('dashboard', ['jobs' => $jobs, 'jobsToday' => $jobsToday, 'pendings' => $pendings, 'overview' => $overview, 'months' => $months, 'overview_month' => $overview_month, 'replacements' => $replacements]);
    }
    
    
    // PAST JOBS
    public function jobs(){
        $jobs = Jobs::getPastJobs(Auth::user()->id)->paginate(10);
        return view('jobs', compact('jobs'));
    }
    
    
    public function job($id){
        $job        = Jobs::getJobDetails($id, Auth::user()->id);
        $payments   = Jobs::getJobResourcePayments($id, Auth::user()->id);
        return view('jobdetails', compact('job', $job, 'payments', $payments));
    }
    
    // JOB UPCOMING
    public function coming($id){
        $job            = Jobs::where('orderId', $id)->first();
        $addresses      = Jobs::getJobAddresses($id);
        $resources      = Jobs::getJobResources($id);
        $confirmation   = Jobs::getJobResourceConfirmation($id, Auth::user()->id);
        $jobFiles       = Jobs::getJobFiles($id);
        $jobEquipments  = Jobs::getJobEquipments($id);
        $replacement    = Replacements::getReplacementAvailable($id, Auth::user()->id);
        $replacementOwner = Replacements::where('orderId', $id)->where('resourceId', Auth::user()->id)->where('active',1)->first();
        
        return view('jobUpcoming', compact('job', $job, 'addresses', $addresses, 'resources', $resources,'confirmation',$confirmation, 'jobFiles', $jobFiles, 'jobEquipments', $jobEquipments, 'replacement', $replacement, 'replacementOwner', $replacementOwner));
    }

    // JOB TODAY
    public function today($id){
        $job        = Jobs::where('orderId', $id)->first();
        $addresses  = Jobs::getJobAddresses($id);
        $resources  = Jobs::getJobResources($id);
        $check      = Jobs::getCheckTime($id, Auth::user()->id);
        $leader     = Jobs::checkResourceLeader($id, Auth::user()->id);
        $jobFiles   = Jobs::getJobFiles($id);
        $jobEquipments  = Jobs::getJobEquipments($id);
        return view('jobToday', compact('job', $job, 'addresses', $addresses, 'resources', $resources, 'check', $check, 'leader', $leader, 'jobFiles', $jobFiles, 'jobEquipments', $jobEquipments));
    }
    
    //Checkin
    public function CheckIn(Request $request){
        
        $return = Jobs::checkIn($request->input('orderId'), Auth::user()->id);
        
        if ($return[0]->code == 0){
            if (Jobs::checkResourceLeader($request->input('orderId'), Auth::user()->id)){
                $job = Jobs::where('orderId', $request->input('orderId'))->first();
                SMSNotification::checkSendNotification($request->input('orderId'), $job->orderStatusId);
            }
            return redirect('jobToday/' . $request->input('orderId'))->with('success', $return[0]->message);
            
        } else {
            return redirect('jobToday/' . $request->input('orderId'))->with('error', $return[0]->message);
        }
    }
    
    //Confirm
    public function confirm(Request $request, $id){
        Jobs::setResourceJobConfirmation($id, Auth::user()->id, $request->input('accepted'));
        return redirect('jobUpcoming/' . $id)->with('success', 'Thank you! We have received your decision for the job.');
    }
    
    // Calculator
    public function calculator($id){
        $job        = Jobs::where('orderId', $id)->first();
        $billing    = Jobs::getJobBilling($id);
        return view('jobCalc', compact('job', $job, 'billing' , $billing));
    }
    
    // Calculator - Result
    public function result(Request $request, $id){
        
        $job        = Jobs::where('orderId', $id)->first();
        $return     = Jobs::calcJob($id, $request->input('timeStart'), $request->input('timeEnd'));
        $request->flash();
        
        if ($return[0]->code == 0){
            $billing    = Jobs::getJobBilling($id);
            SMSNotification::checkSendNotification($id, Orders::orderStatusId_PENDING_PAYMENT);
            return redirect('jobToday/' . $id . '/calculator');
        }else {
            return redirect('jobToday/' . $id . '/calculator')->with('error', $return[0]->message);
        }

    }
    
    // Calculator - Upload
    public function upload(Request $request, $id){
        
        $job = Jobs::where('orderId', $id)->first();
        
        $service = null;
        
        if($request->get('paid_cash') == "1"){
            
            $service = "CASH";
            $path = "/public/uploads/images/paid.png";
            
        }else{
            
            Validator::make($request->all(), [
                'proof_payment'=>'required'                
            ])->validate();
            
            $path = UploadFiles::uploadFile($request->file('proof_payment'), 'uploads/orders/' . $job->contractNumber, null, 800, null, true);
            
        }
        
        Jobs::updateJobBillingPayment($id, $path[0], $service);
        return redirect('jobToday/' . $id . '/calculator/')->with('success', 'Payment processed');
        
    }
    
    // Job - Upload Photo
    public function uploadPhoto(Request $request, $id){
        
        $job = Jobs::where('orderId', $id)->first();
        $path = UploadFiles::uploadFile($request->file('photo'), 'uploads/orders/' . $job->contractNumber, null, null, true, true);
        
        $orderFile = new OrderFiles([
            'orderId' => $id,
            'path' => $path[0],
            'thumbnail' => $path[1],
            'created_by' => Auth::user()->id,
            'notes' => $request->input('notes')
        ]);
        $orderFile->save();
                
        return redirect('jobToday/' . $id)->with('success', 'Photo uploaded with success!');
    }
    
}