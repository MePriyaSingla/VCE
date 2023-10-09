<?php
$con = mysqli_connect("localhost", "root", "", "vce");
if (mysqli_connect_error()) {
    echo "not working!" . mysqli_error($con);
} else {
    echo "";
}
