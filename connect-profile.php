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
            <?php ?>
            <h3 class="user__name-connect">
                <?php
                echo $_GET['fname'] . " " . $_GET['lname']; ?>
            </h3>
            <a class="course__link-btn" href="individual-chat.php?profile=<?php echo $_GET['profile'] ?>&fname=<?php echo $_GET['fname']; ?>&lname=<?php echo $_GET['lname']; ?>">
                <i class="bi bi-chat-left"></i>
            </a>
            <div class="user__connect-container">
                <?php
                $query = "SELECT * FROM achievement_table WHERE achievement_userid = '" . $_GET['profile'] . "'";
                $runQ = mysqli_query($con, $query);
                if (mysqli_num_rows($runQ) > 0) {
                    while ($rowQ = mysqli_fetch_array($runQ)) {
                ?>

                        <div class="user__connect-card">
                            <span class="achievement_trophy">
                                <i class="bi bi-trophy-fill"></i>
                            </span>
                            <h3 class="course__name-heading">
                                <?php echo $rowQ['achievement_course']; ?>
                            </h3>
                            <p class="course__tutor-name">
                                <span class="course__tutor-label">Tutor:</span>
                                <span><?php echo $rowQ['achievement_tutor']; ?></span>
                            </p>
                            <p class="course__completedon">
                                <span>Completed on:</span>
                                <span><?php echo $rowQ['achievement_completedon']; ?></span>
                            </p>
                            <div class="course__level-duration">
                                <p class="course__level">
                                    <span>
                                        <i class="bi bi-boxes"></i>
                                    </span>
                                    <span><?php echo $rowQ['achievement_platform']; ?></span>
                                </p>
                                <p class="course__duration">
                                    <span>
                                        <i class="bi bi-alarm"></i>
                                    </span>
                                    <span>
                                        <?php echo $rowQ['achievement_courseduration']; ?>
                                    </span>
                                </p>
                            </div>
                            <?php
                            if ($rowQ['achievement_courselink'] == '') { ?>
                                <a class="course__link-btn" href="#">
                                    Offline
                                </a>
                            <?php } else { ?>
                                <a class="course__link-btn" target="_blank" href="<?php echo $rowQ['achievement_courselink']; ?>">
                                    Go to course
                                </a>
                            <?php
                            }
                            ?>
                        </div>

                    <?php
                    }
                } else { ?>
                    <p class="no__achievement">No Achievements added</p>
                <?php
                }
                ?>
            </div>
        </main>
    </div>
</body>

</html>