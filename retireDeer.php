<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Deer View</title>
</head>
    
<body>
<?php
    if(isset($_GET['deleteDeer'])){
        echo "<div class='flex'>
            <form action='#' method='POST    
                <input type=hidden value='". $_GET['deleteDeer']."'name='deleteDeer'/>
                <input type=

            ";

    }
    else if(isset($_POST['deleteDeer']) && isset($_POST['canNr'])){
        $pdo = new PDO('mysql:dbname=a20behta; host=localhost', $_SESSION['user'], $_SESSION['pass']);
     
        try{
            $stmt = $pdo->prepare("call RetireWorkingDeer(:deerDelete ,null, null, null)");
            $stmt->bindValue(':deerDelete', $_POST['deleteDeer']);
            echo '<h1> Bye Bitch</h1>';
        }
        catch(Exception $e){
            echo '<h1> ooh fuck ooh fuck ooh fuck</h1>' . $e->getMessage();
        }
    }
?>
</body>
</html>