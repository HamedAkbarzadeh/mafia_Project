<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'title' => 'required|max:500|min:2',
            'subject' => 'required|max:200000|min:2',
            'description' => 'required|max:200000|min:2',
            // 'keywords' => 'required|max:2000|min:2',
            'whiteLogo' => 'image|mimes:png,jpg,jpeg,gif',
            'blackLogo' => 'image|mimes:png,jpg,jpeg,gif',
            'icon' => 'image|mimes:png,jpg,jpeg,gif',
            'bannerImage' => 'image|mimes:png,jpg,jpeg,gif',
            'ruleImage' => 'image|mimes:png,jpg,jpeg,gif',
        ];
    }
}
