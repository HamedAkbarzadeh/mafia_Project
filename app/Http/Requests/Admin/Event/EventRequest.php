<?php

namespace App\Http\Requests\Admin\Event;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'type_game' => 'required|numeric|in:0,1,2',
            'price' => 'required|numeric', 
            'pay_citizen_win' => 'required|numeric', 
            'pay_mafia_win' => 'required|numeric', 
            'pay_independent_win' => 'required|numeric', 
            'start_date' => 'required|numeric', 
            'amount_of_players' => 'required|numeric|min:8|max:30', 
            'god_names' => 'nullable|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            'game_status' => 'nullable|numeric|in:0,1',
            'complation_status' => 'required|numeric|in:0,1',
            'vip_game' => 'nullable|numeric|in:0,1',
            'mafiaRole' => 'required',
            'citizenRole' => 'required',
            'independentRole' => 'nullable', 
        ];
    }
}
