<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class externalRegisRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'team_name' => [
                'required',
                Rule::unique('teams')->where(function ($query)  {
                    return $query->where('team_name', $this->input('team_name'))
                                 ->where('status_lomba', $this->input('status_lomba'));
                }),
            ],
            'file_paper' => 'file|mimes:doc,docx,pdf|max:2048',
            'video' => 'file|mimes:mp4,mov,avi|max:20480',
            'ppt' => 'file|mimes:ppt,pptx,pdf|max:4096',
        ];
    }
}
