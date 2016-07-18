<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Proposal;
use Auth;
use Illuminate\Support\Facades\Input;

class ResponseFormRequest extends Request
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
        //check which submit was clicked on
        if(Input::get('disapprovalBtn')) {
            return [
                //
                'response' => 'required'
            ];
        }

        //return $this->rules();
        return [];
    }

}