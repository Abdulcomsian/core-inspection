<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bmatovu\MtnMomo\Products\Disbursement;
use Bmatovu\MtnMomo\Products\Collection;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Appointment;
use App\Models\Collection as CollectionModal;
use App\Models\Service;
use Illuminate\Validation\Rule;
use App\Rules\CollectionRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CollectionController extends Controller
{
    public function requestToPay(Request $request)
    {


        try {
            $collection = new Collection();

            $referenceId = $collection->requestToPay('yourTransactionId', '46733123454', 100);
            // $referenceId = $collection->getAccountHolderBasicInfo('46767823453');
            // $referenceId = $collection->getTransactionStatus('508cdde6-57e2-4a9a-876a-977fb1b04371');
            // $transaction = $collection->getTransactionStatus($referenceId);
            // $referenceId  =   $collection->transfer('yourTransactionId', '46753523453', 5000);
            dd($referenceId);
        } catch (CollectionRequestException $e) {
            do {
                printf(
                    "\n\r%s:%d %s (%d) [%s]\n\r",
                    $e->getFile(),
                    $e->getLine(),
                    $e->getMessage(),
                    $e->getCode(),
                    get_class($e)
                );
            } while ($e = $e->getPrevious());
        }
    }

    public function makeCollectionPayment(Request $request, $id)
    {
        $appointmentDetails = Appointment::find($id);
        $serviceDetails = Service::where(['user_id' => $request->vendor_id, 'service_category_id' => $request->service_category_id])->first();
        if (getUserWalletBalance() < $serviceDetails->price) {
            toastr('You have insuffient balance. Kindly add balance to your wallet', 'warning');
            return redirect()->back();
        }

        $appointmentDetails->status = '0';
        $appointmentDetails->save();

        if ($appointmentDetails) {
            toastr('Payment sent successfully');
            return redirect()->back();
        }

        // $collection = new Collection();
        // $referenceId = $collection->requestToPay('yourTransactionId', $request->mtn_number, $serviceDetails->price);
        // $transaction = $collection->getTransactionStatus($referenceId);
        // if (isset($referenceId)) {
        //     $transaction =
        //         [
        //             'appointment_id' => $appointmentDetails->id,
        //             'transaction_status' => $transaction['status'],
        //             'amount' => $serviceDetails->price,
        //             'service_id' => $serviceDetails->id,
        //             'user_id' => Auth::id(),
        //             'vendor_id' => $request->vendor_id,
        //             'reference_id' => $referenceId,
        //         ];
        //     if (CollectionModal::create($transaction)) {
        //         toastr('Payment sent successfully');
        //         return redirect()->back();
        //     }
        // }
    }
    public function submitPayment(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'appointment.service_category' => ['required', new CollectionRule($request->appointment['vendor_id'])],
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()->all()]);
        }
        $serviceDetails = Service::where(['user_id' => $request->appointment['vendor_id'], 'service_category_id' => $request->appointment['service_category']])->first();

        $collection = new Collection();
        $referenceId = $collection->requestToPay('yourTransactionId', $request->mobile_number, $serviceDetails->price);
        $transaction = $collection->getTransactionStatus($referenceId);
        if (isset($referenceId)) {
            $transaction = Transaction::create([
                'transaction_type' => 'collection',
                'transaction_status' => $transaction['status'],
                'start_date' => $request->appointment['start_date'],
                'end_date' => $request->appointment['end_date'],
                'start_time' => $request->appointment['start_time'],
                'end_time' => $request->appointment['end_time'],
                'location' => $request->appointment['location'],
                'purchase_amount' => $serviceDetails->price,
                'service_id' => $serviceDetails->id,
                'user_id' => Auth::id(),
                'vendor_id' => $request->appointment['vendor_id'],
                'reference_id' => $referenceId,

            ]);
        }


        return response()->json([
            'status' => true,
            'message' => 'Payment Successful'
        ]);
    }

    public function approvePayment($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction->update(['transaction_status' => 'SUCCESSFUL'])) {
            toastr("Updated successfully");
            return redirect()->back();
        }
    }
}
