<?php

require_once "Models/User.php";

class userController
{
    public function register()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        header("Access-Control-Allow-Origin:  http://localhost:8100");
        header("Access-Control-Allow-Methods: POST, GET");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        
       
        if ($requestMethod === "POST"){
        $json = file_get_contents('php://input');

        $data = json_decode($json);
        $data = (array) $data;
        $username = $data["username"];
        $password = $data["password"];
        $email = $data["email"];
        header('Content-Type: application/json');
        if (!$username){
            echo json_encode(["error" => "Field username is required"]);
            return;
        }
        if (!$password){
            echo json_encode(["error" => "Field password is required"]);
            return;
        }
        if (!$email){
            echo json_encode(["error" => "Field email is required"]);
            return;
        }
        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($password);
        $register = $user->registerUser();
        if ($register) {
            echo json_encode($user->serialize());
            return;
        }
        http_response_code(500);
        echo json_encode(["error" => "An unexpected error happened, please try again later."]);
        return;
    }
    
    header('Content-Type: application/json');
    $data = ["error" => "Request must be POST"];
    http_response_code(200);
    echo json_encode($data);
    return;
    }

    public function error()
    {
        header('Content-Type: application/json');
        echo json_encode(["error" => "The page you request doesn't exist"]);
        return;
    }

    public function login()
    {
        $json = file_get_contents('php://input');

        $data = json_decode($json);
        $data = (array) $data;

        $username = $data["username"];
        $password = $data["password"];
        
        $password = md5($password);
        $requestMethod = $_SERVER["REQUEST_METHOD"];
       
        $req = User::checklogin($username, $password);
        if ($requestMethod === "POST"){
        if ($req) {
            http_response_code(200);
            header('Content-Type: application/json');

            $user = new User();
            $user->setId($req[0]);
            $user->setUsername($req[1]);
            $user->setEmail($req[2]);
            $user->setPassword($req[3]);
            echo json_encode($user->serialize());
            return;
        }
        http_response_code(200);
        header('Content-Type: application/json');

        $data = ["error" => "Please verify your credentials"];
        echo json_encode($data);
        return;
    }
        elseif ($requestMethod === "OPTIONS") {
            header('Access-Control-Allow-Headers:*');
            header('Access-Control-Allow-Origin: http://localhost:8100');  
            http_response_code(200);
            return;
        }
        else  {
            $data = ["error" => "Request must be POST"];
            header('Content-Type: application/json');

            http_response_code(500);
            echo json_encode($data);
            return;
        }
        
    }

    public function getAll()
    {

        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if ($requestMethod === "OPTIONS") {
            header("Access-Control-Allow-Origin:  http://localhost:8100");
            header("Access-Control-Allow-Methods: POST, GET");
            header("Access-Control-Allow-Headers: Content-Type, Authorization");
            http_response_code(200);
            return;
        }
    
        elseif ($requestMethod === "GET"){
            header('Content-Type: application/json');

            $users = User::getAll();

            if ($users) {
                http_response_code(200);
                echo json_encode($users);
                return;
            }
            http_response_code(404);
            echo json_encode(["error" => "No data can be found"]);
            return;
        }
   
        else {
            $data = ["error" => "Request must be GET"];
            http_response_code(500);
            echo json_encode($data);
            return;
        }
        
    }

    public function find()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if ($requestMethod === "OPTIONS") {
            header("Access-Control-Allow-Origin:  http://localhost:8100");
            header("Access-Control-Allow-Methods: POST, GET");
            header("Access-Control-Allow-Headers: Content-Type, Authorization");
            http_response_code(200);
            return;
        }
        
        elseif ($requestMethod === "GET"){
            header('Content-Type: application/json');
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri = explode('/', $uri);
            $id = $uri[3];
            if (is_numeric($id)) {
                $user = User::find($id);
                if ($user) {
                    http_response_code(200);
                    echo json_encode(User::create()->setId($user[0])->setUsername($user[1])->setEmail($user[2])->serialize());
                    return;
                } else {
                    http_response_code(404);
                    echo json_encode(["error" => "No user found"]);
                    return;
                }
            }
            http_response_code(500);
            echo json_encode(["error" => "Please verify that you typed an integer"]);
            return;
        }
  
    else {
        $data = ["error" => "Request must be GET"];
        http_response_code(500);
        echo json_encode($data);
        return;
    }

    }

    public function findOtherUsers () {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        header("Access-Control-Allow-Origin:  http://localhost:8100");
        header("Access-Control-Allow-Methods: POST, GET");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        if ($requestMethod === "GET") {
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri = explode('/', $uri);
            $id = $uri[3];
            if (is_numeric($id)) {
                $user = User::getAllU($id);
                if ($user) {
                    http_response_code(200);
                    header('Content-Type: application/json');
                    echo json_encode($user);
                    return;
                } else {
                    http_response_code(404);
                    header('Content-Type: application/json');
                    echo json_encode(["error" => "No users found"]);
                    return;
                }
            }
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(["error" => "Please verify that you typed an integer"]);
            return;
            
        }  
        header('Content-Type: application/json');
        $data = ["error" => "Request must be GET"];
        http_response_code(200);
        echo json_encode($data);
        return;

    }


}