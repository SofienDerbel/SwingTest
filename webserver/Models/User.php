<?php


class User
{
    private $id;
    private $username;
    private $password;
    private $email;

    public function __construct()
    {

    }

    public static function create()
    {
        $instance = new self();
        return $instance;
    }

    public static function checklogin($username, $userpassword)
    {
        try {
            $req = Db::getInstance()->prepare('SELECT * FROM users WHERE username = :name AND password=:pass');
            $req->bindParam(':name', $username);
            $req->bindParam(':pass', $userpassword);
            $req->execute();
            return $req->fetch();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public static function find($id)
    {
        try {
            $req = Db::getInstance()->prepare('SELECT * FROM users WHERE id = :id');
            $req->bindParam(':id', $id);
            $req->execute();
            return $req->fetch();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public static function getAll()
    {
        try {
            $req = Db::getInstance()->prepare('SELECT * FROM users');
            $req->execute();
            $data = $req->fetchAll();
            if ($data) {
                $list = array();
                foreach ($data as $r) {
                    array_push($list, User::create()->setId($r[0])->setUsername($r[1])->setEmail($r[2])->serialize());
                }
                return $list;
            }
            return null;

        } catch (\PDOException $e) {
            return null;
        }
    }


    public static function getAllU($id)
    {
        try {
            $req = Db::getInstance()->prepare('SELECT * FROM `users` where users.id not in ( select tasks_users.user_id from tasks_users where tasks_users.task_id = :id) ');
            $req->bindParam(':id', $id);
            $req->execute();
            $data = $req->fetchAll();
            if ($data) {
                $list = array();
                foreach ($data as $r) {
                    array_push($list, User::create()->setId($r[0])->setUsername($r[1])->setEmail($r[2])->serialize());
                }
                return $list;
            }
            return null;

        } catch (\PDOException $e) {
            return null;
        }
    }

    public function registerUser()
    {
        try {
            $req = Db::getInstance()->prepare('INSERT INTO users (id,username,email,password) VALUES(NULL,?,?,?)');
            return $req->execute(array($this->username, $this->email, $this->password));
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function serialize()
    {
        return ["id" => $this->id,
            "username" => $this->username,
            "email" => $this->email,
            "password" => $this->password
        ];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = md5($password);
        return $this;
    }


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    


}

?>