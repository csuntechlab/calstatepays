<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MajorFormRequest extends FormRequest
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
            'major' => 'required|integer',
            'university' => 'required|string',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->validator = $validator;
    }

    public function all()
    {
        // Include the next line if you need form data, too.
        $request = Input::all();
        $request['hegis_code'] = $this->route('hegis_code');
        $request['universityName'] = $this->route('universityName');
        return $request;
    }
}
