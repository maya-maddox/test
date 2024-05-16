<?php

namespace App\Http\Requests\Tools\ServiceCenter\ReturnsLog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReturnsLogImportFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'returns_log_file' => 'required|file' //mimes:csv doens't work with test file?!?!
        ];
    }


}
