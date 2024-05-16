<?php

namespace App\Http\Requests\Tools\ServiceCenter\ReturnsLog;

use App\Models\Sku;
use App\ZendeskTicket;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ServiceCenterReturnLogReturnRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "recieved_date" => "required|date",
            "supportsync_reference" => "nullable|string",
            "zendesk_reference" => "nullable|string",
            "other_reference" => "nullable|string",
            "return_reason" => [
                "required",
                Rule::in(array_keys(config('servicecenter.returnslog.return_reasons')))
            ],
            "sku_id" => "exclude_if:is_a_custom_sku,true|exists:skus,id|required",
            "custom_sku" => "exclude_unless:is_a_custom_sku,true|required|string",
            "check_in_user_id" => "required|exists:users,id",
            "notes" => "nullable|string",
            "service_center_id" => "required|exists:service_centers,id",

            //Check in as above...

            'technician_id' => "nullable|exists:users,id",
            'tested_date' => "nullable|date",
            'refund_type' => [
                "nullable",
                Rule::in(array_keys(config('servicecenter.returnslog.refund_types')))
            ],
            'customer_aware' => "nullable|boolean",
            'all_checks' => "nullable|boolean",
            'completed_date' => "nullable|date",
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {   
        if ($this->return_complete ?? null) {
            $this->merge([
                'completed_date' => Carbon::now()
            ]);
        }
        else {
            $this->merge([
                'completed_date' => null
            ]);
        }

        if ($this->recieved_date_localized && !$this->recieved_date)
        {
            $this->merge([
                'recieved_date' => $this->recieved_date_localized->setTimezone('UTC')
            ]);
        }
        if ($this->tested_date_localized && !$this->tested_date)
        {
            $this->merge([
                'tested_date' => Carbon::parse($this->tested_date_localized, $this->timezone ?? $this->service_center['timezone'])->setTimezone('UTC')
            ]);
        }

        $this->merge([
            'is_a_custom_sku' => $this->sku_id ? false : true,
        ]);
    }
}
