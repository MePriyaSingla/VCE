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
    <title>Course Fields - Admin Dashboard</title>
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
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="login__form">
                    <h3 class="heading-3">Add Course Field</h3>
                    <div class="input">
                        <label class="label__text">Field Name:</label>
                        <input type="text" class="input__box" name="f_name" required>
                    </div>
                    <div class="input input__btn">
                        <input type="submit" value="Add Field" class="btn" name="add_field">
                    </div>
                </form>
                <?php
                if (isset($_POST['add_field'])) {
                    $fieldName = mysqli_real_escape_string($con, $_POST['f_name']);

                    $sin = "INSERT INTO `course_field` (`field_name`) VALUES ('$fieldName')";
                    $run = mysqli_query($con, $sin);
                    if ($run) {
                        echo '<p class="form_success_msg"><b>Added Successfully</b></p>';
                    } else {
                        echo '<p class="form_error_msg"><b>Opps! Not Added</b></p>';
                    }
                }
                ?>
            </div>

            <div class="view__container">
                <h3 class="heading-3">View Course Fields</h3>
                <div class="table__container">
                    <table class="table">
                        <thead>
                            <th>Sr. No.</th>
                            <th>Field ID</th>
                            <th>Field Name</th>
                            <th>Added On</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php
                            $q1 = "Select * from course_field";
                            $r1 = mysqli_query($con, $q1);
                            $count = 1;
                            while ($row1 = mysqli_fetch_array($r1)) { ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $row1['field_id']; ?></td>
                                <td><?php echo $row1['field_name']; ?></td>
                                <td><?php echo $row1['added_on']; ?></td>
                                <td style="text-align: center;font-size:1.8rem;">
                                    <a href="course-fields-edit.php?fid=<?php echo $row1['field_id']; ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </td>
                                <td style="text-align: center;font-size:1.8rem;">
                                    <a onclick="return confirm('Are you sure you want to delete this item?');"
                                        href="course-fields-delete.php?fid=<?php echo $row1['field_id']; ?>">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                $count++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>