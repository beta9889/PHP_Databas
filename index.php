<!DOCTYPE html>
<html>
<body>

<?php

 echo "<form action='index.php' method='post'>
            DeerNr: <input type='number' name='Id'/> </br>
            <input type='submit'/>
        </from>";

    if(isset($_POST['Id'])){
        $pdo = new PDO('mysql:dbname=a20behta; host=localhost', 'root','');
        $queryString = 'SELECT ViewWorkingDeer.Name FROM ViewWorkingDeer WHERE ViewWorkingDeer.DeerNr = :id';
        $stmt = $pdo->prepare($queryString);
        $stmt->bindParam(':id', $_POST['Id']); 
        $temp = $stmt->fetchAll();
        foreach($temp as $row){
            echo '<p>' . $row["Name"] . $row["Smell"].'</p>';
        }
    }
?>

</body>
</html> 