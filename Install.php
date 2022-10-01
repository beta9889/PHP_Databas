<?php
    session_start();    
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="flexCenter">
    <form action='Install.php' method='POST'>
            ServerLocation: <input type='string' name='Server'/> <br/>
            LoginName <input type='string' name='userName'/> <br/>
            Password: <input type='password' name='password'/> <br/>
        <input type='submit'/>
    </form>
</div>

<?php
    if(isset($_POST['userName'])){
        try{
            $connection = new PDO('mysql:dbname=a20behta; host='. $_POST['Server'] , $_POST['userName'], $_POST['password']);
            
            $stmp = $connection->prepare(file_get_contents('sqlRunnable/CreateTable.sql'));
            $stmp->execute();
            foreach($stmp->fetchall() as $row){print_r($row);}
            $stmp->closeCursor();

            $stmp = $connection->prepare(file_get_contents('sqlRunnable/Triggers.sql'));
            $stmp->execute();
            foreach($stmp->fetchall() as $row){print_r($row);}
            $stmp->closeCursor();
            
            $stmp = $connection->prepare(file_get_contents('sqlRunnable/procedures.sql'));
            $stmp->execute();
            foreach($stmp->fetchall() as $row){print_r($row);}
            $stmp->closeCursor();

            $stmp = $connection->prepare(file_get_contents('sqlRunnable/Views.sql'));
            $stmp->execute();
            foreach($stmp->fetchall() as $row){print_r($row);}
              $stmp->closeCursor();
            
            $stmp = $connection->prepare(file_get_contents('sqlRunnable/insertData.sql'));
            $stmp->execute();
            foreach($stmp->fetchall() as $row){print_r($row);}
            $stmp->closeCursor();

            echo '<h1>boi</h1>';
        }
        catch(Exception $e){
            echo "<h1> Ooh Fuck Ooh Shit Ooh Fuck : </h1>" . $e->getMessage();
        }
        
    }
?>

</body>
</html> 