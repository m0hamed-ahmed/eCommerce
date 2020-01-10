<?php 
    session_start();
    $pageTitle = 'Login';
    include 'init.php';

    if (isset($_SESSION['user'])) {
        header("location: index.php");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'):

        if(isset($_POST['login'])) {
            
            $username = $_POST['username'];
            $password = $_POST['password'];
            $hashPass = sha1($password); 

            $stmt = $conn->prepare("SELECT user_id, user_name, password FROM users WHERE user_name = ? AND password = ?");
            $stmt->execute(array($username, $hashPass));
            $user = $stmt->fetch();
            $count = $stmt->rowCount();

            if($count > 0 )
            {
                $_SESSION['user'] = $username;   
                $_SESSION['uid'] = $user['user_id'];   
                header("location: index.php");
                exit();
            }
            
        } // End Login

        if(isset($_POST['signup'])) {
            
            $username  = $_POST['username'];
            $email     = $_POST['email'];
            $password  = $_POST['password'];
            $password2 = $_POST['password2'];

            $formErrors = array();
            
            if(empty($username))
                $formErrors[] = 'Username Can\'t Be Empty';
            if(empty($password))
                $formErrors[] = 'Password Can\'t Be Empty';
            if(empty($email))
                $formErrors[] = 'Email Can\'t Be Empty';
            if($password != $password2)
                $formErrors[] = 'The Password Not Identical';
            
            if(empty($formErrors)) {
                
                if(checkUser('user_name', 'users', 'user_name', $username) == 1)
                    $formErrors[] = 'Sorry, This User Is Exist';
                else
                {
                    $stmt = $conn->prepare("INSERT INTO users(user_name, email, password, reg_status, reg_date) VALUES (:username, :email, :password, 0, now())");
                    $stmt->execute(array(
                                    'username' => $username,
                                    'email'    => $email,
                                    'password' => sha1($password)
                    ));
                
                    $succ = 'You Are Now Registerd User';
                }
            }
            
        } // End Signup

    endif;

?>

<section class="login-page">
    <div class="container">
        <div class="row">
            <h2 class="text-center h1">
                <span data-class="login" class="active">Login</span> | <span data-class="signup">Signup</span>
            </h2>
            <div>
                <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" name="login" value="login">
                    </div>
                </form>
            </div>
            <div>
                <form class="signup" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" name="password2" placeholder="Confirm Password" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success btn-block" name="signup" value="signup">
                    </div>
                </form>
            </div>
            <div class="the-errors">
                <?php
                    if(!empty($formErrors)) {
                        foreach($formErrors as $error) {
                            echo "<div class='alert alert-danger'>" . $error . "</div>";
                        }
                    }
                      
                    if(isset($succ)) {
                        echo "<div class='alert alert-success'>" . $succ . "</div>";
                    }
                ?>
            </div>
        </div>
    </div>
</section>

<?php include $tmbl . 'footer.php'; ?>