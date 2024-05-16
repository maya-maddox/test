<?php

namespace App\Http\Requests\Stores;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SwytchSkuTypeUpdateAssignmentsRequest extends FormRequest
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
            'sku_assignments' => "array",
            'sku_assignments.sku_id' => 'exists:sku.id',
            'sku_assignements.sku_type_id' => 'nullable|exists:sku_type.id'
        ];
    }


    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $inputs = $this->except('_token');
        $inputs = array_map(fn ($key, $val)  => ["sku_id" => $key, "sku_type_id" => $val == 0 ? null : $val], array_keys($inputs), $inputs);
        $this->merge(["sku_assignments" => $inputs]);
    }


}
