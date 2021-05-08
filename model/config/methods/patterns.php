<?php
$patterns=[
    'default' => ['regex' => '/./'],
    'email' => ['regex' => '/[a-z\d]@[a-z\d]/'],
    'iban' => ['regex' => '/\d{16}/'],
    'phone' => ['regex' => '/^\+?\d{9,12}$/',
    'callback' => function($matches){
        return substr('+380', 0, 13-strlen($matches[0])) . $matches[0];
    }]
];