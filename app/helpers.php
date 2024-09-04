<?php
// saving candidate profile picture
use App\Models\Collection;
use App\Models\Disbursement;
use App\Models\Transaction;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

function saveFile($filePath, $newFile, $oldFile = null, $fileName = null)
{
    try {

        $public_path = public_path($filePath);
        File::isDirectory($public_path) or File::makeDirectory($public_path, 0777, true, true);
        if ($oldFile) {
            @unlink($oldFile);
        }
        if ($fileName) {
            $filename = $fileName . '.' . $newFile->getClientOriginalExtension();
        } else {
            $filename = time() . rand(10000, 99999) . '.' . $newFile->getClientOriginalExtension();
        }
        $newFile->move($public_path, $filename);
        return $filePath . $filename;
    } catch (\Exception $exception) {
        return null;
    }
}

// service file  path
function  serviceFilePath($serviceId = null)
{
    if ($serviceId) {
        $path = 'uploads/services/' . $serviceId . '/';
    } else {
        $path  = 'uploads/services/';
    }
    return $path;
}

function getUserWalletBalance()
{
    $totalWalletAmount = Transaction::where('user_id', Auth::id())->sum('amount');
    // $totalSpentAmount  = Collection::where('user_id', Auth::id())->sum('amount');
    $totalSpentAmount  = Appointment::where('user_id', Auth::id())->where('status', '0')->sum('purchase_amount');
    $remainingBalance = $totalWalletAmount - $totalSpentAmount;
    return $remainingBalance;
}
function getWithdrawnBalance()
{
    $totalWithdrawn = Disbursement::where('user_id', Auth::id())->where('status', 2)->sum('withdraw_amount');

    return $totalWithdrawn;
}
