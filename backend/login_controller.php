<?php
class Login {
    private $conn;

    public function __construct()
    {
        require("config.php");
    }


    public function inloggen($log, $pas)
    {
        $_SESSION['login'] = $log;
        $query = "SELECT * FROM user WHERE name = :log";
        $stm = $this ->conn -> prepare($query);
        $stm->bindparam(':log', $log);
        //$stm->bindparam(':pas', $pas);
        $stm ->execute();
        $result = $stm->fetch(PDO::FETCH_OBJ);
        
        if($result != null)
        {
            if(password_verify($pas, $result->password))
            {
                $_SESSION['logged_in'] = true;
                $_SESSION['id'] = $result->id;
                ?><script>
                alert('Hello <?php echo $log?>. You are logged in.');
                window.location.replace('dashboard.php?user=<?php echo $log?>&id=<?php echo $_SESSION["id"]?>');
                </script><?php
            }
            else
            {
                echo "Username and/or password incorrect.";
            }
        }
        else
        {
            echo "No result.";
        }
    }
    
    public function uitloggen()
    {
        session_destroy();
        Header("Location: index.php");
    }

    public function register($email, $name, $pass, $r_pass)
    {
        $query = "INSERT INTO user (email, name, password )   values (:email, :name, :pass )";
        $stm = $this->conn->prepare($query);
        $stm->bindparam(':email', $email);
        $stm->bindparam(':name', $name);
        $stm->bindparam(':pass', $pass);
        $stm->execute();
        
    }

}

?>