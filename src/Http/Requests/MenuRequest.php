<?php

namespace Dizatech\ModuleMenu\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'title' => 'required',
            'name' => ['required','username'],
            'icon' => 'required',
            'route' => 'required',
            'parent_id' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'فیلد عنوان الزامی است',
            'name.required' => 'فیلد نام الزامی است',
            'name.username' => 'فیلد نام میتواند شامل حروف انگلیسی، اعداد و ـ می تواند باشد',
            'icon.required' => 'فیلد آیکون الزامی است',
            'route.required' => 'فیلد مسیر الزامی است',
        ];
    }
}
