<?php
    include 'Database.php';

class User extends Database{

    public function store($request){
        $firstname = $request['firstname'];
        $lastname  = $request['lastname'];
        $username  = $request['username'];
        $password  = $request['password'];

        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (`first_name`, `last_name`, `username`, `password`) VALUES ('$firstname','$lastname','$username','$password')";

        if($this->conn->query($sql)){
                header('location:../views');
                exit;
        }else{
            die('error in creating the user'. $this->conn->error);
        }
    }

    public function login($request){
        $username = $request['username'];
        $password = $request['password'];

        $sql = "SELECT * FROM users WHERE username = '$username'";

        if($result = $this->conn->query($sql)){
            if($result->num_rows == 1){
                $user = $result->fetch_assoc();
                
                if(password_verify($password, $user['password'])){
                    session_start();

                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['password'] = $user['password'];
                    $_SESSION['fullname'] = $user['first_name']." ".$user['last_name'];
                    header('location:../views/dashboard.php');
                    exit;
                }
            }
        }
    }

    public function getAllUsers(){
        $sql = "SELECT *  FROM users";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die('Error in retrieving all users: '.$this->conn->error);
        }
    }
    public function getUser(){
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM users WHERE id =". $_SESSION['id'];
        // ※タクちゃんにきく
        // SELECT->縦　WHERE->横の呼出
        // usernameなどを指定すると、今ログインしている人以外の情報まで持ってきてしまう為、idを指定する
        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        }else{
            die('Error in retrieving the user:'.$this->conn->error);
        }
    }
    public function update($request,$files){
        session_start();
        $id = $_SESSION['id'];
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $username = $request['username'];

        $photo  = $files['photo']['name'];
        $photo_tmp =$files['photo']['tmp_name'];

        $sql = "UPDATE users SET 
        first_name = '$firstname',
        last_name = '$lastname',
        username = '$username'
        WHERE id = '$id'";

        if($this->conn->query($sql)){
            $_SESSION['username'] = $username;
            $_SESSION['fullname'] = $firstname."".$lastname;
            
            if($photo){
                $sql = "UPDATE users SET photo = '$photo' WHERE id = $id";
                $destination = "../assets/images/$photo";

                if($this->conn->query($sql)){
                    if(move_uploaded_file($photo_tmp,$destination)){
                        header('location:../views/dashboard.php');
                        exit;
                        // 上の要求が通ったら実行される
                    }else{
                        die('Error in moving the photo.');
                    }
                }
            }else{
                die('error in updating the image'.$this->conn->error);
            }
            }


        }
   
    public function delete(){
        session_start();
        $id = $_SESSION['id'];

        $sql = "DELETE FROM users WHERE id = '$id' ";
        if($this->conn->query($sql)){
            #DESTROY SESSION
            $this->logout();
        }else{
            die('error in deleting the user'.$this->conn->error);
        }
            
    }

    // ※タクちゃんにきく->解決
    public function logout(){
        session_start();
        session_unset();
        // unsetは中身を空にする
        session_destroy();
        // 中身を破壊する

        header('location:../views/');
        // 省略されているだけで、index.phpにとぶ
        exit;
    }

    // session_startは共有フォルダーをこれから使いまーすの宣言



}

?>