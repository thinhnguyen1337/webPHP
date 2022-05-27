<?php
    include 'libs/config.php';
    session_start();
    if(!isset($_SESSION['user']) && is_null($_SESSION['user']) && is_null($_SESSION['role'])) header('location:index.php');
    $username = $_SESSION['user'];
    $sql = "SELECT * FROM login WHERE username='$username'";
    $row = db_get_row($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Account Information</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .ip-b {width:250px;}
        </style>
    </head>
    <body>
        <main style="background:white;">
            <div class="container" style="position:relative; top: 20px; left: 50px;">
            <div><a href="account-admin.php">Return Dashboard</a></div>
            <div class="login-form">
                <form action="" method="POST">
                    <h1>Account Information</h1>
                    <table style="text-align:left;">
                        <tr>
                            <th>Full Name:</th>
                            <td><input class="ip-b" name="name" type="text" value="<?php echo $row['name']; ?>" required></td>
                        </tr>
                        <tr>
                            <th>Username:</th>
                            <td><input class="ip-b" name="username" type="text" value="<?php echo $row['username']; ?>" disabled></td>
                        </tr>
                        <tr>
                            <th>Password:</th>
                            <td><input class="ip-b" name="password" type="password" placeholder="Input if you want change password"></td>
                        </tr>
                        <tr>
                            <th>RePassword:</th>
                            <td><input class="ip-b" name="repassword" type="password" placeholder="Repeat if you want change password"></td>
                        </tr>
                        <tr>
                            <th>Sex:</th>
                            <td><input name="sex" type="radio" value="Male" <?php if($row['sex'] == '0') echo "checked" ?>>
                                <label for="sex">Male</label>
                             <input name="sex" type="radio" value="Female" <?php if($row['sex'] == '1') echo "checked" ?>>
                                <label for="sex">Female</label>
                         </td>   
                        </tr>
                        <tr>
                            <th>Birthday:</th>
                            <td><input class="ip-b" name="birthday" type="date" value="<?php echo $row['birthday'] ?>"></td>
                        </tr>
                        <tr>
                            <th>Phone Number:</th>
                            <td><input class="ip-b" name="phone_number" type="text" value="<?php echo $row['phone']; ?>" required></td>
                        </tr>
                    </table>
                    <br>
                    <div class="btn-box" style="position:relative; left:150px;">
                        <button name="submit" type="submit">Change</button>
                    </div>
                </form>
            </div>
            </div>
        </main>
    </body>
</html>

<?php  
    if(isset($_POST['submit']) && validate_name($_POST['name']) && validate_phone($_POST['phone_number']) && $_POST['password'] == $_POST['repassword']) {
        $name = $_POST['name'];
        $sex = ($_POST['sex'] == 'Male') ? 0 : 1;
        $password =$_POST['password'];
        $phone_number = $_POST['phone_number'];
        $role = 0;
        $birthday = $_POST['birthday'];

        $sql1 = "SELECT phone FROM login WHERE phone='$phone_number' EXCEPT SELECT phone FROM login WHERE username='$username'";
        $query1 = mysqli_query($conn, $sql1);
        if(mysqli_num_rows($query1) > 0) {
        ?>
            <br><p style="position: relative;left:120px;"><?php echo "The phone number already existed!"; ?></p>
        <?php
        } 
        elseif($password == '') {
            $sql = "UPDATE `login` SET `name`='$name',`sex`='$sex',`phone`='$phone_number',`birthday`='$birthday' WHERE username='$username'";
            $query = mysqli_query($conn, $sql);
        ?>
            <br><p style="position: relative;left:120px;"><?php echo "Change infomation success!"; ?></p>
        <?php
            header("refresh: 2");
        }
        elseif($password != '') {
            $password = md5($_POST['password'].'md5');
            $sql = "UPDATE `login` SET `password`='$password',`name`='$name',`sex`='$sex',`phone`='$phone_number',`birthday`='$birthday' WHERE username='$username'";
            $query = mysqli_query($conn, $sql);
        ?>
            <br><p style="position: relative;left:120px;"><?php echo "Change infomation success!"; ?></p>
        <?php
            header("refresh: 2");
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
