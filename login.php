<?PHP

//inport db connection
require_once('inc/config.inc.php'); 

if(isset($_POST['login'])){

    //get form infomation
    $email =  mysqli_real_escape_string($connection,$_POST['user_email']);
    $password   =  mysqli_real_escape_string($connection,$_POST['password']);

    //encript user password
    $hashed_password = md5($password); 

    //check user available
    $query_1 = "SELECT user_email, user_id, user_role FROM user 
    WHERE user_email = '{$email}' AND user_password = '{$hashed_password}' LIMIT 1";    
    $result_1 = mysqli_query($connection, $query_1);

    if ($result_1 && mysqli_num_rows($result_1) == 1) {
        $user = mysqli_fetch_assoc($result_1);
        //save user details in SESSION variable
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_role'] = $user['user_role'];
        if($user['user_role'] == 1){
            //rederect user to dashboard
            header('Location: dashboard.php');
        }else{
            //rederect user to home page
            header('Location: index.php');
        }
    }else{
        $error = "Username or password is invalid.";
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="img/icons8-flight-100.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .login-container {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-form {
            background: #fff;
            padding: 40px;
            max-width: 400px;
            font-size: 15px;
            border-radius: 4px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        .login-form h3 {
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

        .error-box {
            background: #ff1100;
            padding: 10px;
            font-size: 14px;
            color: #fff;
            border-radius: 4px;
            text-align: center;
        }
    </style>
</head>

<body class="bg-2">

    <div class="login-container">

        <div class="login-form">

            <form action="login.php" method="post">

                <div class="mb-1">
                    <h3>Login</h3>
                </div>

                <?php
                
                    if(isset($error)){
                        ?>
                            <div class="mb-1 error-box">
                                <?php echo $error ?>
                            </div>
                        <?php
                    }

                ?>

                <div class="mb-1">
                    <label for="useremail">User Email</label>
                    <input type="email" class="form-input" id="user_email" name="user_email" required>
                </div>

                <div class="mb-1">
                    <label for="password">Password</label>
                    <input type="password" class="form-input" id="password" name="password" required>
                </div>

                <div class="mb-1 d-flex justify-content-between">

                    <div class="bd-highlight">
                        <input class="" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">Remember me</label>
                    </div>

                    <div class="bd-highlight">
                        <span class="ml-auto"><a href="" class="forgot-pass">ForgotPassword</a></span>
                    </div>

                </div>

                <div class="mb-1">
                    <input type="submit" value="Log In" name="login" class="btn-login">
                </div>

                <div class="mb-1">
                    <p>Don't have an account? <a href="register.php" style="color: #393f81;">Register here</a></p>
                </div>

            </form>

        </div>

    </div>

</body>

</html>