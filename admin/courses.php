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
    <title>Courses - Admin Dashboard</title>
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
            </ul>
        </section>
        <main class="main__content">
            <div class="login-container-2">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="login__form">
                    <h3 class="heading-3">Add Course</h3>
                    <div class="input">
                        <label class="label__text">Choose Field:</label>
                        <select name="f_name" class="input__box" required>
                            <option selected disabled hidden>Choose</option>
                            <?php
                            $q = "Select * from course_field";
                            $r = mysqli_query($con, $q);
                            while ($row = mysqli_fetch_array($r)) { ?>
                                <option value="<?php echo $row['field_name']; ?>">
                                    <?php echo $row['field_name']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input">
                        <label class="label__text">Choose Domain:</label>
                        <select name="d_name" class="input__box" required>
                            <option selected disabled hidden>Choose</option>
                            <?php
                            $q = "Select * from course_domain";
                            $r = mysqli_query($con, $q);
                            while ($row = mysqli_fetch_array($r)) { ?>
                                <option value="<?php echo $row['domain_name']; ?>">
                                    <?php echo $row['domain_field'] . ' -> ' . $row['domain_name']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input">
                        <label class="label__text">Course Name:</label>
                        <input type="text" class="input__box" name="c_name" required>
                    </div>
                    <div class="input">
                        <label class="label__text">Platform Name:</label>
                        <input type="text" class="input__box" name="p_name" required>
                    </div>
                    <div class="input">
                        <label class="label__text">Tutor Name:</label>
                        <input type="text" class="input__box" name="t_name" required>
                    </div>
                    <div class="input">
                        <label class="label__text">Course Level:</label>
                        <select name="c_level" class="input__box" required>
                            <option disabled selected hidden>Select</option>
                            <option value="Beginner">Beginner</option>
                            <option value="Intemediate">Intemediate</option>
                            <option value="Advanced">Advanced</option>
                        </select>
                    </div>
                    <div class="input">
                        <label class="label__text">Course Link:</label>
                        <input type="text" class="input__box" name="c_link" required>
                    </div>
                    <div class="input">
                        <label class="label__text">Course Duration:</label>
                        <input type="text" class="input__box" name="c_duration" required>
                    </div>
                    <div class="input input__btn">
                        <input type="submit" value="Add Course" class="btn" name="add_course">
                    </div>
                </form>
                <?php
                if (isset($_POST['add_course'])) {
                    $fieldName = mysqli_real_escape_string($con, $_POST['f_name']);
                    $domainName = mysqli_real_escape_string($con, $_POST['d_name']);
                    $courseName = mysqli_real_escape_string($con, $_POST['c_name']);
                    $platformName = mysqli_real_escape_string($con, $_POST['p_name']);
                    $tutorName = mysqli_real_escape_string($con, $_POST['t_name']);
                    $courseLevel = mysqli_real_escape_string($con, $_POST['c_level']);
                    $courseLink = mysqli_real_escape_string($con, $_POST['c_link']);
                    $courseDuration = mysqli_real_escape_string($con, $_POST['c_duration']);

                    $sin = "INSERT INTO `course_table` (`course_field`,`course_domain`,`course_name`,`platform_name`,`tutor_name`,`course_level`,`course_link`,`course_duration`) VALUES ('$fieldName','$domainName','$courseName','$platformName','$tutorName','$courseLevel','$courseLink','$courseDuration')";
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
                <h3 class="heading-3">View Courses</h3>
                <div class="table__container">
                    <table class="table">
                        <thead>
                            <th>Sr. No.</th>
                            <th>Course ID</th>
                            <th>Field Name</th>
                            <th>Domain Name</th>
                            <th>Course Name</th>
                            <th>Platform Name</th>
                            <th>Tutor Name</th>
                            <th>Course Level</th>
                            <th>Course Link</th>
                            <th>Course Duration</th>
                            <th>Added On</th>
                        </thead>
                        <tbody>
                            <?php
                            $q1 = "Select * from course_table";
                            $r1 = mysqli_query($con, $q1);
                            $count = 1;
                            while ($row1 = mysqli_fetch_array($r1)) { ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $row1['course_id']; ?></td>
                                    <td><?php echo $row1['course_field']; ?></td>
                                    <td><?php echo $row1['course_domain']; ?></td>
                                    <td><?php echo $row1['course_name']; ?></td>
                                    <td><?php echo $row1['platform_name']; ?></td>
                                    <td><?php echo $row1['tutor_name']; ?></td>
                                    <td><?php echo $row1['course_level']; ?></td>
                                    <td>
                                        <a target="_blank" href="<?php echo $row1['course_link']; ?>">
                                            <?php echo $row1['course_link']; ?>
                                        </a>
                                    </td>
                                    <td><?php echo $row1['course_duration']; ?></td>
                                    <td><?php echo $row1['added_on']; ?></td>
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