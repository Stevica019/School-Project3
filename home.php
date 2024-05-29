<?php
    include("database1.php");
    session_start(); 

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo "Dobrodosao, " . htmlspecialchars($_SESSION['username']) . "!";
    ?>
    <br>
    <form action="<?php  htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
    <h1>Ovo je pocetna strana</h1> <br>
    <input type="submit" name="logout" value="Odjavi se">
    </form>
</body>
</html>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }
    mysqli_close($conn);

?>