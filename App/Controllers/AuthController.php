<?php

namespace App\Controllers;

use App\Helpers\Views;
use App\Models\User;
use App\Models\Task;

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
    public function task()
    {
        if(isset($_POST['ok']))
        {
            $title=$_POST['title'];
            $desc=$_POST['desc'];
            $data = explode('.', $_FILES['rasm']['name']);
            $filePath = date('Y-m-d_H-i-s') . '.' . $data[1];
            move_uploaded_file($_FILES['rasm']['tmp_name'], 'rasm/' . $filePath);
            $user_id=$_POST['user_id'];
            $status=$_POST['status'];

            $task=['title'=>$title,
            'description'=>$desc,
            'img'=>$filePath,
            'user_id'=>$user_id,
            'status'=>$status,
        'comment'=>''];
        Task::create($task);
        header("location: /admin");

        }
    }
    public function userpage()
    {
        if(isset($_SESSION['Auth']))
        {
            return view('user', 'User');
        }else
        {
            header("location: /login");
        }
    }
    public function admin()
    {
        // dd(123);
        return view('admin', 'Admin');
    }
    public function registerPage()
    {
        return view('/register', 'Register');
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
                $check=User::detect($email);
                if($check)
                {
                    header("location: /register");
                }else
                {
                    User::create($data);
                    header("location: /user");
                }
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
