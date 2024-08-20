<?php

namespace Requests;

use Attributes\ExtractFromArrayAttribute;

class RegisterRequest extends BaseRequest
{

    public string $name;
    public string $surname;
    public string $username;
    public string $email;
    public string $password;

    #[ExtractFromArrayAttribute]
    protected array $rules = [
        'name' => 'required|max_len:50',
        'surname' => 'required|max_len:50',
        'username' => 'required|min_len:5|max_len:50',
        'email' => 'required|email|max_len:100',
        'password' => 'required|max_len:255',
    ];


}