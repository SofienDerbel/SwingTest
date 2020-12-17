<?php

require_once "Models/User.php";
class Task
{
    private $id;
    private $title;
    private $subject;
    private $max;
    private $users = array();
    public function __construct()
    {
       
    }

    public static function create()
    {
        // I use factory to create new instance of our object and then call setters for attributes
        $instance = new self();
        return $instance;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }


    public function setMax($max)
    {
        $this->max = $max;
        return $this;
    }

    public static function getAll()
    {
        try {
            $req = Db::getInstance()->prepare('SELECT * FROM tasks');
            $req->execute();
            $data = $req->fetchAll();
            
            if ($data) {
                $list = array();
                foreach ($data as $r) {
                    array_push($list, Task::find($r[0]));
                }
                return $list;
            }
            return null;

        } catch (\PDOException $e) {
            return null;
        }
    }

    public function addTask()
    {
        try {
            $req = Db::getInstance()->prepare('INSERT INTO tasks (id,title,subject,max) VALUES(NULL,?,?,?)');
            return $req->execute(array($this->title, $this->subject, $this->max));
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function serialize()
    {
        $data = ["id" => $this->id , "title" => $this->title,
        "subject" => $this->subject,
        "max" => $this->max ];
        $users = array();
        foreach($this->users as $u){
            array_push($users, $u->serialize());
        }
        $data["users"] = $users;
        return $data;
    }

    public static function find($id)
    {
        try {
            $req = Db::getInstance()->prepare('SELECT tasks.id, tasks.title, tasks.subject, tasks.max, users.id, users.email, users.username FROM tasks LEFT JOIN tasks_users on tasks_users.task_id = tasks.id LEFT JOIN users on tasks_users.user_id = users.id WHERE tasks.id = :id');
            $req->bindParam(':id', $id);
            $req->execute();
            $data = $req->fetchAll();
            if ($data){
        
                $list = array();
                $task = Task::create()->setId($data[0][0])->setTitle($data[0][1])->setSubject($data[0][2])->setMax($data[0][3]);
                
                foreach($data as $item){
                    
                    $task->setUser(User::create()->setId($item[4])->setEmail($item[5])->setUsername($item[6]));
                }
                array_push($list,$task->serialize());
                return $list;
            }else{
                return null;
            }
            
        } catch (\PDOException $e) {
            return null;
        }
    }

    public static function affectUser($task_id, $user_id){
        try {
            $req = Db::getInstance()->prepare('INSERT into tasks_users(task_id, user_id) VALUES (?,?)');
            if ($req->execute(array($task_id, $user_id))){
                return Task::find($task_id);
            }else{
                return null;
            }   
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function setUser($user){
        array_push($this->users, $user);
        return $this;
    }

    public function getUsers(){
        return $this->users;
    }
}

?>