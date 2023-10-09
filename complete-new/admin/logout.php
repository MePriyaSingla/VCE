<?php
session_start();
unset($_SESSION['adminIdVce']);
header("location:index.php");
