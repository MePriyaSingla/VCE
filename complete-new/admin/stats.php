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
            <section class="total__users">
                <h3>Total number of Registered users</h3>
                <?php
                $select1 = "SELECT * FROM `user_table`";
                if ($query1 = mysqli_query($con, $select1)) {
                    $totalUsers = mysqli_num_rows($query1);
                ?>
                <p><?php echo $totalUsers; ?></p>
                <?php
                }
                ?>
            </section>

            <section class="user__interest">
                <h3>User Interest</h3>
                <?php
                $select2 = "SELECT * FROM `course_domain`";
                if ($query2 = mysqli_query($con, $select2)) {
                    while ($row2 = mysqli_fetch_array($query2)) {
                        $select3 = "SELECT * FROM user_interest WHERE domain_name = '" . $row2['domain_name'] . "'";
                        if ($query3 = mysqli_query($con, $select3)) {
                            $interestTotal = mysqli_num_rows($query3);
                ?>
                <p><?php echo $row2['domain_name'] . ": " . $interestTotal; ?> users</p>
                <?php }
                    }
                    ?>
                <?php
                }
                ?>
            </section>

            <section class="discussion__groups">
                <h3>Discussion Groups</h3>
                <?php
                $select4 = "SELECT * FROM `discussion_groups`";
                if ($query4 = mysqli_query($con, $select4)) {
                    $totalGroups = mysqli_num_rows($query4);
                ?>
                <p><?php echo $totalGroups; ?></p>
                <?php
                }
                ?>
            </section>

            <section class="enrolled__courses">
                <h3>No. of courses users enrolled in</h3>
                <?php
                $select5 = "SELECT * FROM `course_enrolled`";
                if ($query5 = mysqli_query($con, $select5)) {
                    $totalEnrolled = mysqli_num_rows($query5);
                ?>
                <p><?php echo $totalEnrolled; ?></p>
                <?php
                }
                ?>
            </section>

            <section class="finished__courses">
                <h3>No. of courses users finished</h3>
                <?php
                $select6 = "SELECT * FROM `course_finished`";
                if ($query6 = mysqli_query($con, $select6)) {
                    $totalFinished = mysqli_num_rows($query6);
                ?>
                <p><?php echo $totalFinished; ?></p>
                <?php
                }
                ?>
            </section>
        </main>
    </div>
</body>

</html>