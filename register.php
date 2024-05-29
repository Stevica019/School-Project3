<?php

include("database1.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="<?php  htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
    <h1>Registruj se</h1><br>
    Vase korisnicko ime: <br>
    <input type="text" name="username" placeholder="username"><br>
    Vasa lozinka: <br>
    <input type="password" name="password" placeholder="password"><br><br>
    <input type="submit" name="register" value="Registruj se">
    <a href="index.php">Nazad na login</a>
    </form>

</body>
</html>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST,"username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);

        if(empty($username) || empty($password)){   
            echo "Unesite Korisnicko ime/sifru";
    }
    else{   
        $hash  = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO korisnici(user, password)
                VALUES('$username', '$hash')";
        mysqli_query( $conn, $sql );   
        echo "Registrovani ste!";

    }
}

mysqli_close($conn);


?>