<?php

namespace Dizatech\ModuleMenu\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuItemRequest extends FormRequest
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
            'title' => ['nullable','string','max:255'],
            'css_class' => ['nullable','string','max:255'],
            'status' => ['required','in:0,1'],
            'type' => ['required', 'in:custom,group,heading,news,news_category,article,article_category,video,video_category,service,service_category,laboratory,equipment'],
            'parent_id' => ['integer'],
        ];
    }

    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
        $validator->sometimes(
            'title',
            ['required', 'string'],
            [$this, 'checkIfTypeIsCustom']
        );
        $validator->sometimes(
            'title',
            ['required', 'string'],
            [$this, 'checkIfTypeIsHeading']
        );
        $validator->sometimes(
            'url',
            ['required', 'string'],
            [$this, 'checkIfTypeIsCustom']
        );
        $validator->sometimes(
            'object_id',
            ['required', 'integer'],
            [$this, 'checkIfHasDynamicType']
        );
        return $validator;
    }

    public function checkIfTypeIsCustom($input)
    {
        return $input->type == 'custom';
    }

    public function checkIfTypeIsHeading($input)
    {
        return $input->type == 'heading';
    }

    public function checkIfHasDynamicType($input)
    {
        return ($input->type != 'heading' && $input->type != 'custom' && $input->type != 'group');
    }

    public function messages()
    {
        return [
            'status.required' => 'فیلد وضعیت الزامی است.',
            'object_id.required' => 'این فیلد الزامی است.',
            'type.required' => 'فیلد نوع الزامی است.',
            'css_class.string' => 'فیلد کلاس css معتبر نیست.',
            'type.in' => 'لطفا نوع منو را انتخاب کنید',
        ];
    }


}
