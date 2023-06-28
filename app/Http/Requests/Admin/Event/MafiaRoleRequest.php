<?php

namespace App\Http\Requests\Admin\Event;

use Illuminate\Foundation\Http\FormRequest;

class MafiaRoleRequest extends FormRequest
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
            'name' => 'required|max:240|min:2',
            'description' => 'required|max:1000000|min:5',
            'side' => 'required|numeric|in:0,1,2',
            'game_type' => 'required|numeric|in:0,1',
            'status' => 'required|numeric|in:0,1',
        ];
    }
}
