<?php

namespace App\Http\Requests\Tools\ServiceCenter;

use DateTimeZone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class NewServiceCenterRequest extends FormRequest
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
            'name' => 'required|string|unique:service_centers,name',
            'code' => 'required|string|max:3|unique:service_centers,code',
            'location' => 'required|string',
            'timezone' => [
                'required',
                'string',
                Rule::in(DateTimeZone::listIdentifiers())
            ]
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'code' => strtoupper($this->code)
        ]);
    }
}
