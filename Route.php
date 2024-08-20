<?php

use Attributes\LoginRequiredAttribute;
use Attributes\RoleRequiredAttribute;
use Requests\Request;

class Route
{
    private $routes = [];

    function get(String $url, string $class, string $method): void
    {
        $this->saveRoute("GET", $url, $class, $method);
    }

    function post(String $url, string $class, string $method): void
    {
        $this->saveRoute("POST", $url, $class, $method);
    }

    function put(String $url, string $class, string $method): void
    {
        $this->saveRoute("PUT", $url, $class, $method);
    }

    function delete(String $url, string $class, string $method): void
    {
        $this->saveRoute("DELETE", $url, $class, $method);
    }

    function match(array $types, String $url, string $class, string $method): void
    {
        foreach ($types as $type) {
            $uppStr = strtoupper($type);
            $this->saveRoute($uppStr, $url, $class, $method);
        }
    }

    function saveRoute(String $type, String $url, string $class, string $method): void
    {
        $this->routes[$type][$url] = [$class, $method];
    }

    function findAndExecute(RouteDTO $dto): void
    {
        if (str_ends_with($dto->url, "/") && $dto->url !== "/") $dto->url = substr($dto->url, 0, -1);
        if (!isset($this->routes[$dto->method]) || !isset($this->routes[$dto->method][$dto->url])) {
            view("no-page");
            return;
        }
        $controllerMethod = $this->routes[$dto->method][$dto->url];
        $controller = $controllerMethod[0];
        $method = $controllerMethod[1];
        $instance = new $controller;
        $instance->routeDTO = $dto;
        $reflect = new ReflectionMethod($controller, $method);
        $attr = Reflections::getClassAttr($instance, LoginRequiredAttribute::class);
        $methodAttr = Reflections::getMethodAttr($reflect, LoginRequiredAttribute::class);
        if ((count($attr) > 0 || count($methodAttr) > 0) && !isset($_SESSION['id'])) {
            redirect(Env::LOGIN_PAGE->getEnvValue());
            return;
        }

        $classRoleAttr = Reflections::getClassAttr($instance, RoleRequiredAttribute::class);
        $methodRoleAttr = Reflections::getMethodAttr($reflect, RoleRequiredAttribute::class);
        if (count($classRoleAttr)) {
            $classRoleAttr = $classRoleAttr[0]->newInstance();
            if ($classRoleAttr->role != $_SESSION['role']) {
                view("no-permission");
                return;
            }
        }else if (count($methodRoleAttr)) {
            $methodRoleAttr = $methodRoleAttr[0]->newInstance();
            if ($methodRoleAttr->role != $_SESSION['role']) {
                view("no-permission");
                return;
            }
        }

        if ($dto->method === "GET" || $dto->method === "POST" || $dto->method === "UPDATE" || $dto->method === "DELETE") {
            $parameterCount = count($reflect->getParameters());
            if ($parameterCount > 1)
                throw new Exception("Method $method cannot take more than 1 parameter", code: 503);
            else if ($parameterCount == 0) {
                $instance->$method();
                return;
            }

            $parameterClassName = $reflect->getParameters()[0]->getType()->getName();

            if ($parameterClassName === Request::class) {
                $request = new Request();
                foreach ($_POST as $name => $value) {
                    $request->$name = $value;
                }
                $instance->$method($request);
            } else {
                $reqInstance = cast($parameterClassName, $_POST);
                if ($dto->method !== "GET") {
                    $error = $reqInstance->validate();
                    if ($error !== null)
                        $instance->err = $error;
                }
                $instance->$method($reqInstance);
            }
        }
    }

}

