<?php
namespace App\Validation;
use Validator;

class UserValidator
{
    public function validate($input)
    {
        $rules = [
            'name' => 'Required|Min:4|Max:80|alpha_spaces',
            'info' => 'Required'
        ];

        return Validator::make($input, $rules);
    }
}