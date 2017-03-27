<?php

require_once 'functions.php';
$entry="index";

?>
<?php
include "inserts/header.php";

switch (@$_GET['mode']) {
    case 'recipes':

        // show recipes mode
        require_once 'inserts/recipes.php';
        break;
    case 'editrecipes':

        // show recipes mode
        require_once 'inserts/editrecipes.php';
        break;
    case 'users':
        //list of users
        echo "<table>";

        $pdo = Database::connect();
        $sql = 'SELECT * FROM users ORDER BY id DESC';
        foreach ($pdo->query($sql) as $row) {
            echo '<tr>';

            echo '<td><a href="mailto:'.$row['email'].'">'. $row['name'] . '</a></td>';
            echo '<td>'. $row['accesslevel'] . '</td>';
            echo '</tr>';
        }

        echo "</table>";
        break;
    case 'admin':
        //admin pages
        include "inserts/admin.php";
        break;
    case 'contact_us':
        //admin pages
        include "inserts/contact_us.php";    

        break;
    default:
        //home page
        include "inserts/home.php";
}


include "inserts/footer.php";
?>
