<?php

class Blog
{
    //properties
    private $db;
    private $id;
    private $title;
    private $content;

   
    //metod
    function __construct()
    {
        $this->db = new mysqli('localhost','news', 'password', 'blog');
        if ($this->db->connect_errno > 0) {
            die("Fel vid anslutning:" . $this->db->connect_error);
        }
    }
    //Lägg till titel och content och spara i databas
    public function AddNews(string $title, string $content, int $user_id) : bool{
        
        $sql = "INSERT INTO news( title, content, user_id) VALUES('$title', '$content', $user_id);";
        return $this->db->query($sql);
    }

    //Kontrollera att textfältet inte är tomt i titeln
    public function SetTitle(string $title): bool
    {
        //sanitera title med real_escape_string
        $title = $this->db->real_escape_string($title);
        if (mb_strlen($title) > 0) {
            $this->title = $title;
            return true;
        } else {
            return false;
        }
    }
    //kontrollera att textfältet inte är tomt i contentrutan
    public function SetContent(string $content): bool
    { //Sanitera content med real_escape_string
        $content = $this->db->real_escape_string($content);
        if (mb_strlen($content) > 0) {
            $this->title = $content;
            return true;
        } else {
            return false;
        }
    }
 
    public function getNews(): array
    {
        //SQL frågor
        $sql = "SELECT * FROM news;";
        $result= $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
        /*$sql = "SELECT news.id, news.title, news.content, news.postdate, login.firstname, login.lastname FROM news JOIN login ON
         news.user_id = login.userid ORDER BY postdate DESC ;";
        $answer = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($answer, MYSQLI_ASSOC);*/
    
    public function getLatestFive(): array
    { //SQL frågor
        $sql = "SELECT news.id, news.title, news.content, news.postdate, login.firstname, login.lastname, login.userid FROM news JOIN login ON news.user_id = login.userid ORDER BY postdate DESC LIMIT 5;";
        $answer = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($answer, MYSQLI_ASSOC);
        
    }

    //Delete specifikt inlägg
    public function deleteblog(int $id): bool
    {
        $id = intval($id);
        //SQL fråga
        $sql = "DELETE FROM news WHERE id=$id";
        // Sänd fråga
        return mysqli_query($this->db, $sql);
    }
    //Välj specifikt inlägg med hjälp av id
    public function GetSpecBlog(int $id) : array{
        $id = intval($id);
        $sql = "SELECT * FROM news WHERE id=$id;";
        $answer = mysqli_query($this->db, $sql);
        return $answer->fetch_assoc();
    }

    public function ChangeBlog(int $id, string $title, string $content): bool{
        if(!$this->SetTitle($title))
        return false;
        if(!$this->SetContent($content))
        return false;
        $sql = "UPDATE news SET title='" . $this->title ."', content='" . $this->content . "' WHERE id=$id;";
        return mysqli_query($this->db, $sql);
    }
    public function joinTables(): array{
        $sql = "SELECT * FROM login CROSS JOIN news ORDER BY postdate DESC LIMIT 5;";
        $answer = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($answer, MYSQLI_ASSOC);
     }

    
     public function getPostByID($user_id){ 
        
        $sql = "SELECT * FROM news WHERE user_id = '$user_id' ORDER BY postdate DESC";
        $result = mysqli_query($this->db, $sql); //Send query to server
        return mysqli_fetch_all($result, MYSQLI_ASSOC); //return result of SQL-query in array
       
    }
   /* public function getUserinfo($iduser){
        $stmt= $this->connect()->db->'SELECT * FROM news WHERE userid = ?;;
        if(!$stmt->execute(array($iduser))){

        }
    }*/
    //funktion för kommentarer
   /* public function AddComment( string $commName, string $comment, int $id, int $userID) : bool{
        //Control with set-methods
        if (!$this->setComment($comment))
        return false; 
        if (!$this->setcommName($commName))
        return false; //Control with set-methods
    $sql = "INSERT INTO comments(commName, comment, newsID, userID)
    VALUES ('$commName', '$comment', '$id','$userID');";
       /* return $this->db->query($sql);
       //Send query
       return mysqli_query($this->db, $sql);

    }
    public function SetComment(string $comment): bool
    {
        //Kontrollera antal tecken i textsträng
        if (mb_strlen($comment) > 5) {
            $this->comment = $comment;
            return true;
        } else {
            return false;
        }
    }
    public function setcommName(string $commName): bool
    {
        //Kontrollera antal tecken i textsträng
        if (mb_strlen($commName) > 1) {
            $this->commName = $commName;
            return true;
        } else {
            return false;
        }
    }
    public function getPostByEmail($user_id){ 
        
        $sql = "SELECT * FROM news WHERE user_id = '$user_id'";
        $result = mysqli_query($this->db, $sql); //Send query to server
        return mysqli_fetch_all($result, MYSQLI_ASSOC); //return result of SQL-query in array
       
    }*/
      /* public function joinTables(): array{
        $sql = "SELECT * FROM login CROSS JOIN news;";
        $answer = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($answer, MYSQLI_ASSOC);
     }
    //Hämta nyheter
    /*public function getNews(): array
    {
        //SQL frågor
        $sql = "SELECT * FROM news ORDER BY postdate DESC ;";
        $answer = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($answer, MYSQLI_ASSOC);
    }*/
}