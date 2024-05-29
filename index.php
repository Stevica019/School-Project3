<?php
// registracija (pisanje podataka), login (koriscenje podataka), logout, neko indeksiranje 
// (citanje i pretraga ig) povezivanje baze (logicno)
    include("database1.php");
    session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Login Page</h1> <br><br>
    <form action="<?php  htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
    Korisnicko ime: <br>
    <input type="text" name="username" placeholder="Username"><br>
    Lozinka: <br>
    <input type="password" name="password" placeholder="password"><br><br>
    <input type="submit" name="login" value="Login"><br>
    Nemas nalog?
    <a href="register.php">Registruj se</a>
    </form>
</body>
</html>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($username) || empty($password)) {   
        echo "Unesite Korisnicko ime/sifru";
    } else {   
        $query = "SELECT * FROM korisnici WHERE user = ?";
        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $row['password'])) {
                    $_SESSION['username'] = $username; 
                    header("Location: home.php"); 
                    exit();
                }
            } else 
            {
                echo "Pogresni podaci";
            }
            mysqli_stmt_close($stmt);
        }
    }
}

mysqli_close($conn);

?>