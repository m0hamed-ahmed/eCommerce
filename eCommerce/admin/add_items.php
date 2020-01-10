<?php
    if (!$_SESSION['username'])
        header("location: login.php");

    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll();

    $stmt = $conn->prepare("SELECT * FROM categories");
    $stmt->execute();
    $cats = $stmt->fetchAll();
?>      
<section class="edit">
    <h1 class="text-center">Add Item</h1>
    <div class="container">
       <div  class="row">
           <form class="form-horizontal" method="post" action="items.php?do=insert">
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Name</label>
                   <div class="col-sm-10">
                       <input type="text" class="form-control" name="name" placeholder="Name" autocomplete="off" required="required">
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Description</label>
                   <div class="col-sm-10">
                       <input type="text" class="form-control" name="description" placeholder="Description" autocomplete="off" required="required">
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Price</label>
                   <div class="col-sm-10">
                       <input type="text" class="form-control" name="price" placeholder="Price" autocomplete="off" required="required">
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Country Made</label>
                   <div class="col-sm-10">
                       <input type="text" class="form-control" name="country_made" placeholder="Country Made" autocomplete="off" required="required">
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Status</label>
                   <div class="col-sm-10">
                       <select name="status" class="form-control">
                        <option value="0">...</option>
                        <option value="1">New</option>
                        <option value="2">Like New</option>
                        <option value="3">Used</option>
                        <option value="4">Very Old</option>
                       </select>
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Members</label>
                   <div class="col-sm-10">
                       <select name="members" class="form-control">
                        <option value="0">...</option>
                           <?php
                                foreach($users as $user)
                                    echo "<option value='".$user['user_id']."'>" . $user['user_name']  . "</option>";
                           ?>
                       </select>
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Category</label>
                   <div class="col-sm-10">
                       <select name="category" class="form-control">
                        <option value="0">...</option>
                           <?php
                            foreach($cats as $cat)
                                echo "<option value='".$cat['category_id']."'>" . $cat['category_name']  . "</option>";
                           ?>
                       </select>
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