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
            $connection = new PDO('mysql:dbname=a20behta; host='. $_POST['Server'] , $_POST['userName'], $_POST['password']);
            
            $connection->query(file_get_contents('sqlRunnable/CreateTable.sql'));
            $connection->query(file_get_contents('sqlRunnable/Triggers.sql'));
            $connection->query(file_get_contents('sqlRunnable/procedures.sql'));
            $connection->query(file_get_contents('sqlRunnable/Views.sql'));
            $connection->query(file_get_contents('sqlRunnable/insertData.sql'));

            echo '<h1>boi</h1>';
    }
?>

</body>
</html> 