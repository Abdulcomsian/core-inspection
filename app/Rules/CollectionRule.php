<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Appointment;
use App\Models\Service;
class CollectionRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    protected $vendorId;
    public function __construct($vendorId=null)
    {
        $this->vendorId = $vendorId;
    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $serviceDetails = Service::where(['user_id'=>$this->vendorId,'service_category_id'=>$value])->first();
        $transactionHistory = Appointment::where(['user_id'=>\Auth::id(),'service_id'=>$serviceDetails->id])->first();
        if($transactionHistory&& $transactionHistory->exists())
        {
            $fail('You have already bought this service of this Service Provider');
        }
    }
}
