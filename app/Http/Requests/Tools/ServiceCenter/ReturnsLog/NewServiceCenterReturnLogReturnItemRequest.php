<?php

namespace App\Http\Requests\Tools\ServiceCenter\ReturnsLog;

use App\ZendeskTicket;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class NewServiceCenterReturnLogReturnItemRequest extends FormRequest
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
            'sku_id' => "required|exists:skus,id",
            'serial_number' => "string|nullable",
            'outcome' => [
                "nullable",
                Rule::in(array_keys(config("servicecenter.returnslog.return_item_outcomes")))
            ],
            'diagnosis' => "nullable|string",
            'pass' => "nullable|boolean",
            'notes' => "nullable|string",
        ];
    }
}
