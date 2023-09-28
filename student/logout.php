<?php
session_start();
unset($_SESSION['userIdVce']);
header("location:index.php");
