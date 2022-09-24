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

<div class="flex">
    <form action='RunAll.php' method='POST' class="formContent">
            LoginName <input type='string' name='userName'/>
            Password: <input type='string' name='password'/> </br>
        <input type='submit'/>
    </form>
</div>

</body>
</html> 