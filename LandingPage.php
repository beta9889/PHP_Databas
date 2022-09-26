<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php

    if(isset($_POST['userName'])){
        try{
            $_SESSION['user'] = $_POST['userName'];
            $_SESSION['pass'] = $_POST['password'];
            $pdo = new PDO('mysql:dbname=a20behta; host=localhost', $_SESSION['user'], $_SESSION['pass'],);
            $queryString = 'SELECT ViewWorkingDeer.DeerNr, ViewWorkingDeer.DeerName FROM ViewWorkingDeer';

            $stmt = $pdo->prepare($queryString);
            $stmt->execute();
            
            echo "<form action='deerView.php' method='POST' class='flex'>
                    <select name='deer' id='deerSelector'>";   
            
                    foreach($stmt->fetchAll() as $row){
                echo "<option value='" . $row["DeerNr"] . "'>" . $row["DeerName"] . "</option>" ;
            }
            echo "<input type='submit' value='Submit'/> </select> </form>";
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
    print_r($_SESSION);
?>
</body>
</html>