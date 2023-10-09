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
    <title>User Dashboard</title>
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
                <a href="user-availability.php" class="sidebar__item-link">
                    <li class="sidebar__item">
                        <i class="bi bi-calendar-check"></i>
                        <span>Availability</span>
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
            <div class="login-container-2">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="login__form">
                    <h3 class="heading-3">Add Availability</h3>
                    <div class="input">
                        <label class="label__text">Campus</label>
                        <select class="input__box" name="campus" required>
                            <option selected disabled>Choose</option>
                            <?php
                            $campus = "SELECT * FROM campus_table";
                            $campQuery = mysqli_query($con, $campus);
                            if (mysqli_num_rows($campQuery) > 0) {
                                while ($campRow = mysqli_fetch_array($campQuery)) {
                            ?>
                                    <option value="<?php echo $campRow['campus_name'] ?>"><?php echo $campRow['campus_name'] ?>
                                    </option>

                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input">
                        <label class="label__text">Date</label>
                        <input type="date" class="input__box" name="date" required>
                    </div>
                    <div class="input">
                        <label class="label__text">Availability:</label>
                        <select class="input__box" name="availability" required>
                            <option selected disabled>Choose</option>
                            <option value="Available">Available</option>
                            <option value="Not Available">Not Available</option>
                        </select>
                    </div>
                    <div class="input">
                        <label class="label__text">Time (From):</label>
                        <input type="time" class="input__box" name="t_from">
                    </div>
                    <div class="input">
                        <label class="label__text">Time (To):</label>
                        <input type="time" class="input__box" name="t_to">
                    </div>
                    <div class="input input__btn">
                        <input type="submit" value="Add" class="btn" name="add_availability">
                    </div>
                </form>
                <?php
                if (isset($_POST['add_availability'])) {
                    $date = mysqli_real_escape_string($con, $_POST['date']);
                    $campus = mysqli_real_escape_string($con, $_POST['campus']);
                    $availability = mysqli_real_escape_string($con, $_POST['availability']);
                    $t_from = mysqli_real_escape_string($con, $_POST['t_from']);
                    $t_to = mysqli_real_escape_string($con, $_POST['t_to']);

                    $sin = "INSERT INTO `availability_table` (`user_id`, `campus_name`, `availability_date`, `availability`, `time_from`, `time_to`) VALUES ('" . $_SESSION['userIdVce'] . "','$campus','$date','$availability','$t_from','$t_to')";
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
                <div>
                    <h3 class="heading-3">
                        Your Availability
                    </h3>
                    <div class="table__container">
                        <table class="table">
                            <thead>
                                <th>Sr. No.</th>
                                <th>Campus</th>
                                <th>Availability</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>

                                <?php
                                $count = 1;
                                $query = "SELECT * FROM availability_table WHERE user_id = '" . $_SESSION['userIdVce'] . "'";
                                $runQ = mysqli_query($con, $query);
                                if (mysqli_num_rows($runQ) > 0) {
                                    while ($rowQ = mysqli_fetch_array($runQ)) {
                                ?>

                                        <tr>
                                            <td>
                                                <?php echo $count; ?>
                                            </td>
                                            <td>
                                                <?php echo $rowQ['campus_name']; ?>
                                            </td>
                                            <td style="line-height:2;">
                                                <p>Date:
                                                    <span style="font-weight:600;">
                                                        <?php echo $rowQ['availability_date']; ?>
                                                    </span>
                                                </p>
                                                <p>Availability:
                                                    <?php
                                                    if ($rowQ['availability'] == 'Available') { ?>
                                                        <span style="font-weight:700;color:#295;">
                                                            <?php echo $rowQ['availability']; ?>
                                                        </span>
                                                    <?php
                                                    } else { ?>
                                                        <span style="font-weight:700;color:#922;">
                                                            <?php echo $rowQ['availability']; ?>
                                                        </span>
                                                    <?php
                                                    }
                                                    ?>
                                                </p>
                                                <?php
                                                if ($rowQ['availability'] == 'Available') { ?>
                                                    <p>Time:
                                                        <span style="font-weight:500;"><?php echo $rowQ['time_from']; ?> to
                                                            <?php echo $rowQ['time_to']; ?></span>
                                                    </p>
                                                <?php }
                                                ?>

                                            </td>
                                            <td>
                                                <a href="edit-availability.php?aid=<?php echo $rowQ['availability_id']; ?>" class="edit-btn">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a onclick="return confirm('Are you sure you want to delete this item?');" href="remove-availability.php?aid=<?php echo $rowQ['availability_id']; ?>" class="remove-btn">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                        $count++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>