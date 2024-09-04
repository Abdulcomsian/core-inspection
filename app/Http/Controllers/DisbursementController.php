<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bmatovu\MtnMomo\Products\Disbursement;
use Bmatovu\MtnMomo\Products\Collection;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Appointment;
use App\Models\Disbursement as DisbursementModal;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DisbursementController extends Controller
{
    public function WithDrawFund(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mtn_number' => 'required|numeric|digits_between:8,10',
        ]);
        if ($validator->fails()) {
            $errorMessage = '';
            foreach ($validator->errors()->all() as $error) {
                $errorMessage = $errorMessage . $error . "\n";
            }
            toastr($errorMessage, 'error');
            return redirect()->back();
        }
        $appointmentDetails  = Appointment::find($request->appointment_id);
        $serviceDetails = Service::find($appointmentDetails->service_id);
        $servicePrice = $serviceDetails->serviceCategory->price;
        // $disbursement = new Disbursement();
        $serviceCharge  = ($servicePrice * 7) / 100;
        $remainingCharge = $servicePrice - $serviceCharge;
        // $referenceId = $disbursement->transfer('yourTransactionId', $request->mtn_number, $remainingCharge);
        // $transaction = $disbursement->getTransactionStatus($referenceId);
        $transaction =
            [
                'appointment_id' => $request->appointment_id,
                'withdraw_amount' => $remainingCharge,
                'commission_amount' => $serviceCharge,
                'service_id' => $serviceDetails->id,
                'user_id' => Auth::id(),
                'status' => 0,
                'vendor_id' => $request->vendor_id,
                'phone_number' => $request->mtn_number
            ];
        if (DisbursementModal::create($transaction)) {
            toastr('Withdraw request sent successfully');
            return redirect()->back();
        }
    }
    public function userApproveVendorPayment($id)
    {
        $disbursementDetails = DisbursementModal::where('appointment_id', $id)->first();
        $disbursementDetails->status = 1;
        if ($disbursementDetails->save()) {
            toastr('Payment Request Approved Successfully');
            return redirect()->back();
        }
    }
    public function adminApproveVendorPayment($id)
    {
        $disbursementDetails = DisbursementModal::where('appointment_id', $id)->first();
        $disbursement = new Disbursement();
        $referenceId = $disbursement->transfer('yourTransactionId', $disbursementDetails->phone_number, $disbursementDetails->withdraw_amount);
        $transaction = $disbursement->getTransactionStatus($referenceId);
        if ($referenceId) {
            $disbursementDetails->status = 2;
            $disbursementDetails->reference_id = $referenceId;
            $disbursementDetails->transaction_status = $transaction['status'];
            if ($disbursementDetails->save()) {
                toastr('Payment Request Approved Successfully');
                return redirect()->back();
            }
        } else {
            toastr('Request Failed', 'error');
            return redirect()->back();
        }
    }
}
