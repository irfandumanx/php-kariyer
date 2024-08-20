<?php

namespace Requests;
use Reflections;

abstract class BaseRequest
{

    protected array $rules = [];

    public function __construct()
    {
        Reflections::fillFieldsWithDefaultValues($this);
    }

    public function validate()
    {
        $handlers = [];
        foreach ($this->rules as $field => $rule_) {
            $lastHandler = null;
            foreach (explode("|", $rule_) as $rule) {
                $ruleAndOptions = explode(":", $rule);
                $classPath = "Requests\\RequestsValidations\\".toPascalCase($ruleAndOptions[0])."Validation";
                $validationInstance = new $classPath();
                $validationInstance->options = array_slice($ruleAndOptions, 1) ?? [];
                if (array_key_exists($field, $handlers)) {
                    $lastHandler = $handlers[$field];
                    while ($lastHandler->getNextHandler() !== null) {
                        $lastHandler = $lastHandler->getNextHandler();
                    }
                    $lastHandler->setNext($validationInstance);
                }
                else
                    $handlers[$field] = $validationInstance;
            }
        }

        foreach ($handlers as $field => $handler) {
            $err = $handler->handle($field, Reflections::getField($this, $field));
            if ($err !== null)
                return $err;
        }
    }
}