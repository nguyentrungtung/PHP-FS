<?php

return [
    'required' => ':attribute là bắt buộc.',
    'min' => [
        'numeric' => ':attribute phải có ít nhất là :min.',
        'string'  => ':attribute phải có ít nhất :min ký tự.',
    ],
    'max' => [
        'numeric' => ':attribute không được lớn hơn :max.',
        'string'  => ':attribute không được lớn hơn :max ký tự.',
    ],
    'integer' => ':attribute phải là số nguyên.',
    'mimes' => ':attribute phải là một tệp có định dạng: :values.',
    'file' => ':attribute phải là một tệp tin.',
    'image' => ':attribute phải là hình ảnh.',
];
