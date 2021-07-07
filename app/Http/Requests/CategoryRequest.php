<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $id = $this->route('id');
        return [

            'name' => [
                'required',
                'alpha',
                'max:255',
                'min:3',
                //'unique:categories,name,$id'],
                // (new Unique('categories','name'))->ignore($id),
                Rule::unique('categories', 'name')->ignore($id),
            ],
            'description' => [
                'nullable',
                'max:255',
                'required',
                /*function ($attribute, $value, $fail) {
                    if (stripos($value, 'laravel') !== false) {
                        $fail('you can not use the word "laravel"!');
                    }
                }*/
                //new WordFilter(['laravel', 'php']),
                'filter:laravel,php',
            ],
            'parent_id' => [
                'nullable',
                'exists:categories,id',

            ],
            'image' => [
                //'nulable',
                'image',
                //'max:1048576',
                //'dimensions:min_width=300,min_height=300'
            ],
            'status' => 'required|in:active,inactive',
        ];
    }
}
