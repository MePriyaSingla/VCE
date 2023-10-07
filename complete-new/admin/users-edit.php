<?php
session_start();
if (empty($_SESSION['adminIdVce']))
    header("location:index.php");
include "../connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <title>Admin Dashboard</title>
</head>

<body>
    <div class="container">
        <header class="header">
            <div class="header__left">
                <img src="../img/user.png" class="admin__header-user" alt="Admin">
                <span class="header__admin-name">Welcome,
                    <?php
                    $q = "SELECT * FROM admin_table WHERE admin_id = '" . $_SESSION['adminIdVce'] . "'";
                    $r = mysqli_query($con, $q);
                    if (mysqli_num_rows($r) > 0) {
                        $row = mysqli_fetch_array($r);
                        echo $row['admin_first_name'] . ' ' . $row['admin_last_name'];
                    }
                    ?>
                </span>
            </div>
            <div class="header__right">
                <a href="logout.php" class="header__admin-logout"><i class="bi bi-box-arrow-right"></i> logout</a>
            </div>
        </header>
        <section class="sidebar">
            <ul class="sidebar__items">
                <a href="dashboard.php" class="sidebar__item-link">
                    <li class="sidebar__item">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </li>
                </a>
                <a href="stats.php" class="sidebar__item-link">
                    <li class="sidebar__item">
                        <i class="bi bi-clipboard2-data"></i>
                        <span>Statistics</span>
                    </li>
                </a>
                <a href="users.php" class="sidebar__item-link">
                    <li class="sidebar__item">
                        <i class="bi bi-people-fill"></i>
                        <span>Users</span>
                    </li>
                </a>
                <a href="course-fields.php" class="sidebar__item-link">
                    <li class="sidebar__item">
                        <i class="bi bi-journal"></i>
                        <span>Course Fields</span>
                    </li>
                </a>
                <a href="course-domains.php" class="sidebar__item-link">
                    <li class="sidebar__item">
                        <i class="bi bi-journal"></i>
                        <span>Course Domains</span>
                    </li>
                </a>
                <a href="courses.php" class="sidebar__item-link">
                    <li class="sidebar__item">
                        <i class="bi bi-journal"></i>
                        <span>Courses</span>
                    </li>
                </a>
                <a href="campus.php" class="sidebar__item-link">
                    <li class="sidebar__item">
                        <i class="bi bi-buildings"></i>
                        <span>Campus</span>
                    </li>
                </a>
                <a href="user-availability.php" class="sidebar__item-link">
                    <li class="sidebar__item">
                        <i class="bi bi-calendar-check"></i>
                        <span>Availability</span>
                    </li>
                </a>
            </ul>
        </section>
        <main class="main__content">
            <div class="login-container-2">
                <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>" method="post"
                    class="login__form">
                    <h3 class="heading-3">Edit user</h3>
                    <?php
                    $eq = "SELECT * FROM `user_table` WHERE `user_id` = '" . $_GET['uid'] . "'";
                    $er = mysqli_query($con, $eq);
                    if (mysqli_num_rows($er) > 0) {
                        while ($erow = mysqli_fetch_array($er)) {
                    ?>
                    <div class="input">
                        <label class="label__text">First Name:</label>
                        <input type="text" value="<?php echo $erow['user_firstname']; ?>" class="input__box"
                            name="user_fname" id="f_name" required>
                    </div>
                    <div class="input">
                        <label class="label__text">Last Name:</label>
                        <input type="text" value="<?php echo $erow['user_lastname']; ?>" class="input__box"
                            name="user_lname" id="l_name" required>
                    </div>
                    <div class="input">
                        <label class="label__text">Email:</label>
                        <input type="email" value="<?php echo $erow['user_email']; ?>" class="input__box"
                            name="user_mail" id="email" required>
                    </div>
                    <div class="input">
                        <label class="label__text">Phone:</label>
                        <input type="text" value="<?php echo $erow['user_phone']; ?>" class="input__box"
                            name="user_phone" id="phone" required>
                    </div>
                    <div class="input">
                        <label class="label__text">Password:</label>
                        <input type="text" value="<?php echo $erow['user_password']; ?>" class="input__box"
                            name="user_pass" id="password" required>
                    </div>
                    <div class="input">
                        <label class="label__text">User Type:</label>
                        <select name="user_type" class="input__box" id="utype" required>
                            <option value="<?php echo $erow['user_type']; ?>"><?php echo $erow['user_type']; ?></option>
                            <option value="Student">Student</option>
                            <option value="Industrialist">Industrialist</option>
                        </select>
                    </div>
                    <div class="input input__btn">
                        <input type="submit" value="Update" class="btn" name="edit_user">
                    </div>
                    <?php
                        }
                    }
                    ?>
                </form>
                <?php
                if (isset($_POST['edit_user'])) {
                    $userFname = mysqli_real_escape_string($con, $_POST['user_fname']);
                    $userLname = mysqli_real_escape_string($con, $_POST['user_lname']);
                    $userMail = mysqli_real_escape_string($con, $_POST['user_mail']);
                    $userPhone = mysqli_real_escape_string($con, $_POST['user_phone']);
                    $userPassword = mysqli_real_escape_string($con, $_POST['user_pass']);
                    $userType = mysqli_real_escape_string($con, $_POST['user_type']);

                    $sin = "UPDATE `user_table` SET `user_firstname` = '$userFname', `user_lastname` = '$userLname', `user_type` = '$userType', `user_email` = '$userMail', `user_phone` = '$userPhone', `user_password` = '$userPassword' WHERE `user_id` = '" . $_GET['uid'] . "'";
                    $run = mysqli_query($con, $sin);
                    if ($run) {
                        echo ("<p style='margin-top:2rem;font-size:1.8rem;'>Updated Successfully</p>");
                    } else {
                        echo ("<script>location.href = '" . $_SERVER['REQUEST_URI'] . "';</script>");
                    }
                }
                ?>
            </div>
        </main>
    </div>
</body>

</html>