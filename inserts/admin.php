<?php


if (@$_POST['submit']==='submit') {
    if($_POST['password']==='anna'){
    $_SESSION['isAdmin'] = 'yes';
    echo "You an admin now! Go to recipies to edit";
    }
    else {
        echo "Incorrect password";
    }
}
if (@$_POST['submit']==='logout') {

    unset($_SESSION['isAdmin']);
    echo "You logged out";
}

//print_r($_SESSION);
if(@$_SESSION['isAdmin'] === 'yes'){?>
    <form action="#" method="POST">

        <button type="submit" name="submit" value="logout">logout</button>
    </form>

    <?php
}
else {
?><br>
Login form:
<form action="#" method="POST">
    Password:<input type="password" value="" name="password">
    <button type="submit" name="submit" value="submit">login</button>
</form>
<?php
    }
     ?>