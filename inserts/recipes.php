<?php

if($entry!=='index') die('please got from main page');

$pdo = Database::connect();
if(!$_GET['recipes']){
    echo "<h3>Cannot find recipes</h3>";
}


else {
    if ($_GET['recipes'] === "all") {
        $sql = 'SELECT * FROM recipes ORDER BY id DESC';
        echo "<table>";
        foreach ($pdo->query($sql) as $row) {
            echo '<tr>';

            echo '<td><a href="/?mode=recipes&recipes=' . $row['id'] . '">' . $row['title'] . '</a></td>';

            echo '</tr>';
        }

        echo "</table>";
        if(@$_SESSION['isAdmin'] === 'yes') { echo '<a class="btn-default" href="/?mode=editrecipes&recipes=new">Add new</a>';}

    }
    
    else{
        $recipeid=(int)$_GET['recipes'];
        if($recipeid){
            $sql = 'SELECT * FROM recipes WHERE `id`=:id ORDER BY id DESC';

            $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':id' => $recipeid));
            $recipe = $sth->fetchAll();
            if(count($recipe)==1){
                $recipe=$recipe[0];
           //     print_r($recipe);
                echo <<<HTML
<h3>{$recipe['title']}</h3><br>
{$recipe['modify_time']}
<hr>
<div>
{$recipe['body']}
</div>

HTML;

                if(@$_SESSION['isAdmin'] === 'yes') { echo "<a href=/?mode=editrecipes&recipes=".$recipeid.">Edit</a>";}
            }
            else{
                echo "<h3>Cannot find recipe # $recipeid</h3>";
            }
        }
    }
    
    }