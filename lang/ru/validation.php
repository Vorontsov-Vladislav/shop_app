<?php

return [
    'required' => 'Поле :attribute обязательно для заполнения.',
    'string' => 'Поле :attribute должно быть строкой.',
    'max' => [
        'string' => 'Поле :attribute не должно превышать :max символов.',
        'numeric' => 'Поле :attribute не должно превышать :max.',
    ],
    'numeric' => 'Поле :attribute должно быть числом.',
    'min' => [
        'numeric' => 'Поле :attribute должно быть не меньше :min.',
    ],
    'exists' => 'Выбранное значение для :attribute недопустимо.',

    // Общие сообщения для regex
    'regex' => 'Поле :attribute может содержать только кириллицу, цифры и пробелы',

    // Кастомные сообщения для отдельных полей
    'custom' => [
        'customer_name' => [
            'regex' => 'ФИО покупателя может содержать только кириллицу и пробелы.',
        ],
    ],

    // Кастомные названия полей
    'attributes' => [
        'name' => 'Название товара',
        'category_id' => 'Категория',
        'description' => 'Описание',
        'price' => 'Цена',
        'customer_name' => 'ФИО покупателя',
    ],
];