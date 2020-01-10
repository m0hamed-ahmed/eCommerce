<?php
    if (!$_SESSION['username'])
        header("location: login.php");
?>
<section class="edit">
    <h1 class="text-center">Add Member</h1>
    <div class="container">
       <div  class="row">
           <form class="form-horizontal" method="post" action="members.php?do=insert">
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Username</label>
                   <div class="col-sm-10">
                       <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" required="required">
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Password</label>
                   <div class="col-sm-10">
                       <input type="password" class="password form-control" name="password" placeholder="Password" autocomplete="new-password" required="required">
                       <i class="fa fa-eye"></i>
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Email</label>
                   <div class="col-sm-10">
                       <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off" required="required">
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Full Name</label>
                   <div class="col-sm-10">
                       <input type="text" class="form-control" name="fullname" placeholder="Full Name" autocomplete="off" required="required">
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <div class="col-sm-10 col-sm-offset-2">
                       <input type="submit" class="form-control btn btn-primary" value="Add">
                   </div>
               </div>
           </form>
       </div> 
    </div>
</section>