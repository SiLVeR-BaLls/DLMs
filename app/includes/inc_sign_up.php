<?php
include 'app/controller/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = new UserController($_POST);
}



?>
<pre><?php echo var_dump($user->test()) ?></pre>