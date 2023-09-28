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
                <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>" method="post" class="login__form">
                    <h3 class="heading-3">Edit Course</h3>
                    <?php
                    $sq = "SELECT * FROM `course_table` WHERE `course_id` = '" . $_GET['cid'] . "'";
                    $sr = mysqli_query($con, $sq);
                    if (mysqli_num_rows($sr) > 0) {
                        while ($srow = mysqli_fetch_array($sr)) {
                    ?>
                            <div class="input">
                                <label class="label__text">Choose Field:</label>
                                <select name="f_name" class="input__box" required>
                                    <option selected value="<?php echo $srow['course_field']; ?>">
                                        <?php echo $srow['course_field']; ?></option>
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
                                    <option selected value="<?php echo $srow['course_domain']; ?>">
                                        <?php echo $srow['course_domain']; ?></option>
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
                                <input type="text" value="<?php echo $srow['course_name']; ?>" class="input__box" name="c_name" required>
                            </div>
                            <div class="input">
                                <label class="label__text">Platform Name:</label>
                                <input type="text" value="<?php echo $srow['platform_name']; ?>" class="input__box" name="p_name" required>
                            </div>
                            <div class="input">
                                <label class="label__text">Tutor Name:</label>
                                <input type="text" value="<?php echo $srow['tutor_name']; ?>" class="input__box" name="t_name" required>
                            </div>
                            <div class="input">
                                <label class="label__text">Course Level:</label>
                                <select name="c_level" class="input__box" required>
                                    <option selected value="<?php echo $srow['course_level']; ?>">
                                        <?php echo $srow['course_level']; ?></option>
                                    <option value="Beginner">Beginner</option>
                                    <option value="Intemediate">Intemediate</option>
                                    <option value="Advanced">Advanced</option>
                                </select>
                            </div>
                            <div class="input">
                                <label class="label__text">Course Link:</label>
                                <input type="text" value="<?php echo $srow['course_link']; ?>" class="input__box" name="c_link" required>
                            </div>
                            <div class="input">
                                <label class="label__text">Course Duration:</label>
                                <input type="text" value="<?php echo $srow['course_duration']; ?>" class="input__box" name="c_duration" required>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <div class="input input__btn">
                        <input type="submit" value="Update Course" class="btn" name="edit_course">
                    </div>
                </form>
                <?php
                if (isset($_POST['edit_course'])) {
                    $fieldName = mysqli_real_escape_string($con, $_POST['f_name']);
                    $domainName = mysqli_real_escape_string($con, $_POST['d_name']);
                    $courseName = mysqli_real_escape_string($con, $_POST['c_name']);
                    $platformName = mysqli_real_escape_string($con, $_POST['p_name']);
                    $tutorName = mysqli_real_escape_string($con, $_POST['t_name']);
                    $courseLevel = mysqli_real_escape_string($con, $_POST['c_level']);
                    $courseLink = mysqli_real_escape_string($con, $_POST['c_link']);
                    $courseDuration = mysqli_real_escape_string($con, $_POST['c_duration']);

                    $sin = "UPDATE `course_table` SET `course_field` = '$fieldName',`course_domain` = '$domainName',`course_name` = '$courseName',`platform_name` = '$platformName',`tutor_name` = '$tutorName',`course_level` = '$courseLevel',`course_link` = '$courseLink',`course_duration` = '$courseDuration'";
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