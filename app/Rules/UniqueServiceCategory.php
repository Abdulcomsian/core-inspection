<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Service;

class UniqueServiceCategory implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    protected $formType;
    public function __construct($formType = null, $serviceId = null)
    {
        $this->formType = $formType;
        $this->serviceId = $serviceId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (isset($this->formType) && isset($this->serviceId) && $this->formType == 'edit-form') {
            $existings = Service::where('user_id', \Auth::id())->where('id', '!=', $this->serviceId)
                ->where('service_category_id', $value)
                ->first();
            if (isset($existings)) {
                $fail('You already have added service against this category');
            }
        } else {
            $existings = Service::where('user_id', \Auth::id())
                ->where('service_category_id', $value)
                ->first();
            if (isset($existings)) {
                $fail("You have already added a service in this category");
            }
        }
    }
}
