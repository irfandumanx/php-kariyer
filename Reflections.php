<?php

use Attributes\ExtractFromArrayAttribute;

class Reflections
{
    static function getField($object, $fieldName) {
        $reflection = new ReflectionClass($object);
        $property = $reflection->getProperty($fieldName);
        $property->setAccessible(true);
        return $property->getValue($object);
    }

    static function getClassAttr(object $instance, string $attr): array
    {
        $reflectionObj = new ReflectionObject($instance);
        return $reflectionObj->getAttributes($attr);
    }

    static function getMethodAttr(ReflectionMethod|string $method, string $attr): array
    {
        if (is_string($method)) $method = new ReflectionMethod($method);
        return $method->getAttributes($attr);
    }

    static function getFieldAttr(ReflectionProperty $prop, string $attr): array
    {
        return $prop->getAttributes($attr);
    }

    static function toArray($obj): array
    {
        $reflectionClass = new ReflectionClass($obj);
        $properties = $reflectionClass->getProperties();

        foreach ($properties as $property) {
            if(count(self::getFieldAttr($property, ExtractFromArrayAttribute::class)))
                continue;
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($obj);
        }

        return $array;
    }

    static function fillFieldsWithDefaultValues($obj): void
    {
        $reflection = new ReflectionClass($obj);
        foreach ($reflection->getProperties() as $property) {
            if ($property->isInitialized($obj) === false) {
                $propertyName = $property->getName();
                $obj->$propertyName = Reflections::initializeProperty($property->getType()->getName());
            }
        }
    }

    private static function initializeProperty($type): bool|array|int|string|null
    {
        return match ($type) {
            'float' => 0.0,
            'int' => 0,
            'string' => '',
            'array' => [],
            'bool' => false,
            default => null,
        };
    }

}