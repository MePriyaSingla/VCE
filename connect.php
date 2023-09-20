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
    <title>Connect with others - User Dashboard</title>
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
            <div class="course__card-container">
                <h3 class="heading-3">
                    Get Connected
                </h3>
                <?php
                $query1 = "SELECT DISTINCT `user_id` FROM `user_interest` WHERE `domain_name` IN (SELECT `domain_name` FROM `user_interest` WHERE `user_id` = '" . $_SESSION['userIdVce'] . "') AND `user_id` != '" . $_SESSION['userIdVce'] . "'";
                $runQ1 = mysqli_query($con, $query1);
                if (mysqli_num_rows($runQ1)) {
                    while ($rowQ1 = mysqli_fetch_array($runQ1)) {
                        $query2 = "SELECT * FROM `user_table` WHERE `user_id` = '" . $rowQ1['user_id'] . "'";
                        $runQ2 = mysqli_query($con, $query2);
                        if (mysqli_num_rows($runQ2)) {
                            while ($rowQ2 = mysqli_fetch_array($runQ2)) { ?>

                                <div class="user__card">
                                    <h3 class="user__name">
                                        <?php echo $rowQ2['user_firstname'] . " " . $rowQ2['user_lastname']; ?>
                                    </h3>
                                    <p class="user_interest">
                                        <span class="user_interest-label">Interests:</span>
                                        <?php
                                        $query3 = "SELECT * FROM `user_interest` WHERE `user_id` = '" . $rowQ2['user_id'] . "'";
                                        $runQ3 = mysqli_query($con, $query3);
                                        if (mysqli_num_rows($runQ3) > 0) {
                                            while ($rowQ3 = mysqli_fetch_array($runQ3)) { ?>
                                                <span>
                                                    <?php
                                                    echo $rowQ3['domain_name'];
                                                    ?>,
                                                </span>
                                        <?php }
                                        } ?>
                                    </p>
                                    <p class="user_achievements">
                                        <?php
                                        $count = 0;
                                        $query4 = "SELECT * FROM achievement_table WHERE achievement_userid = '" . $rowQ2['user_id'] . "'";
                                        $runQ4 = mysqli_query($con, $query4);
                                        if (mysqli_num_rows($runQ4) > 0) {
                                            while ($rowQ4 = mysqli_fetch_array($runQ4)) {
                                                $count++;
                                            }
                                        } ?>
                                        <span>Achievements: <?php echo $count; ?></span>
                                    </p>
                                    <a class="course__link-btn" href="connect-profile.php?profile=<?php echo $rowQ2['user_id'] ?>&fname=<?php echo $rowQ2['user_firstname']; ?>&lname=<?php echo $rowQ2['user_lastname']; ?>">
                                        <i class="bi bi-person-plus"></i> View
                                    </a>
                                </div>
                <?php
                            }
                        }
                    }
                } ?>
            </div>
        </main>
    </div>
</body>

</html>