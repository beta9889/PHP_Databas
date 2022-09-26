<?php
    session_start();
    
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="flex">
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
            $connection->query(file_get_contents('sqlRunnable/CreateTable.sql'));
            $connection->query(file_get_contents('sqlRunnable/Triggers.sql'));
            $connection->query(file_get_contents('sqlRunnable/procedures.sql'));
            $connection->query(file_get_contents('sqlRunnable/Views.sql'));
            $connection->query(file_get_contents('sqlRunnable/insertData.sql'));

            echo '<h1>Did Not Throw Exception </h1>';
        }
        catch( Exception $e){
            echo "<div class='flex'> 
                    <h1>Error</h1> <br/>
                    <h4>". $e->getMessage() ."</h4>";
        }
    }
?>

</body>
</html> 