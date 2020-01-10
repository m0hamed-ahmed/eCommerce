<?php
    session_start();
    $nonavbar = '';
    $pageTitle = 'Login';

    if (isset($_SESSION['username'])) {
        header("location: dashboard.php");
    }
    include 'init.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'):

        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashPass = sha1($password); 
    
        $stmt = $conn->prepare("SELECT user_id, user_name, password FROM users WHERE user_name = ? AND password = ? And group_id = 1");
        $stmt->execute(array($username, $hashPass));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
            
        if($count > 0 )
        {
            $_SESSION['username'] = $username;   
            $_SESSION['userid']   = $row['user_id'];
            header("location: dashboard.php");
            exit();
        }

    endif;

?>

<section class="login">
    <div class="box-login">
        <h4>Login</h4>
        <form method="post">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="new-password">
            </div>
            <div form-group>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
            <a href="#">Create A New Account</a>
        </form>
    </div>
</section>

<?php include $tmbl . 'footer.php' ?>