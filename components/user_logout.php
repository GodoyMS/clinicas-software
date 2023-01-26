<?php

include 'connect.php';

session_start();
session_unset();
session_destroy();

header('location:https://clinicas.alpha-clinicas.com/');

?>