<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'body'  => ['required', 'string'],
            'user_id' => ['required', 'integer'],
        ];
    }

    public function attributes(){
        return [
            'title' => 'Post Title',
            'body'  => 'Post Body',
            'user_id' => 'Post Author',
        ];
    }

    public function messages(){
        return [
            'title.required' => 'The :attribute is required now',
        ];
    }

    public function prepareForValidation(){
        $this->merge([
            'body' => \Str::slug($this->body),
            'title' => \Str::title($this->title),
        ]);
    }


}
