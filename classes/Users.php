<?php
require_once("DB.php");


class Users extends DB{

    public function fetchUser($user_id){
        $sql = "SELECT * FROM user_table WHERE user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function login_user($user_email,$password,$cis){
        $sql = "SELECT * FROM user_table WHERE user_email = ? AND cis_no=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_email,$cis]);
        $email_exists = $stmt->rowCount();

        if($email_exists<1){
            return "Email or password is wrong";
            exit();
        }
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // $user_password = $user["user_password"];

        // echo($password."<br>");
        // echo($user_password."<br>");
        // echo($user["user_password"]);
        
        if(!password_verify($password, $user["user_password"])){
            return "Either email of Password is wrong";
                exit();
        }

        $_SESSION["is_logged_in"] = true;
        $_SESSION["user_id"]= $user["user_id"];
        $_SESSION['username'] = $user["user_name"];
        $_SESSION['useremail'] = $user["user_email"];
        $_SESSION['cisno']= $user["cisno"];
        // $_SESSION['userpwd'] = $user["user_password"];
        $_SESSION['userpic'] = $user["user_profile_pic"];
        return "SUCCESS";  
    }

    public function register_user($name,$email,$password,$cis)
    {
            if($this->check_if_user_exist($email) > 0){
                return "Email already registered, do you want to <a href='login.php'>LOGIN</a>xxxxxxxxx";
            }
            $sql= "INSERT INTO user_table(user_name, user_email, user_password,cis_no) VALUES(?,?,?,?)";
            $stmt=$this->connect()->prepare($sql);
            $result=$stmt->execute([$name,$email, $password,$cis]);
            
            if($result){
                return "Account Created!!!!";
            }
    }

    public function check_if_user_exist($email)
    {
            $sql = "SELECT * FROM user_table WHERE user_email=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$email]);
            $numberofUsers = $stmt->rowCount();
            return $numberofUsers;
    }

    public function create_user($name,$email,$location,$cis)
    {
        if($this->check_if_user_exist($email) > 0){
                return "Email already registered, do you want to <a href='login.php'>LOGIN</a>xxxxxxxxx";
            }
        $sql = "INSERT INTO user_table(user_name,user_email,user_office_location,cis_no) VALUES(?,?,?,?)";
        $stmt=$this->connect()->prepare($sql);
        $result=$stmt->execute([$name,$email,$location,$cis]);
            
            if($result){
                return "Account Created!!!!";
            }
    }

    public function select_all(){
        $sql = "SELECT * FROM user_table";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array());
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }    
    public function select_all_admin(){
        $sql = "SELECT * FROM admin_table";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array());
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
    public function count_admin(){
        $sql = "SELECT * FROM `admin_table`";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function count_user(){
        $sql = "SELECT * FROM `user_table`";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function select_user_details($id){
        $sql = "SELECT * FROM user_table WHERE user_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update_user_details($username,$email,$location,$id){
        $sql = "UPDATE `user_table` SET user_name=?,user_email=?,user_office_location=? WHERE user_id=?";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$username,$email,$location,$id]);
        return $result;
    }

    public function updateProfileImage($images,$id){
        $sql = "UPDATE user_table SET user_profile_pic=? WHERE user_id=?";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$images,$id]);
        return $result;
    }

    public function insert_message($name,$email,$messages){
        $sql = "INSERT INTO messages(user_name,user_email,user_message) VALUES(?,?,?) ";
        $stmt=$this->connect()->prepare($sql);
        $result=$stmt->execute([$name,$email,$messages]);
        return $result;
    }

    public function show_message(){
        $sql = "SELECT * FROM messages";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array());
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function count_message(){
        $sql = "SELECT * FROM `messages`";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }


}
// $user =new Users;
// $all = $user->login_user("op@email.com","1232");
// print_r($all);
// // print_r();

?>