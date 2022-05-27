<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="libs/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <main style="background:white;">
            <div class="container" style="position:relative; top: 150px;">
            <div class="login-form">
                <form action="" method="post">
                    <h1>Register</h1>

<?php 
    include 'libs/config.php';
    session_start();
    if(isset($_POST['submit']) && validate_name($_POST['name']) && validate($_POST['username']) && validate($_POST['password']) && validate($_POST['repassword']) && validate_phone($_POST['phone_number']) && $_POST['password'] == $_POST['repassword']) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password =md5($_POST['password'].'md5');
        $phone_number = $_POST['phone_number'];
        $role = 0;
        // $time = date('YmdHis');

        $sql1 = "SELECT * FROM login WHERE username='$username'";
        $query1 = mysqli_query($conn, $sql1);

        $sql2 = "SELECT * FROM login WHERE phone='$phone_number'";
        $query2 = mysqli_query($conn, $sql2);

        if(mysqli_num_rows($query1) > 0) {
            echo "The username has been registered, please enter another username!";
        }
        else if(mysqli_num_rows($query2) > 0) {
            echo "The Phone Number has been registered, please enter another Phone Number!";
        } else {
            $sql = "INSERT INTO `login` (`username`, `password`, `name`, `phone`, `role`, `dateCreate`) VALUES ('$username', '$password', '$name', '$phone_number', '$role', now())";
            $query = mysqli_query($conn, $sql);
            echo "--query";
            if(!$query) {
                echo("Error description: " . mysqli_error($conn));
            } else echo "Success";
            $_SESSION['user'] = $username;
            $_SESSION['role'] = $role;
            header("location:account.php");
        }
    }
    elseif(isset($_POST['phone_number']) && !validate_phone($_POST['phone_number'])) {
        ?>
            <br><p style="position: relative;left:120px;"><?php echo "Please enter the correct phone number!"; ?></p>
        <?php
    }
    elseif(isset($_POST['name']) && !validate_name($_POST['name'])) {
        ?>
            <br><p style="position: relative;left:120px;"><?php echo "Please enter the correct full name!"; ?></p>
        <?php
    }
?>

                    <div class="input-box">
                        <i ></i>
                        <input name="name" type="text" placeholder="Fullname" required>
                    </div>
                    <div class="input-box">
                        <i ></i>
                        <input name="username" type="text" placeholder="Username" required>
                    </div>
                    <div class="input-box">
                        <i ></i>
                        <input name="password" type="password" placeholder="Password" required>
                    </div>
                    <div class="input-box">
                        <i ></i>
                        <input name="repassword" type="password" placeholder="Re-Password" required>
                    </div>
                    <div class="input-box">
                        <i ></i>
                        <input name="phone_number" type="text" placeholder="PhoneNumber" required>
                    </div>
                    <a href="./">I had account! Login</a>
                    <div class="btn-box">
                        <button name="submit" type="submit">
                            Register
                        </button>
                    </div>
                </form>
            </div>
            </div>
        </main>
    </body>
</html>

