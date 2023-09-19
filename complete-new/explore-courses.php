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
    <title>Explore Courses - User Dashboard</title>
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
                    Course Recommendations
                </h3>
                <?php
                $q2 = "SELECT * FROM user_interest WHERE user_id = '" . $_SESSION['userIdVce'] . "'";
                $r2 = mysqli_query($con, $q2);
                if (mysqli_num_rows($r2) > 0) {
                    while ($row2 = mysqli_fetch_array($r2)) {
                        $query = "SELECT * FROM course_table WHERE course_domain = '" . $row2['domain_name'] . "'";
                        $runQ = mysqli_query($con, $query);
                        if (mysqli_num_rows($runQ) > 0) {
                            while ($rowQ = mysqli_fetch_array($runQ)) {
                ?>

                                <div class="course__card">
                                    <p class="course__domain">
                                        <?php echo $rowQ['course_domain']; ?>
                                    </p>
                                    <h3 class="course__name-heading">
                                        <?php echo $rowQ['course_name']; ?>
                                    </h3>
                                    <p class="course__tutor-name">
                                        <span class="course__tutor-label">Tutor:</span>
                                        <span><?php echo $rowQ['tutor_name']; ?></span>
                                    </p>
                                    <div class="course__level-duration">
                                        <p class="course__level">
                                            <span>
                                                <i class="bi bi-boxes"></i>
                                            </span>
                                            <span><?php echo $rowQ['course_level']; ?></span>
                                        </p>
                                        <p class="course__duration">
                                            <span>
                                                <i class="bi bi-alarm"></i>
                                            </span>
                                            <span>
                                                <?php echo $rowQ['course_duration']; ?>
                                            </span>
                                        </p>
                                    </div>
                                    <a class="course__link-btn" target="_blank" href="<?php echo $rowQ['course_link']; ?>">
                                        Go to course
                                    </a>
                                </div>

                        <?php
                            }
                        }
                        ?>
                    <?php
                    }
                } else { ?>

                <?php }
                ?>
            </div>
        </main>
    </div>
</body>

</html>