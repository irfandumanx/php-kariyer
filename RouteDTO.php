<?php

class RouteDTO
{
    private String $class;
    private String $classMethod;
    private array $queryString = [];

    public function __construct(public String $url, public String $method)
    {
        $parsedUrl = parse_url($this->url);
        $this->url = $parsedUrl['path'];
        parse_str($parsedUrl['query'] ?? "", $this->queryString);
    }

    public function getQueryString(): array
    {
        return $this->queryString;
    }

}
