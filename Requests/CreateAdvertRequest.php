<?php

namespace Requests;

use Attributes\ExtractFromArrayAttribute;

class CreateAdvertRequest extends BaseRequest
{

    public string $title;
    public string $description;

    #[ExtractFromArrayAttribute]
    protected array $rules = [
        'title' => 'required|max_len:255',
        'description' => 'required',
    ];


}