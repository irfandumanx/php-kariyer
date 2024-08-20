<?php

namespace Requests;

use Attributes\ExtractFromArrayAttribute;

class LoginRequest extends BaseRequest
{

    public string $username;
    public string $password;

    #[ExtractFromArrayAttribute]
    protected array $rules = [
        'username' => 'required',
        'password' => 'required',
    ];


}