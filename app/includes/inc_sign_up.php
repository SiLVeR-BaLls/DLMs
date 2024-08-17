<?php
include 'app/controller/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = new UserController($_POST);
}

?>
