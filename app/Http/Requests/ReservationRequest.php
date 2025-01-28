<?php

namespace App\Http\Requests;

use App\Rules\CarAvailable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'car_id' => [
                'required',
                'exists:cars,id',
                new CarAvailable($this->started_at, $this->ended_at),
            ],
            'started_at' => 'required|date|after:now',
            'ended_at' => 'required|date|after:started_at',
        ];
    }

    public function messages()
    {
        return [
            'car_id.required' => 'Car ID is required',
            'car_id.exists' => 'The selected car does not exist',
            'started_at.required' => 'Start time is required',
            'started_at.after' => 'Start time must be in the future',
            'ended_at.required' => 'End time is required',
            'ended_at.after' => 'End time must be after the start time',
        ];
    }

    protected function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if ($this->input('ended_at') && $this->input('started_at')) {
                $duration = strtotime($this->input('ended_at')) - strtotime($this->input('started_at'));
                if ($duration < 1800) {
                    $validator->errors()->add('duration', 'The reservation must be at least 30 minutes.');
                }
            }
        });
    }
}
