<?php

namespace ActivismeBE\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed author_id
 */
class HelpdeskQuestionValidator extends FormRequest
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
            'title'         => 'required',
            'category_id'   => 'required',
            'description'   => 'required',
            'publish'       => 'required',
        ];
    }
}
