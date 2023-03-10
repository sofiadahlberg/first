<?php

class Login
{
    //properties
    private $db;
    private $email;
    private $password;
    
    private $firstname;
    private $lastname;

    private $userid;

    
    // metod
    //constructor
    function __construct()
    {
        $this->db = new mysqli('localhost', 'news', 'password', 'blog');
        if ($this->db->connect_errno > 0) {
            die("Fel vid anslutning:" . $this->db->connect_error);
        }
    }

    
    //Lägg till användare

    public function AddInlog(string $email, string $password ): bool
    {
       /* //Check set-methods
        if (!$this->SetEmail($email))
            return false;
        if (!$this->setPassword($password))
            return false;
        */
        $sql = "INSERT INTO login(email, password )VALUES('$email' , '$password');";
        //Send query
        return mysqli_query($this->db, $sql);
    }
    //Setmetoder
    
    
    //Test så att textrutan inte är tom
    public function Setfirstname(string $firstname): bool
    {
        if ($firstname != "") {
            $this->firstname = $firstname;
            return true;
        } else {
            return false;
        }
    }
         public function setLastname(string $lastname): bool
    {
        //Kontrollera så den inte är tom
        if ($lastname != "") {
            $this->lastname = $lastname;
            return true;
        } else {
            return false;
        }
    }
   
    
    public function getLogin() : array{
        //SQL query
        $sql = "SELECT * FROM login;";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function Name(int $userid) : array{
        //SQL query
        $userid = intval($userid);
        $sql = "SELECT * FROM login WHERE userid= $userid;";
        $result = mysqli_query($this->db, $sql);
        return $result->fetch_assoc();
    }


  
    public function LoginUser(string $email, string $password) : bool {
        $sql = "SELECT * FROM login WHERE email = '$email';";
      
        $result = $this->db->query($sql);

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];

            if(password_verify($password, $stored_password));{
                $_SESSION['email'] = $email;
                /*$_SESSION['userid'] = $userid;*/
                return true;
            }
        } 
        else{
            return false;
        }
    }
    public function registerUser(string $email, string $password, string $firstname, string $lastname) : bool{
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO login(email, password, firstname, lastname)VALUES ('$email','$hashed', '$firstname', '$lastname');";
        return $this->db->query($sql);
        
    }

     //Test så att textrutan inte är tom
     public function setmail(string $email): bool
     {
         //Kontrollera antal tecken i textsträng
         if (mb_strlen($email) > 0) {
             $this->email = $email;
             return true;
         } else {
             return false;
         }
     }
     //Test så att textrutan inte är tom
     public function setaPassword(string $password): bool
     {
         //Kontrollera antal tecken i textsträng
         if (mb_strlen($password) > 0) {
             $this->password = $password;
             return true;
         } else {
             return false;
         }
     }
     public function SetEmail(string $email): bool
     {
         if ($email != "") {
             $this->email = $email;
             return true;
         } else {
             return false;
         }
     }
          public function setPassword(string $password): bool
     {
         //Kontrollera så den inte är tom
         if ($password != "") {
             $this->password = $password;
             return true;
         } else {
             return false;
         }
     }
     public function GetNameById(int $userid) : string{
        $sql = "SELECT firstname,lastname, userid FROM login WHERE userid = $userid;";
        $answer = $this->db->query($sql);
        $row = $answer->fetch_assoc();

        return $row['firstname'] . " " . $row['lastname'];
     }
     public function GetIDByUsername(string $email) : int{
        $sql = "SELECT userid FROM login WHERE email = '$email';";
        $answer = $this->db->query($sql);
        $row = $answer->fetch_assoc();

        return $row['userid'];
     }



     //JOIN TABLE
     /*public function joinTables($userid): array{
        $sql = "SELECT * FROM login CROSS JOIN news;";
        $answer = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($answer, MYSQLI_ASSOC);
     }*/
      /* public function getFullName(string $firstname, string $lastname, int $id) : array{
        $_SESSION['firstname'] = $firstname;
        //SQL query
        $sql = "SELECT * FROM login where firstname= '$firstname';";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }*/

    /*public function getName() : array{
        //SQL query
        $sql = "SELECT FROM login;";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);

    }*/
    }
     