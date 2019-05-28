<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;

class FREFormRequest extends FormRequest
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
        $error = [
            'entry_status'          => 'required|string|min:3|max:3',
            'major'                 => 'required|string',
            'in_school_earning'     => 'required|integer|min:0|max:10500',
            'financial_aid'         => 'required',
        ];
        return $error;
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->validator = $validator;
    }

    public function all()
    {
        // Include the next line if you need form data, too.
        $request = Input::all();
        $request['entry_status'] = $this->route('entry_status');
        $request['in_school_earning'] = $this->route('in_school_earning');
        $request['financial_aid'] = $this->route('financial_aid');
        return $request;
    }
}
