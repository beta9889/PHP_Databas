<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    if(isset($_SESSION['user'])){
        $pdo = new PDO('mysql:dbname=a20behta; host=localhost', $_SESSION['user'], $_SESSION['pass']); 
        if(isset($_POST['deer'])){
            
            $deerNr = $_POST['deer'];
            $stmt = $pdo->prepare("SELECT * FROM ViewAllDeer WHERE DeerNr = :ssnid");
            $stmt->bindValue(':ssnid',$_POST['deer']);
            $stmt->execute();
            
            echo'<br/> <br/> <br/>';
            echo '<div class="flexCenter">';
            echo "<table border='1' cellpadding='2' cellspacing='2'>
                    <tr>
                        <th>Deer Name </th>
                        <th>Deer Number </th>
                        <th>Deer Smell </th>
                        <th>Deer Group </th>
                    </tr>";
            foreach($stmt->fetchall() as $row){
                echo '<tr>';
                    echo '<td>'. $row['DeerName'] ."</td>"; 
                    echo '<td>' . $row['DeerNr']. '</td>';
                    echo '<td>' .  $row['Smell'] . '</td>';
                    echo '<td>' . $row['DeerGroup'] . '</td>';
                echo '</tr>';
                echo '</table>';            
                if($row['retired'] == 'Working'){
                    echo "<form action='retireDeer.php' method='GET'>
                        <input type='hidden' value='" . $deerNr . "'name='retireADeerId'/>
                        <input type='submit' value='Retire This Deer'/>
                    </form>";  
                }
            }
            echo '</div>';
            $stmt->closeCursor();

            $stmt = $pdo->prepare("SELECT * FROM ViewDeerConnection WHERE ViewDeerConnection.DeerNr1=:ssnId;");
            $stmt->bindParam(':ssnId', $deerNr);
            $stmt->execute();

            echo "<br> <div class='flexCenter'>
                <Table border='1' cellpadding='2' cellspacing='2'>
                    <tr >
                        <th> Deer Connected to</th>
                        <th> Deer Connected to Id </th>
                        <th> Deer Retirement Status</th>
                    </tr>";
            
            foreach ($stmt->fetchall() as $row){
                echo "<tr> 
                        <td> ".$row['name2'] ." </td> 
                        <td>".$row['DeerNr2'] ." </td>
                        <td>".$row['Deer2 Retired'] ."</td>
                    </tr>";
            }
            echo "</Table>
                </div>";
            $stmt->closeCursor();
            echo "<br/> <br/> <br/> <br/> <br/> <br/> 
                <h1> Add Deer Connection </h1>
                <form action='addDeerConnection.php' method='POST'>
                    <input type=hidden value='". $deerNr."' name='deerId'/>
                    <input type='number' name='addConnId'> Id of Deer to connect </input> <br/>
                    <input type='submit'>
                </form>";
        }
    }
    else{
        print_r("<h1> ERROR Please try and logg in again</h1> <br/>
                <a href='index.php'> Logg back in </a>");
    }
?>

</body>

</html>