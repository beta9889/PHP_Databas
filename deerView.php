<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php
    if(isset($_SESSION['user']) && isset($_POST['deer'])){
        $deerNr = $_POST['deer'];
        $pdo = new PDO('mysql:dbname=a20behta; host=localhost', $_SESSION['user'], $_SESSION['pass']);
        $stmt = $pdo->prepare("SELECT * FROM ViewAllDeer WHERE  DeerNr = :TEMP");
        $stmt->bindValue(':TEMP',$_POST['deer']);
        $stmt->execute();
        echo'<br/> <br/> <br/>';
        echo '<div class="flex">';
        echo '<table>
                <tr>
                    <th>Deer Number </th>
                    <th>Deer Name </th>
                    <th>Deer Smell </th>
                    <th>Deer Group </th>
                </tr>';
        foreach($stmt->fetchall() as $row){
            echo '<tr>';
                echo '<th>'. $row['DeerName'] ."</th>"; 
                echo '<th>' . $row['DeerNr']. '</th>';
                echo '<th>' .  $row['Smell'] . '</th>';
                echo '<th>' . $row['DeerGroup'] . '</th>';
            echo '</th>';
            
            echo '</table>';
            if($row['retired'] == 0){

                echo "<form action='deerView.php' method='GET'>
                <input type='hidden' value='" . $deerNr . "'name='deleteDeer'/>
                <input type='submit' name='retire this Deer'/>
                </form>";  
            }
        }
        $stmt->closeCursor();
    }   
    else if(isset($_GET['deleteDeer'])){
        
    }
    else{
        print_r("<h1>error sending message</h1>");
    }
?>

</body>
</html> 