<?php

namespace Corp\Http\Requests;

use Corp\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class ArticleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->canDo('ADD_ARTICLES');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required|max:255',
            'alias'         => 'required|unique:articles|max:255',
            'text'          => 'required',
            'category_id'   => 'required|integer'
        ];
    }
}
