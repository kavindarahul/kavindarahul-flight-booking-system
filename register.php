<?PHP

require_once('inc/config.inc.php'); 

if(isset($_POST['register'])){

    //get form infomation
    $user_name  = mysqli_real_escape_string($connection,$_POST['name']);
    $user_email =  mysqli_real_escape_string($connection,$_POST['email']);
    $password   =  mysqli_real_escape_string($connection,$_POST['password']);

    //encript user password
    $hashed_password = md5($password);

    $randomNumber = 1;

    $query_1 = "INSERT INTO `user` (`user_name`, `user_email`, `user_password`, `user_role`) VALUES ('$user_name', '$user_email', '$hashed_password', '$randomNumber');";
    $result_1 = mysqli_query($connection, $query_1);

    if ($result_1) {
  
    }else{

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .login-container,
        .register-container {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-form {
            background: #fff;
            padding: 40px;
            width: 450px;
            max-width: 100%;
            font-size: 15px;
            border-radius: 4px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        .login-form h3,
        .register-form h3 {
            font-size: 28px;
        }

        .login-form p {
            font-size: 15px;
        }

        .form-input {
            width: 100%;
            padding: 14px;
            border: none;
            background: #eee;
            border-radius: 4px;
        }

        .mb-1 {
            margin-bottom: 1rem;
        }

        .ml-0-5 {
            margin-left: 0.5rem;
        }

        .mr-0-5 {
            margin-right: 0.5rem;
        }

        .d-flex {
            display: flex;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            border: none;
            background: #1c255b;
            color: #fff;
            border-radius: 4px;
        }
    </style>
</head>

<body class="bg-2">

    <div class="register-container">
        <div class="register-form">
            <form action="register.php" method="post">

                <div class="mb-1">
                    <h3>Register</h3>
                </div>

                <div class="mb-1">
                    <label for="username">User Name</label>
                    <input type="text" class="form-input" id="username" name="name">
                </div>

                <div class="mb-1">
                    <label for="email">User Email</label>
                    <input type="email" class="form-input" id="email" name="email">
                </div>

                <div class="mb-1 d-flex justify-content-between">

                    <div class="mb-1 mr-0-5">
                        <label for="password">Password</label>
                        <input type="password" class="form-input" id="password" name="password">
                    </div>

                    <div class="mb-1 ml-0-5">
                        <label for="re-password">Re-Password</label>
                        <input type="password" class="form-input" id="re-password" name="re-password">
                    </div>

                </div>

                <div class="mb-1">
                    <input type="submit" value="register" name="register" class="btn-login">
                </div>

                <div class="mb-1">
                    <p>Already have account? <a href="login.php" style="color: #393f81;">Log in</a></p>
                </div>

            </form>
        </div>
    </div>
</body>

</html>