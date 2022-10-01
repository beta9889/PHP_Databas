<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Deer View</title>
</head>
    
<body>
<?php
    if(isset($_SESSION['user'])){
        $pdo = new PDO('mysql:dbname=a20behta; host=localhost', $_SESSION['user'], $_SESSION['pass']); 
    
        if(isset($_POST['addConnId'])){
            try{
                $stmt = $pdo->prepare("INSERT INTO DeerToDeer(firstDeerNr,secondDeerNr) Values(:mainDeer,:secondDeer)");
                $stmt->bindValue(":mainDeer",$_POST['deerId']);
                $stmt->bindValue(":secondDeer",$_POST['addConnId']);
                $stmt->execute();
                foreach($stmt->fetchall() as $row){ print_r($row); }
                $stmt->closeCursor();

                echo"<h1 class='flexCenter'> Connection Added </h1>";
            }
            catch (Exception $e){
                echo"Error adding connection". $e->getMessage();
            }
        }
    }
    else{
        print_r("<h1> ERROR Please try and logg in again</h1> <br/>
                <a href='index.php'> Logg back in </a>");
    }
?>
</div>

</body>
</html>