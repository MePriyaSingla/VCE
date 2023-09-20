<?php
session_start();
if (empty($_SESSION['userIdVce']))
    header("location:index.php");
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <title>Achievement - User Dashboard</title>
</head>

<body>
    <div class="container">
        <header class="header">
            <div class="header__left">
                <img src="img/user.png" class="user__header-user" alt="user">
                <span class="header__user-name">Welcome,
                    <?php
                    $q = "SELECT * FROM user_table WHERE user_id = '" . $_SESSION['userIdVce'] . "'";
                    $r = mysqli_query($con, $q);
                    if (mysqli_num_rows($r) > 0) {
                        $row = mysqli_fetch_array($r);
                        echo $row['user_firstname'] . ' ' . $row['user_lastname'];
                    }
                    ?>
                </span>
            </div>
            <div class="header__right">
                <a href="logout.php" class="header__user-logout"><i class="bi bi-box-arrow-right"></i> logout</a>
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
                <a href="user-achievements.php" class="sidebar__item-link">
                    <li class="sidebar__item">
                        <i class="bi bi-trophy"></i>
                        <span>Add Achievements</span>
                    </li>
                </a>
                <a href="explore-courses.php" class="sidebar__item-link">
                    <li class="sidebar__item">
                        <i class="bi bi-search"></i>
                        <span>Explore Courses</span>
                    </li>
                </a>
                <a href="connect.php" class="sidebar__item-link">
                    <li class="sidebar__item">
                        <i class="bi bi-person-fill-add"></i>
                        <span>Connect with others</span>
                    </li>
                </a>
                <a href="profile.php" class="sidebar__item-link">
                    <li class="sidebar__item">
                        <i class="bi bi-pencil-square"></i>
                        <span>Edit Profile</span>
                    </li>
                </a>
            </ul>
        </section>
        <main class="main__content">
            <div class="login-container-2">
                <?php
                $q1 = "SELECT * FROM user_table WHERE user_id = '" . $_SESSION['userIdVce'] . "'";
                $r1 = mysqli_query($con, $q1);
                if (mysqli_num_rows($r1) > 0) {
                    $row1 = mysqli_fetch_array($r1); ?>

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="login__form">
                        <h3 class="heading-3">Edit Profile</h3>
                        <div class="input">
                            <label class="label__text">First Name:</label>
                            <input type="text" class="input__box" value="<?php echo $row1['user_firstname']; ?>" name="f_name" required>
                        </div>
                        <div class="input">
                            <label class="label__text">Last Name:</label>
                            <input type="text" class="input__box" value="<?php echo $row1['user_lastname']; ?>" name="l_name" required>
                        </div>
                        <div class="input input__btn">
                            <input type="submit" value="Edit" class="btn" name="edit_profile">
                        </div>
                    </form>
                <?php
                }
                ?>
                <?php
                if (isset($_POST['edit_profile'])) {
                    $firstName = mysqli_real_escape_string($con, $_POST['f_name']);
                    $lastName = mysqli_real_escape_string($con, $_POST['l_name']);

                    $sin = "UPDATE `user_table` SET `user_firstname` = '$firstName', `user_lastname` = '$lastName' WHERE `user_id` = '" . $_SESSION['userIdVce'] . "'";
                    $run = mysqli_query($con, $sin);
                    if ($run) {
                        echo '<p class="form_success_msg"><b>Edited Successfully</b></p>';
                    } else {
                        echo '<p class="form_error_msg"><b>Opps! Not done</b></p>';
                    }
                }
                ?>
            </div>
        </main>
    </div>
</body>

</html>