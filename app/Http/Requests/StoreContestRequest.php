<?php

namespace App\Http\Requests;

use App\Models\Contest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StoreContestRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => $this->user()->id
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'uuid' => 'required|string|max:50',
            'contest_name' => 'required|string|max:1000',
            'event_id' => 'exists:events,id',
            'status' => 'required|boolean',
            'contest_date' => 'nullable|date',
        ];
    }
}
