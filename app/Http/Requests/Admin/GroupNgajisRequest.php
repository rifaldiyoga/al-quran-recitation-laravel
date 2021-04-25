<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GroupNgajisRequest extends FormRequest
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
            'group_name' => ['required', 'string', 'max:255'],
            'group_desc' => ['required', 'string'],
            'img_src' => ['required', 'image'],
            // 'slug' => ['required', 'string', 'max:255'],
            // 'created_by' => ['required', 'integer'],
            'access_type' => ['required', 'string'],
            'group_type' => ['required', 'string', 'max:255']
        ];
    }
}
