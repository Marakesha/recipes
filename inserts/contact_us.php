<?php
if (@$_POST['submit']==='submit') {
echo "Email sent!";
$message=$_POST['email']."\n\n ".$_POST['message'];
mail('sarkisovna.a@gmail.com', 'email from my website', $message);
}

?>
<div class="container">
    Please leave us a message below<br><br><br>

<form   action="#" method="POST">
    <div class="form-group">
  <label for="email">Email:</label>
  <input   type="email" name="email" class="form-control" id="email" >
</div>
<div class="form-group">
  <label for="text">Text:</label>
  <textarea name="message" class="form-control" rows="5" cols="80" id="text"></textarea>
 
</div>
  
    
    <button type="submit" class="btn btn-default" name="submit" value="submit">submit</button>
    
        </form>
</div>
