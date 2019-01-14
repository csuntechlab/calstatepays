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
            'university' => ['required', 'regex:/^[a-z_A-Z]+$/u',Rule::exists('universities', 'short_name')->where('opt_in', 1)],
            'major' => 'required|integer|exists:hegis_codes,hegis_code',
            'age_range' => 'required|integer|min:1|max:4',
            'education_level' => 'required|string|min:3|max:3',
            'annual_earnings' => 'required|integer|min:1|max:5',
            'financial_aid' => 'required|integer|min:1|max:5',
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
        $request['major'] = $this->route('major');
        $request['university'] = $this->route('university');
        $request['age_range'] = $this->route('age_range');
        $request['education_level'] = $this->route('education_level');
        $request['annual_earnings'] = $this->route('annual_earnings');
        $request['financial_aid'] = $this->route('financial_aid');
        // dd($request);
        return $request;
    }
}