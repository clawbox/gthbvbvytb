<?php

$aff = $_GET['aff'];

setcookie('aff', $aff);

header("Location:https://tnplayer.com/auth/signup.php");


?>