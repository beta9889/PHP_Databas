<!DOCTYPE html>
<html>
<body>

<style>
.flex {
    display: flex;
    justify-content: space-evenly;
    row-gap: 20px;
}
</style>

<?php

    if(isset($_POST['userName'])){
        
        $pdo = new PDO('mysql:dbname=a20behta; host=localhost', $_POST['userName'], $_POST['password']);

        $queryString = 'SELECT ViewWorkingDeer.Name FROM ViewWorkingDeer';
        
        $stmt = $pdo->prepare($queryString);
        $stmt->execute();
        
        foreach($stmt->fetchAll() as $row){

            echo '<p>' . $row["Name"] . '</p>';
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