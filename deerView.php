<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php
    if(isset($_SESSION['user']) && isset($_POST)){
        
        $pdo = new PDO('mysql:dbname=a20behta; host=localhost', $_SESSION['user'], $_SESSION['pass']);
        $stmt = $pdo->prepare("SELECT * FROM ViewAllDeer WHERE  DeerNr = :TEMP");
        $stmt->bindValue(':TEMP',$_POST['deer']);
        $stmt->execute();
        echo ' in here boi';
        echo'<br/> <br/> <br/>';
        foreach($stmt->fetchAll() as $row){
            print_r($row);
        }
    }
    else{
        print_r("<h1>error sending message</h1>");
    }
?>

</body>
</html> 