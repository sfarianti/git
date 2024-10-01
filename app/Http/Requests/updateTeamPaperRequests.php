<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class updateTeamPaperRequests extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'team_name' => [
                'required',
                Rule::unique('teams')->where(function ($query)  {
                    return $query->where('team_name', $this->input('team_name'))
                                 ->where('status_lomba', $this->input('status_lomba'));
                }),
            ],
            'category' => 'required',
            'theme' => 'required',
            'innovation_title' => 'required',
        ];
    }
}
