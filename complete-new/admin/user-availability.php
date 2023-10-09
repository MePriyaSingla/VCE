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
            <h3 class="heading-3">View Availability</h3>
            <div class="table__container">
                <table class="table">
                    <thead>
                        <th>Sr. No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Availability</th>
                    </thead>
                    <tbody>
                        <?php
                        $count = 0;
                        $select1 = "SELECT * FROM `availability_table`";
                        $query1 = mysqli_query($con, $select1);
                        if (mysqli_num_rows($query1) > 0) {
                            while ($row1 = mysqli_fetch_array($query1)) {
                                $count++;
                                $select2 = "SELECT * FROM `user_table` WHERE user_id = '" . $row1['user_id'] . "'";
                                $query2 = mysqli_query($con, $select2);
                                if (mysqli_num_rows($query2) > 0) {
                                    while ($row2 = mysqli_fetch_array($query2)) { ?>
                                        <tr>
                                            <td style="text-align:center;">
                                                <?php echo $count; ?>
                                            </td>
                                            <td style="text-align:center;">
                                                <?php echo $row2['user_firstname'] . " " . $row2['user_lastname']; ?>
                                            </td>
                                            <td style="text-align:center;">
                                                <?php echo $row2['user_email']; ?>
                                            </td>
                                            <td style="text-align:center;">
                                                <?php echo $row2['user_phone']; ?>
                                            </td>
                                            <td style="line-height:2;">
                                                <p>Campus:
                                                    <span style="font-weight:500;">
                                                        <?php echo $row1['campus_name']; ?>
                                                    </span>
                                                </p>
                                                <p>Date:
                                                    <span style="font-weight:600;">
                                                        <?php echo $row1['availability_date']; ?>
                                                    </span>
                                                </p>
                                                <p>Availability:
                                                    <?php
                                                    if ($row1['availability'] == 'Available') { ?>
                                                        <span style="font-weight:700;color:#295;">
                                                            <?php echo $row1['availability']; ?>
                                                        </span>
                                                    <?php
                                                    } else { ?>
                                                        <span style="font-weight:700;color:#922;">
                                                            <?php echo $row1['availability']; ?>
                                                        </span>
                                                    <?php
                                                    }
                                                    ?>
                                                </p>
                                                <?php
                                                if ($row1['availability'] == 'Available') { ?>
                                                    <p>Time:
                                                        <span style="font-weight:500;"><?php echo $row1['time_from']; ?> to
                                                            <?php echo $row1['time_to']; ?></span>
                                                    </p>
                                                <?php }
                                                ?>

                                            </td>
                                        </tr>

                        <?php }
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>