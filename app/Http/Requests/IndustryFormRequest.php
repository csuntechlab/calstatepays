<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;

class IndustryFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public $validator = null;

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
            'university' => ['required', 'regex:/^[a-z_A-Z]+$/u', Rule::exists('universities', 'short_name')->where('opt_in', 1)],
            'major' => 'required|integer|exists:hegis_codes,hegis_code',
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
        $request['major'] = $this->route('major');
        $request['university'] = $this->route('university');
        return $request;
    }
}
