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
    <h1>Ovo je pocetna strana</h1> <br>
    <?php
    echo "<h2>Dobrodosao, " . htmlspecialchars($_SESSION['username']) . "! <br></h2>";
    ?>
    <br>
    <form action="<?php  htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
    <input type="submit" name="logout" value="Odjavi se">
    </form>
    <form action="<?php  htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
    <h3>Unesite odgovor na pitanje!</h3>
    <p>Koja je marka "Astra" modela!</p>
    <input type="text" name="answer" placeholder="odgovor"><br><br>
    <input type="submit" name="question" value="Upisi odgovor">
    <input type="submit" name="delete" value="Obrisi odgovor">
    </form>
</body>
</html>
<?php
    $answer = filter_input(INPUT_POST,"answer", FILTER_SANITIZE_SPECIAL_CHARS);
    if(isset($_POST["question"])) {


        if(empty($answer)){
            echo "Morate da upisete odgvor";
        }
        else{ $sql = "INSERT INTO stud_test(answer)
            VALUES('$answer')";
            mysqli_query( $conn, $sql );  
            echo "<br> Uspesno ste upisali odgovor <br>" ;
            echo  "Vas odgovor: <br>" . $answer;
        }
        
              
    }
    if(isset($_POST["delete"])) {
        $delete = "DELETE FROM stud_test";
        mysqli_query( $conn, $delete );
        echo "<br> Uspesno ste obrisali odgovor" ;
    }
    if(isset($_POST["logout"])){
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }
    mysqli_close($conn);

?>