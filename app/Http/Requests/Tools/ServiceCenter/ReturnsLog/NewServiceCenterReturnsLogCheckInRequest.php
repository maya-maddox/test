<?php

namespace App\Http\Requests\Tools\ServiceCenter\ReturnsLog;

use App\Models\Sku;
use App\ZendeskTicket;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class NewServiceCenterReturnsLogCheckInRequest extends FormRequest
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
            "in_zendesk_table" => "exclude_if:override_warnings,true|accepted",
            "other_reference" => "nullable|string",
            "return_reason" => [
                "required",
                Rule::in(array_keys(config('servicecenter.returnslog.return_reasons')))
            ],
            "sku_id" => "exclude_if:is_a_custom_sku,true|exists:skus,id|required",
            "custom_sku" => "exclude_unless:is_a_custom_sku,true|required|string",
            "check_in_user_id" => "required|exists:users,id",
            "notes" => "nullable|string",
            "redirect-to" => [
                "nullable",
                Rule::in(['processing'])
            ]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'in_zendesk_table.accepted' => 'Zendesk ticket not found in database. Are you sure this is correct?'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        //in laravel 9.x can do this with a Rule::excludeIf above
        if (in_array("override_warnings", array_keys($this->input())) && $this->override_warnings == "on")
        {
            $this->merge([
                'override_warnings' => true
            ]);
        }

        if ($this->zendesk_reference ?? null) {
            $this->merge([
                'in_zendesk_table' => ZendeskTicket::where('zendesk_id', str_replace("ZD-", "", strtoupper($this->zendesk_reference)))->exists()
            ]);
        } else {
            $this->merge([
                'override_warnings' => true
            ]);
        }

        if ($this->recieved_date_localized)
        {
            $this->merge([
                'recieved_date' => Carbon::parse($this->recieved_date_localized, $this->timezone)->setTimezone('UTC')
            ]);
        }
        $this->merge([
            'is_a_custom_sku' => $this->sku_id ? false : true,
        ]);
    }
}
