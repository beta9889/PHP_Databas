<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php
    print_r($_SESSION);
    if(isset($_SESSION['user'])){

        $pdo = new PDO('mysql:dbname=a20behta; host=localhost', $_SESSION['user'], $_SESSION['pass']);
        $stmt = $pdo->prepare("select * from ViewAllDeer WHERE DeerNr = :deerNr");
        $stmt->bindParam(':deerNr', $_POST["deerSelector"]);
        $stmt->execute();
        
        foreach($stmt->fetchAll() as $row){
            print_r($row); 
        }
    }
    else{
        print_r("<h1>fuck</h1>");
        print_r($_SESSION);
    }
?>

</body>
</html> 