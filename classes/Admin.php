<?php
require_once("DB.php");

class Admin extends DB{

    public function fetchAdmin($admin_id){
        $sql = "SELECT * FROM admin_table WHERE admin_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$admin_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function login_user($admin_email,$admin_password){
        $sql = "SELECT * FROM admin_table WHERE admin_email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$admin_email]);
        $email_exists = $stmt->rowCount();

        if($email_exists<1){
            return "Email or password is wrong";
            exit();
        }
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION["is_logged_in"] = true;
        $_SESSION["admin_id"]= $admin["admin_id"];
        $_SESSION['admin_name'] = $admin["admin_name"];
        $_SESSION['admin_email'] = $admin["admin_email"];
        return "SUCCESS";  
    }

    public function register_admin($name,$email,$password)
    {
            if($this->check_if_admin_exist($email) > 0){
                return "Email already registered, do you want to <a href='login.php'>LOGIN</a>xxxxxxxxx";
            }
            $sql= "INSERT INTO admin_table(admin_name, admin_email, admin_password) VALUES(?,?,?)";
            $stmt=$this->connect()->prepare($sql);
            $result=$stmt->execute([$name,$email, $password]);
            
            if($result){
                return "Account Created!!!!";
            }
    }

    public function check_if_admin_exist($email)
        {
            $sql = "SELECT * FROM admin_table WHERE admin_email=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$email]);
            $numberofUsers = $stmt->rowCount();
            return $numberofUsers;
        }


    public function fetch_categories(){
        $sql = "SELECT * FROM book_category";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array());
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }    
    public function fetch_allcategories($id){
        $sql = "SELECT * FROM book_category WHERE id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array($id));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }    
    public function fetch_allsubcategories($id){
        $sql = "SELECT * FROM sub_category WHERE `sid`=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array($id));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }    


    public function add_category($category){

        if ($this->check_if_category_exist($category)>0){
            return "This Category already exists";
        }
        $sql = "INSERT INTO book_category(cat_name) VALUES(?)";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute(array($category));

        if($result){
            return "Category Created Successfully";
        }
    }

    public function check_if_category_exist($category)
    {
        $sql = "SELECT * FROM book_category WHERE cat_name=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$category]);
        $numberofCategory = $stmt->rowCount();
        return $numberofCategory;
    }

    public function delete_category($id)
    {
        $sql = "DELETE FROM book_category WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$id]);
        return $result;
    }

    public function count_category(){
        $sql = "SELECT * FROM `book_category`";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }
   

    public function get_category($category){
        $sql = "SELECT * FROM books where book_category=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array($category));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    

}

    // $artist =new Admin;
    // $mis = $artist->add_category("Economics");
    // $check = $artist->check_if_category_exist("Accounting");
    // $fetch = $artist->fetch_allcategories(3);
    // $fetch = $artist->add_subcategory("How to make business",2);
    // $del = $artist->delete_category()
    // $category = $artist->get_category("Financial Analysis");
    // print_r($category);


?>