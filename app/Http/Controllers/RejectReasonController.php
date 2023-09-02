<?php

namespace App\Http\Controllers;

use App\Models\RejectReason;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Validator;

class RejectReasonController extends Controller
{
    private $types = array('User', 'Bank Account', 'Transaction');
    public function rejectType(){
        return $this->sendResponse($this->types);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $validator = Validator::make($request->all(),[
            'rejectType' => ['required', 'in:User,Bank Account,Transaction'],
            'description' => ['required'],
        ]);

        
        if($validator->fails()){
            return $this->sendError(['errors'=>$validator->messages()], 'invalid details');
        }

        $request['rejectCode'] = $this->generaterejectCode($request->rejectType);
        
        $rejectReason = RejectReason::create($request->all());
        if(!$rejectReason){
            return $this->sendError('Unable To Create Reject Reason', 'Please Contact Customer Service For Futher Actions');
        }
        else{
            return $this->sendResponse($rejectReason, 'Reject Reason Successfully Added');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $type)
    {
        $rejectReason = RejectReason::where('rejectType', $type)->get();
        
        if($rejectReason){
            return $this->sendResponse($rejectReason,'Successfully retruieve all reject reason of '. $type);
        }
        else{
            return $this->sendError('No reject reason of '.$type.' is retreieve', 'No bank accounts were retrieved');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(),[
            'description' => ['required'],
        ]);

        if($validator->fails()){
            return $this->sendError(['errors'=>$validator->messages()], 'invalid details');
        }

        $rejectReason = RejectReason::findorFail($id);
        $rejectReason['description'] = $request->description;
        $rejectReason->save();

        if($rejectReason){
            return $this->sendResponse($rejectReason, 'The reject reason has been updated successfully');
        }
        else{
            return $this->sendError('Reject reason is not updated', 'The reject reason is not updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $rejectReason = RejectReason::findorFail($id)->delete(); //

       if($rejectReason){
        return $this->sendResponse($rejectReason,'Successfully delete the reject reason');
        }
        else{
            return $this->sendError('Unable to delete reject reason', 'No reject reason were deleted');
        }
    }

    private function generaterejectCode(string $rejectType){
        $latestRejectReason = RejectReason::where('rejectType', $rejectType)->orderBy('reject_id','desc')->first();
        $rejectCode = '';
        switch ($rejectType) {
            case 'Bank Account':
                $rejectCode = 'BA';
                break;
            
            case 'Transaction':
                $rejectCode = 'TR';
                break;
            
            case 'User':
                $rejectCode = 'US';
                break;
            default:
                return $this->sendError('Undefind reject type');
        }

        if(!isset($latestRejectReason)){
            return $rejectCode . '001';
        }
        else{
            $latestRejectCodei = (int)substr($latestRejectReason->rejectCode, 2);
            $latestRejectCodei++;
            $latestRejectCodei = str_pad((string)$latestRejectCodei,3,"0",STR_PAD_LEFT);
            return $rejectCode . $latestRejectCodei;
        }
    }
}
