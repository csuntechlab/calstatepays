<?php
 namespace App\Http\Requests;
 use Illuminate\Foundation\Http\FormRequest;
 use Illuminate\Support\Facades\Input;

 
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
        return [
            'major' => 'required|integer',
            'university' => 'required|string',
            'age_range' => 'required|integer|max:1',
            'education_level' => 'required|integer|max:1',
            'annual_earning' => 'required|integer|max:1',
            'financial_aid' => 'required|integer|max:1',
            'hegis_code' => 'required|integer',
            'universityName' => 'required|string',
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
        $request['age_range'] = $this->route('age_range');
        $request['education_level'] = $this->route('education_level');
        $request['annual_earning'] = $this->route('annual_earning');
        $request['financial_aid'] = $this->route('financial_aid');
        $request['hegis_code'] = $this->route('hegis_code');
        $request['universityName'] = $this->route('universityName');
        return $request;
    }
}