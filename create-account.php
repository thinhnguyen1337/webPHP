<!DOCTYPE html>
<html>
    <head>
        <title>Create Account</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .ip-b {width:250px;}
        </style>
    </head>
    <body>
        <main style="background:white;">
            <div class="container" style="position:relative; top: 20px; left: 50px;">
            <div><a href="list-account.php">Return List Account</a></div>
            <div class="login-form">
                <form action="" method="POST">
                    <h1>Create Account</h1>
                    <table style="text-align:left;">
                        <tr>
                            <th>Full Name:</th>
                            <td><input name="name" type="text" placeholder="Fullname" required></td>
                        </tr>

                        <tr>
                            <th>Username:</th>
                            <td><input name="username" type="text" placeholder="Username" required></td>
                        </tr>

                        <tr>
                            <th>Password:</th>
                            <td><input name="password" type="password" placeholder="Password" required></td>
                        </tr>

                        <!-- <tr>
                            <th>Birthday:</th>
                            <td><input class="ip-b" name="birthday" type="date"></td>
                        </tr> -->

                        <tr>
                            <th>Phone Number:</th>
                            <td><input name="phone_number" type="text" placeholder="PhoneNumber" required></td>
                        </tr>
                    </table>
                    <br>
                    <div class="btn-box" style="position:relative; left:150px;">
                        <button name="submit" type="submit">Create</button>
                    </div>
                </form>
            </div>
            </div>
        </main>
    </body>
</html>

<?php 
    include 'libs/config.php';
    session_start();
    if(!is_admin()) header('location:account.php');
    if(isset($_POST['submit']) && validate_name($_POST['name']) && validate($_POST['username']) && validate($_POST['password']) && validate_phone($_POST['phone_number'])) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password =md5($_POST['password'].'md5');
        $phone_number = $_POST['phone_number'];
        $birthday = $_POST['birthday'];
        $role = 0;
        $time = date('YmdHis');

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
            $sql = "INSERT INTO `login` (`username`, `password`, `name`, `birthday`, `phone`, `role`, `dateCreate`) VALUES ('$username', '$password', '$name', '$birthday', '$phone_number', '$role', '$time')";
            $query = mysqli_query($conn, $sql);
            header("location:list-account.php");
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