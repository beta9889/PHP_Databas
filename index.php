<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Deer View</title>
</head>
    
<body>
<div class="flex">
    <form action='LandingPage.php' method='POST'>
            LoginName <input type='string' name='userName'/> <br/>
            Password: <input type='password' name='password'/> <br/>
        <input type='submit'/>
    </form>
</div>

</body>
</html> 
