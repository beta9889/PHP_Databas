<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php

    if(isset($_POST['userName'])){
        try{

            $pdo = new PDO('mysql:dbname=a20behta; host=localhost', $_POST['userName']
            , $_POST['password']);
            
            $queryString = 'SELECT * FROM ViewWorkingDeer';
            
            $stmt = $pdo->prepare($queryString);
            $stmt->execute();
            echo "<div class='flex'>
                    <label for='Choose a deer'> ";

            foreach($stmt->fetchAll() as $row){
                echo "<div class='viewWorkingDeer'>";
                echo "<h3 >" . $row["Name"] . "</h3>" . $row["DeerNr"] ." <br/>" ;
                echo "</div>";
            }
            echo "</div>";
        }
        catch( Exception $e){
            echo "<div class='flex'> 
                    <h1>Error logging in </h1> <br/>
                    <h4>". $e->getMessage() ."</h4>";
        }
    }
    else{
        echo "<div class='flex'>";
        echo    "<h1 > Please Logg in first </h1>";
        echo    "<a href=index.php> Back to Login Screen </a>" ;
        echo "</div>";
    }
?>

</body>
</html> 
