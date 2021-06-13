<?php

namespace Dizatech\ModuleMenu\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FrontMenuRequest extends FormRequest
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
            'title' => ['required','string','max:255'],
            'css_class' => ['nullable','string','max:255'],
            'url' => ['nullable','string','max:255'],
            'menu_status' => ['required','in:0,1'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'فیلد عنوان الزامی است.',
            'menu_status.required' => 'فیلد وضعیت الزامی است.',
            'css_class.string' => 'فیلد کلاس css معتبر نیست.',
            'url.string' => 'فیلد url معتبر نیست.',
        ];
    }
}
