<?php
require "elements/head.php";
require_once 'data/function.php';
if(isset($_POST['user'])&&($_POST['password'])){
    login($_POST['user'],$_POST['password']);

}

?>
<div class="login">
<h1>Login</h1>
<form action="#" method="post">
    <input type="text" name="user" placeholder="pseudo" required><br>
    <input type="password" name="password" placeholder="password" required><br>
    <button type="submit" class="btn btn-primary">Valider</button>
</form>
</div>
<?php require "elements/footer.php" ?>