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
            <h3 class="user__name-chat">
                Chat with <?php
                            echo $_GET['fname'] . " " . $_GET['lname']; ?>
            </h3>
            <h4 class="user__chat-window">Chat Window</h4>
            <div class="user__chat-container">
                <div class="user__chat-area">
                    <?php
                    $qM = "SELECT * FROM `individual_chat` WHERE (`message_from` = '" . $_SESSION['userIdVce'] . "' AND `message_to` = '" . $_GET['profile'] . "') OR (`message_from` = '" . $_GET['profile'] . "' AND `message_to` = '" . $_SESSION['userIdVce'] . "')";
                    $rM = mysqli_query($con, $qM);
                    if (mysqli_num_rows($rM) > 0) {
                        while ($rowM = mysqli_fetch_array($rM)) {
                            if ($rowM['message_from'] == $_SESSION['userIdVce']) { ?>
                    <p></p>
                    <p class="user__chat-msg-sent">
                        <?php echo $rowM['message']; ?>
                    </p>
                    <?php } else { ?>
                    <p class="user__chat-msg-recieve">
                        <?php echo $rowM['message']; ?>
                    </p>
                    <p></p>
                    <?php }
                        }
                    } else { ?>
                    <span>Start messaging...</span>
                    <?php }
                    ?>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>" method="post"
                    class="user__chat-typing">
                    <input class="user_chat-input" type="text" placeholder="Type message..." name="u_msg"
                        autocomplete="off">
                    <input type="submit" class="user__chat-btn" value="Send" name="msg_sent">
                </form>
                <?php
                if (isset($_POST['msg_sent'])) {
                    $user_message = mysqli_real_escape_string($con, $_POST['u_msg']);

                    $sin = "INSERT INTO `individual_chat` (`message_from`, `message_to`, `message`) VALUES ('" . $_SESSION['userIdVce'] . "','" . $_GET['profile'] . "','$user_message')";
                    $run = mysqli_query($con, $sin);
                    if ($run) {
                        echo("<script>location.href = '".$_SERVER['REQUEST_URI']."';</script>");
                    }
                }
                ?>
            </div>
        </main>
    </div>
</body>

</html>