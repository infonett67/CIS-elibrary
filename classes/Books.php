<?php
require_once("DB.php");

class Books extends DB{

    public function select_status(){
        $sql = "SELECT * FROM status ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array());
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function select_all_books(){
        $sql = "SELECT * FROM books";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array());
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function count_books(){
        $sql = "SELECT * FROM `books`";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }
    public function add_books($name,$size,$image,$category,$file_id){
        if ($this->check_if_book_exist($name)>0){
            return "This Book already exists";
        }

        $sql = "INSERT INTO books (book_name,book_size,filename,book_cat_id,file_id) VALUES(?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute(array($name,$size,$image,$category,$file_id));
        if($result){
            return "Book Created Successfully";
        }

    }

    public function file_id($id){
        $sql = "SELECT file_id FROM files WHERE file_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;

    }


    public function check_if_book_exist($name){
        $sql = "SELECT * FROM books WHERE book_name=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name]);
        $numberofBooks = $stmt->rowCount();
        return $numberofBooks;
    }
    
    public function check_if_category_exist($name){
        $sql = "SELECT * FROM book_category WHERE cat_name=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name]);
        $catexist = $stmt->rowCount();
        return $catexist;
    }

    public function fetch_categories(){
        $sql = "SELECT * FROM book_category";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array());
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }  

    public function get_book_data($id){
        $sql = "SELECT * FROM books WHERE id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);  
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
    }

    public function filterSearch($search){
        // if ($this->check_if_book_exist($search)==0 || $this->check_if_category_exist($search)==0){
        //     return "This Book Does not exist";
        // }
        $sql = "SELECT * FROM books JOIN book_category ON books.book_cat_id=book_category.id WHERE CONCAT (book_name,cat_name) LIKE ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(["%$search%"]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        // if($result){
        //     echo "SEARCH COMPLETE";
        // }
    }

    public function new_books(){
        $sql = "SELECT * FROM books ORDER BY book_stamp DESC LIMIT 4";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function select_category($cat){
        $sql = "SELECT * FROM books WHERE book_cat_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$cat]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function join_books($id){
        $sql = "SELECT * FROM books JOIN book_category ON books.book_cat_id=book_category.id WHERE book_category.id=?";
        // SELECT * FROM `books` INNER JOIN book_category ON books.book_cat_id=book_category.id;
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function join(){
        $sql = "SELECT * FROM books JOIN files ON books.file_id=files.file_id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function join_booksname($id){
        $sql = "SELECT book_category.cat_name FROM books JOIN book_category ON books.book_cat_id=book_category.id WHERE book_category.id=?";
        // SELECT * FROM `books` INNER JOIN book_category ON books.book_cat_id=book_category.id;
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function count_books_in_category($id){
        $sql = "SELECT COUNT(*) AS count FROM books JOIN book_category ON books.book_cat_id=book_category.id WHERE books.book_cat_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $result['count'];
        return $count;
    }
    

}





// $new = new Books();
// $add = $new->count_books_in_category(33);
// print_r($add);






?>