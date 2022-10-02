<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Deer View</title>
</head>

<body>
    <?php
    if(isset($_POST['retireADeerId']) && isset($_POST['CanNr'])){
        $pdo = new PDO('mysql:dbname=a20behta; host=localhost', $_SESSION['user'], $_SESSION['pass']);
        try{
            $stmt = $pdo->prepare("call RetireWorkingDeer(:deerDelete ,:CanNr, :Factory, :Taste)");
            $stmt->bindValue(':deerDelete', $_POST['retireADeerId']);
            $stmt->bindParam(':CanNr', $_POST['CanNr']);
            $stmt->bindParam(':Factory', $_POST['Factory']);
            $stmt->bindParam(':Taste', $_POST['Taste']);
            $stmt->execute();
            echo '<h1> Bye Bitch</h1>';
        }
        catch(Exception $e){
            echo '<h1> ooh fuck ooh fuck ooh fuck</h1>' . $e->getMessage();
        }
    }
    else if(isset($_GET['retireADeerId'])){
        echo "<div class='flexCenter'>
            <form action='#' method='POST'>    
                <input type='hidden' value='". $_GET['retireADeerId']."'name='retireADeerId'/>
                <input type='number' name='CanNr'> Can Number </input> <br/>
                <input type='string' name='Factory'> Factory made</input> <br/>
                <input type='string' name='Taste'> Pölsa taste </input> <br/>
                <input type='submit'/>
            </form>
        </div>";
    }
?>
</body>

</html>