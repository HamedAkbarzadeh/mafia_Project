<?php

namespace App\Http\Requests\Admin\Event;

use Illuminate\Foundation\Http\FormRequest;

class EventNotificationRequest extends FormRequest
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
            'title' => 'required|max:120|min:2',
            'body' => 'required|max:100000|min:5',
            'start_date' => 'required|numeric',
            'end_date' => 'required|numeric',
            'status' => 'required|numeric|in:0,1',
        ];
    }
}
