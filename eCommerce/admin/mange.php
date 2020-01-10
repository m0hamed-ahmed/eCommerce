<?php

    if (!$_SESSION['username']) {
        
        header("location: login.php");
        
    }

    $page = '';

    if(isset($_GET['page']) && $_GET['page'] == 'pending') {

        $page = 'AND reg_status = 0';

    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE group_id != 1 $page ");
    $stmt->execute();
    $users = $stmt->fetchAll();

?>
<div class="container">
    <div class="row">
        <?php if(!empty($users)) { ?>
        <h1 class="text-center">Mange Members</h1>  
        <div class="table-responsive">
            <table class="table table-bordered text-center mange-table">
                <tr>
                    <td>#ID</td>
                    <td>Username</td>
                    <td>Email</td>
                    <td>Full Name</td>
                    <td>Registerd Date</td>
                    <td>Control</td>
                </tr>
                <?php
    
                    foreach($users as $user) {
                ?>
                <tr>
                    <td><?php echo $user['user_id'] ?></td>
                    <td><?php echo $user['user_name'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td><?php echo $user['full_name'] ?></td>
                    <td><?php echo $user['reg_date'] ?></td>
                    <td>
                        <a href="?do=edit&userid=<?php echo $user['user_id'] ?>" class="btn btn-success"><i class="fa fa-edit"></i>Edit</a>
                        <a href="?do=delete&userid=<?php echo $user['user_id'] ?>" class="btn btn-danger confirm"><i class="fa fa-close"></i>Delete</a>
                        <?php
                            if($user['reg_status'] == 0) {
                        ?>
                        <a href="?do=activate&userid=<?php echo $user['user_id'] ?>" class="btn btn-info">Activate</a>
                        <?php } ?>
                    </td>
                </tr>
                
                <?php } ?>
            </table>
        </div>
        <a href='?do=add' class='btn btn-primary'><i class='fa fa-plus'></i> Add New Member</a>
        <?php } else {
                    echo "<div class='tbl-empty'>Empty</div>";
                    echo "<a href='?do=add' class='btn btn-primary'><i class='fa fa-plus'></i> Add New Member</a>";
                } 
        ?>
    </div>
</div>