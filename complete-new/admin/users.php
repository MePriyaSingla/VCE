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
                    <h3 class="heading-3">Create user</h3>
                    <div class="input">
                        <label class="label__text">First Name:</label>
                        <input type="text" class="input__box" name="user_fname" id="f_name" required>
                    </div>
                    <div class="input">
                        <label class="label__text">Last Name:</label>
                        <input type="text" class="input__box" name="user_lname" id="l_name" required>
                    </div>
                    <div class="input">
                        <label class="label__text">Email:</label>
                        <input type="email" class="input__box" name="user_mail" id="email" required>
                    </div>
                    <div class="input">
                        <label class="label__text">Phone:</label>
                        <input type="text" class="input__box" name="user_phone" id="phone" required>
                    </div>
                    <div class="input">
                        <label class="label__text">Password:</label>
                        <input type="password" class="input__box" name="user_pass" id="password" required>
                    </div>
                    <div class="input">
                        <label class="label__text">User Type:</label>
                        <select name="user_type" class="input__box" id="utype" required>
                            <option disabled selected hidden>Select</option>
                            <option value="Student">Student</option>
                            <option value="Industrialist">Industrialist</option>
                        </select>
                    </div>
                    <div class="input input__btn">
                        <input type="submit" value="Create" class="btn" name="create_user">
                    </div>
                </form>
                <?php
                if (isset($_POST['create_user'])) {
                    $userFname = mysqli_real_escape_string($con, $_POST['user_fname']);
                    $userLname = mysqli_real_escape_string($con, $_POST['user_lname']);
                    $userMail = mysqli_real_escape_string($con, $_POST['user_mail']);
                    $userPhone = mysqli_real_escape_string($con, $_POST['user_phone']);
                    $userPassword = mysqli_real_escape_string($con, $_POST['user_pass']);
                    $userType = mysqli_real_escape_string($con, $_POST['user_type']);

                    $sin = "INSERT INTO `user_table` (`user_firstname`, `user_lastname`, `user_type`, `user_email`, `user_phone`, `user_password`) VALUES ('$userFname', '$userLname', '$userType', '$userMail', '$userPhone', '$userPassword')";
                    $run = mysqli_query($con, $sin);
                    if ($run) {
                        echo '<p class="form_success_msg"><b>Created Successfully</b></p>';
                    } else {
                        echo '<p class="form_error_msg"><b>Opps! Not Created</b></p>';
                    }
                }
                ?>
            </div>

            <div class="view__container">
                <h3 class="heading-3">View users</h3>
                <div class="table__container">
                    <table class="table">
                        <thead>
                            <th>Sr. No.</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>Created On</th>
                        </thead>
                        <tbody>
                            <?php
                            $q1 = "Select * from user_table";
                            $r1 = mysqli_query($con, $q1);
                            $count = 1;
                            while ($row1 = mysqli_fetch_array($r1)) { ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $row1['user_id']; ?></td>
                                    <td><?php echo $row1['user_firstname'] . ' ' . $row1['user_lastname']; ?></td>
                                    <td><?php echo $row1['user_email']; ?></td>
                                    <td><?php echo $row1['user_phone']; ?></td>
                                    <td><?php echo $row1['user_type']; ?></td>
                                    <td><?php echo $row1['user_createdon']; ?></td>
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