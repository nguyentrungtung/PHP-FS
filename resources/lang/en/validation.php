<?php

function getMessages(){
    return [
        'required' => 'The :attribute field is required.',
        'min' => [
            'string' => 'The :attribute must be at least :min characters.',
            'numeric' => 'The :attribute must be at least :min.',
        ],
        'max' => [
            'string' => 'The :attribute may not be greater than :max characters.',
            'numeric' => 'The :attribute may not be greater than :max.',
        ],
        'email' => 'The :attribute must be a valid email address.',
        'numeric' => 'The :attribute must be a number.',
        'between' => [
            'numeric' => 'The :attribute must be between :min and :max.',
            'file' => 'The :attribute must be between :min and :max kilobytes.',
            'string' => 'The :attribute must be between :min and :max characters.',
            'array' => 'The :attribute must have between :min and :max items.',
        ],
        'date'=> 'The :attribute must be a valid date.',
        'digits_between'=>'The :attribute must be a valid number of digits and must be between :between',
        'integer' => 'The :attribute must be a valid integer.',
    ];
}
