<?php
session_start();
include "../connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Admin Login</title>
</head>

<body>
    <main class="container">
        <div class="login-container-1">
            <img src="../img/login-page.png" class="login__img" alt="VCE Login Page">
        </div>
        <div class="login-container-2">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="login__form">
                <h3 class="heading-3">Welcome back</h3>
                <h4 class="heading-4">Login to Admin Panel</h4>
                <div class="input">
                    <label for="email" class="label__text">Email:</label>
                    <input type="email" class="input__box" name="admin_mail" id="email" required>
                </div>
                <div class="input">
                    <label for="password" class="label__text">Password:</label>
                    <input type="password" class="input__box" name="admin_pass" id="password" required>
                </div>
                <div class="input">
                    <input type="submit" value="Sign In" class="btn" name="admin_login">
                </div>
            </form>
            <?php
            if (isset($_POST['admin_login'])) {
                $username = mysqli_real_escape_string($con, $_POST['admin_mail']);
                $password = mysqli_real_escape_string($con, $_POST['admin_pass']);

                $sin = "select * from admin_table where BINARY admin_email='$username' and BINARY admin_password='$password'";
                $run = mysqli_query($con, $sin);
                if (mysqli_num_rows($run) > 0) {
                    $row = mysqli_fetch_array($run);
                    $_SESSION['adminIdVce'] = $row['admin_id'];
                    header('location:dashboard.php');
                } else {
                    echo '<p class="incorrect"><b>Incorrect email or password</b></p>';
                }
            }
            ?>
        </div>
    </main>
</body>

</html>