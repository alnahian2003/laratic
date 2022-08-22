<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = false;

    /**
     * The URI that users should be redirected to if validation fails.
     *
     * @var string
     */
    // protected $redirectRoute = 'index';

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'body' => 'required',
            'cover' => 'sometimes|file|max:10240|mimes:jpg,png,gif|nullable',
            'terms' => 'required|accepted'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'A nice post title is required!',
            'title.max' => ':attribute cannot be too long!',
            'body.required' => 'You must write something, dude!',
            'terms.required' => 'You must agree with our terms and conditions to proceed'
        ];
    }


    public function attributes()
    {
        return [
            'title' => 'Post title',
            'body' => 'Post details',
            'cover' => 'Cover image',
        ];
    }
}
