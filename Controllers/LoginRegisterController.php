<?php

namespace Controllers;

use Guid;
use Models\UserModel;
use Reflections;
use Requests\LoginRequest;
use Requests\RegisterRequest;
use Role;

class LoginRegisterController extends BaseController
{

    public function __construct(private readonly UserModel $userModel = new UserModel()){}

    public function login(LoginRequest $request): void
    {
        if ($this->isGet()) {
            if(isset($_SESSION['id']))
                redirect("/");
            else
                view("login");
            return;
        }
        if (!empty($this->err)) {
            view("login", ['error' => $this->err]);
            return;
        }

        $user = $this->userModel
            ->whereOr("username", $request->username)
            ->where("email", $request->username)
            ->find();

        if($user === null || !password_verify($request->password, $user->password)) {
            view("login", ['error' => "Kullanıcı adı veya şifre yanlış"]);
            return;
        }

        $_SESSION['id'] = $user->id; $_SESSION['name'] = $user->name;
        $_SESSION['surname'] = $user->surname; $_SESSION['username'] = $user->username;
        $_SESSION['email'] = $user->email; $_SESSION['role'] = Role::from($user->role_name);
        redirect("/");
    }

    public function register(RegisterRequest $request): void
    {
        if ($this->isGet()) {
            if(isset($_SESSION['id'])) redirect("/");
            else view("register");
            return;
        }
        if (!empty($this->err)) {
            view("register", ['error' => $this->err]);
            return;
        }

        $id = Guid::generate();
        $request->password = password_hash($request->password, PASSWORD_DEFAULT);
        $data = Reflections::toArray($request);
        $data['id'] = $id;
        $success = $this->userModel->insert($data);
        if ($success == -1) {
            view("register", ['error' => "Kullanıcı adı ya da mail kullanılıyor olabilir!"]);
            return;
        }

        $_SESSION['id'] = $id; $_SESSION['name'] = $request->name;
        $_SESSION['surname'] = $request->surname; $_SESSION['username'] = $request->username;
        $_SESSION['email'] = $request->email;

        redirect("/");
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
        redirect("/login");
    }

}