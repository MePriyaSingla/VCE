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
    <title>User Dashboard</title>
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
            <div class="course__card-container">
                <h3 class="heading-3">
                    Quick links
                </h3>
                <div class="user__card">
                    <h3 class="user__name">
                        Interest
                    </h3>
                    <p class="user_achievements">
                        Add / View
                    </p>
                    <a class="course__link-btn" href="user-interest.php">
                        <i class="bi bi-link-45deg"></i> Open
                    </a>
                </div>
                <div class="user__card">
                    <h3 class="user__name">
                        Achievements
                    </h3>
                    <p class="user_achievements">
                        Add / View
                    </p>
                    <a class="course__link-btn" href="user-achievements.php">
                        <i class="bi bi-link-45deg"></i> Open
                    </a>
                </div>
                <div class="user__card">
                    <h3 class="user__name">
                        Courses
                    </h3>
                    <p class="user_achievements">
                        Explore
                    </p>
                    <a class="course__link-btn" href="explore-courses.php">
                        <i class="bi bi-link-45deg"></i> Open
                    </a>
                </div>
                <div class="user__card">
                    <h3 class="user__name">
                        Connect
                    </h3>
                    <p class="user_achievements">
                        &amp; Chat
                    </p>
                    <a class="course__link-btn" href="connect.php">
                        <i class="bi bi-link-45deg"></i> Open
                    </a>
                </div>
                <div class="user__card">
                    <h3 class="user__name">
                        Discussions
                    </h3>
                    <p class="user_achievements">
                        &amp; Chat
                    </p>
                    <a class="course__link-btn" href="group-discussions.php">
                        <i class="bi bi-link-45deg"></i> Open
                    </a>
                </div>
                <div class="user__card">
                    <h3 class="user__name">
                        Availability
                    </h3>
                    <p class="user_achievements">
                        day &amp; time
                    </p>
                    <a class="course__link-btn" href="user-availability.php">
                        <i class="bi bi-link-45deg"></i> Open
                    </a>
                </div>
                <div class="user__card">
                    <h3 class="user__name">
                        Profile
                    </h3>
                    <p class="user_achievements">
                        Edit
                    </p>
                    <a class="course__link-btn" href="profile.php">
                        <i class="bi bi-link-45deg"></i> Open
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>

</html>