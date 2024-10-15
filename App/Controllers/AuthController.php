<?php

namespace App\Controllers;

use App\Helpers\Views;
use App\Models\User;

class Authcontroller
{
    public function __construct()
    {
        //layout(loginMain);
    }
    public function loginpage()
    {
        // dd(123);
        return view('auth/login', 'Login');
    }
    public function taskpage()
    {
        // dd(123);
        return view('task', 'Task');
    }
    public function userpage()
    {
        // dd(123);
        return view('user', 'User');
    }
    public function registerPage()
    {
        return view('auth/register', 'Register');
    }
    public function register()
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password1=$_POST['password1'];
        $password2=$_POST['password2'];
        if($password1 !=$password2)
        {
            header("location: /register");
        }
        else{
            if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password1']) && isset($_POST['password2']))
            {
                $password=md5($password1);
                $data = [
                    'name'=>$_POST['name'],
                    'email' => $_POST['email'],
                    'password' => $password,
                    'status' => 'user'
                ];
                User::create($data);
                header("location: /user");
            }
        }
    }
    public function login()
    {
        $data = [
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];
        $user = User::attach($data);
        if ($user->status=="admin") {
            $_SESSION['Auth'] = $user;
            return view('admin','ADMIN');
        
        }
        if($user->status=='user')
        {
            $_SESSION['Auth']=$user;
            return view('user',"User");
        } 
        else {
            $_SESSION['message'] = 'email yoki password xato';
            header('location: /login');
        }
    }
    public function logout()
    {
        unset($_SESSION['Auth']);
        header("location: /login");
    }
}
