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
                    Groups
                </h3>
                <?php
                $select1 = "SELECT * FROM `course_domain`";
                $query1 = mysqli_query($con, $select1);
                if (mysqli_num_rows($query1) > 0) {
                    $count = 0;
                    while ($row1 = mysqli_fetch_array($query1)) {
                        $select2 = "SELECT * FROM `user_interest` WHERE `field_name` = '" . $row1['domain_field'] . "' AND `domain_name` = '" . $row1['domain_name'] . "'";
                        $query2 = mysqli_query($con, $select2);
                        if (mysqli_num_rows($query1) > 0) {
                            while ($row2 = mysqli_fetch_array($query2)) {
                                $count++;
                                if ($count >= 3) {
                                    $select3 = "SELECT * FROM `discussion_groups` WHERE `group_field` = '" . $row1['domain_field'] . "' AND `group_domain` = '" . $row1['domain_name'] . "'";
                                    $query3 = mysqli_query($con, $select3);
                                    if (mysqli_num_rows($query3) == 0) {
                                        $insert4 = "INSERT INTO `discussion_groups`(`group_field`, `group_domain`) VALUES ('" . $row1['domain_field'] . "','" . $row1['domain_name'] . "')";
                                        $query4 = mysqli_query($con, $insert4);
                                    }
                                }
                            }
                        }
                    }
                }
                ?>
                <?php
                $select5 = "SELECT * FROM `user_interest` WHERE `user_id` = '" . $_SESSION['userIdVce'] . "'";
                $query5 = mysqli_query($con, $select5);
                if (mysqli_num_rows($query5) > 0) {
                    while ($row5 = mysqli_fetch_array($query5)) {
                        $select6 = "SELECT * FROM `discussion_groups` WHERE `group_field` = '" . $row5['field_name'] . "' AND `group_domain` = '" . $row5['domain_name'] . "'";
                        $query6 = mysqli_query($con, $select6);
                        if (mysqli_num_rows($query6) > 0) {
                            while ($row6 = mysqli_fetch_array($query6)) { ?>

                                <div class="group__card">
                                    <h3 class="group__name">
                                        <?php echo $row6['group_field']; ?> - <?php echo $row6['group_domain']; ?>
                                    </h3>
                                    <a class="group__link-btn" href="group-discussion-window.php?gid=<?php echo $row6['group_id']; ?>&gf=<?php echo $row6['group_field']; ?>&gd=<?php echo $row6['group_domain']; ?>">
                                        <i class="bi bi-chat-right"></i>
                                    </a>
                                </div>

                <?php }
                        }
                    }
                }
                ?>
            </div>
        </main>
    </div>
</body>

</html>