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
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
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
                <a href="user-interest.php" class="sidebar__item-link">
                    <li class="sidebar__item">
                        <i class="bi bi-bookmark-check"></i>
                        <span>Interest</span>
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
                <a href="group-discussions.php" class="sidebar__item-link">
                    <li class="sidebar__item">
                        <i class="bi bi-chat-square-text"></i>
                        <span>Group Discussions</span>
                    </li>
                </a>
                <a href="user-availability.php" class="sidebar__item-link">
                    <li class="sidebar__item">
                        <i class="bi bi-calendar-check"></i>
                        <span>Availability</span>
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
                <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>" method="post"
                    class="login__form">
                    <h3 class="heading-3">Edit Achievement</h3>
                    <?php
                    $eq = "SELECT * FROM `achievement_table` WHERE `achievement_userid` = '" . $_SESSION['userIdVce'] . "' AND `achievement_id` = '" . $_GET['aid'] . "'";
                    $er = mysqli_query($con, $eq);
                    if (mysqli_num_rows($er) > 0) {
                        while ($erow = mysqli_fetch_array(($er))) {
                    ?>
                    <div class="input">
                        <label class="label__text">Course Name:</label>
                        <input type="text" value="<?php echo $erow['achievement_course']; ?>" class="input__box"
                            name="c_name" required>
                    </div>
                    <div class="input">
                        <label class="label__text">Platform or Institute:</label>
                        <input type="text" value="<?php echo $erow['achievement_platform']; ?>" class="input__box"
                            name="p_name" required>
                    </div>
                    <div class="input">
                        <label class="label__text">Tutor Name:</label>
                        <input type="text" value="<?php echo $erow['achievement_tutor']; ?>" class="input__box"
                            name="t_name" required>
                    </div>
                    <div class="input">
                        <label class="label__text">Course Duration:</label>
                        <input type="text" value="<?php echo $erow['achievement_courseduration']; ?>" class="input__box"
                            name="c_duration" required>
                    </div>
                    <div class="input">
                        <label class="label__text">Completed on:</label>
                        <input type="date" value="<?php echo $erow['achievement_completedon']; ?>" class="input__box"
                            name="c_completedon" required>
                    </div>
                    <div class="input">
                        <label class="label__text">Course Link (if any):</label>
                        <input type="text" value="<?php echo $erow['achievement_courselink']; ?>" class="input__box"
                            name="c_link">
                    </div>
                    <?php
                        }
                    } ?>
                    <div class="input input__btn">
                        <input type="submit" value="Edit" class="btn" name="edit_achievement">
                    </div>
                </form>
                <?php
                if (isset($_POST['edit_achievement'])) {
                    $courseName = mysqli_real_escape_string($con, $_POST['c_name']);
                    $platformName = mysqli_real_escape_string($con, $_POST['p_name']);
                    $tutorName = mysqli_real_escape_string($con, $_POST['t_name']);
                    $courseDuration = mysqli_real_escape_string($con, $_POST['c_duration']);
                    $courseCompletedon = mysqli_real_escape_string($con, $_POST['c_completedon']);
                    $courseLink = mysqli_real_escape_string($con, $_POST['c_link']);

                    $sin = "UPDATE `achievement_table` SET `achievement_course` = '$courseName', `achievement_platform` = '$platformName', `achievement_tutor` = '$tutorName', `achievement_courseduration` = '$courseDuration', `achievement_courselink` = '$courseLink', `achievement_completedon` = '$courseCompletedon' WHERE `achievement_userid` = '" . $_SESSION['userIdVce'] . "' AND `achievement_id` = '" . $_GET['aid'] . "'";
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