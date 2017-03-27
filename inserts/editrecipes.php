<?php

if($entry!=='index') die('please got from main page');
if(@$_SESSION['isAdmin'] === 'yes') {
    $pdo = Database::connect();
    if (!$_GET['recipes']) {
        echo "<h3>Cannot find recipes</h3>";
    } else {
        if (@$_POST['submit'] == 'save') {
            //saving to db
            $recipeid = $_POST['id'];
            $title = $_POST['title'];
            $body = $_POST['body'];

            $sql = 'UPDATE recipes SET `title`=:title, `body`=:body  where `id`=:id';

            $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':id' => $recipeid, ':title' => $title, ':body' => $body));

        }

        if (@$_POST['submit'] == 'add') {
            //saving to db

            $title = $_POST['title'];
            $body = $_POST['body'];

            $sql = 'INSERT INTO recipes (`title`, `body`) value( :title, `body`=:body )';

            $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':title' => $title, ':body' => $body));
            $id = $pdo->lastInsertId();
            header('Location: /?mode=editrecipes&recipes=' . $id);
        }

        if ($_GET['recipes'] == 'new') {

            echo <<<HTML
<form action="#" method="POST">
<input type="hidden" name="id" value="new">
title:<input type="text" name="title" value="" /><br>
body:<textarea name="body" id="editor1" rows="10" cols="80"></textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>          
                
                <button type="submit" name="submit" value="add">Add</button>
</form>

HTML;


        } else {
            $recipeid = (int)$_GET['recipes'];
            if ($recipeid) {
                $sql = 'SELECT * FROM recipes WHERE `id`=:id ORDER BY id DESC';

                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id' => $recipeid));
                $recipe = $sth->fetchAll();
                if (count($recipe) == 1) {
                    $recipe = $recipe[0];

                    //     print_r($recipe);
                    echo <<<HTML
<form action="#" method="POST">
<input type="hidden" name="id" value="{$recipe['id']}">
title:<input type="text" name="title" value="{$recipe['title']}" /><br>
body:<textarea name="body" id="editor1" rows="10" cols="80">{$recipe['body']}</textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>          
                
                <button type="submit" name="submit" value="save">Save</button>
</form>
Original:
<h3>{$recipe['title']}</h3><br>
{$recipe['modify_time']}
<hr>
<div>
{$recipe['body']}
</div>

HTML;


                } else {
                    echo "<h3>Cannot find recipe # $recipeid</h3>";
                }
            }
        }
    }
}