<?php

    if (!$_SESSION['username']) {
        
        header("location: login.php");
        
    }

    $id = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

    $stmt = $conn->prepare("SELECT * FROM items WHERE item_id = ?");
    $stmt->execute(array($id));
    $item = $stmt->fetch();

    if($stmt->rowCount() > 0) {

?>

        
    <section class="edit">
        <h1 class="text-center">Edit Item</h1>
        <div class="container">
           <div  class="row">
               <form class="form-horizontal" method="post" action="items.php?do=update">
                    <input type="hidden" name="item_hidden" value="<?php echo $item['item_id'] ?>">
                    <div class="form-group form-group-lg">
                       <label class="col-sm-2 control-label">Name</label>
                       <div class="col-sm-10">
                           <input type="text" class="form-control" name="name" autocomplete="off" value="<?php echo $item['item_name'] ?>">
                       </div>
                   </div>
                   <div class="form-group form-group-lg">
                       <label class="col-sm-2 control-label">Description</label>
                       <div class="col-sm-10">
                           <input type="text" class="form-control" name="description" autocomplete="off" value="<?php echo $item['description'] ?>">
                       </div>
                   </div>
                   <div class="form-group form-group-lg">
                       <label class="col-sm-2 control-label">Price</label>
                       <div class="col-sm-10">
                           <input type="text" class="form-control" name="price" autocomplete="off" value="<?php echo $item['price'] ?>">
                       </div>
                   </div>
                   <div class="form-group form-group-lg">
                       <label class="col-sm-2 control-label">Country Made</label>
                       <div class="col-sm-10">
                           <input type="text" class="form-control" name="country_made" autocomplete="off" value="<?php echo $item['country_made'] ?>">
                       </div>
                   </div>
                   <div class="form-group form-group-lg">
                       <label class="col-sm-2 control-label">Status</label>
                       <div class="col-sm-10">
                           <select name="status" class="form-control">
                            <option value="1" <?php if($item['status'] == 1) {echo "selected='selected'";} ?>>New</option>
                            <option value="2" <?php if($item['status'] == 2) {echo "selected='selected'";} ?> >Like New</option>
                            <option value="3" <?php if($item['status'] == 3) {echo "selected='selected'";} ?>>Used</option>
                            <option value="4" <?php if($item['status'] == 4) {echo "selected='selected'";} ?>>Very Old</option>
                           </select>
                       </div>
                   </div>
                   <div class="form-group form-group-lg">
                       <label class="col-sm-2 control-label">Members</label>
                       <div class="col-sm-10">
                           <select name="members" class="form-control">
                               <?php
                                $stmt = $conn->prepare("SELECT * FROM users");
                                $stmt->execute();
                                $users = $stmt->fetchAll();
                                foreach($users as $user) {
                                    echo "<option value='".$user['user_id']."'";
                                    if($item['member_id'] == $user['user_id']){echo "selected='selected'";}
                                    echo ">";
                                    echo $user['user_name'];
                                    echo "</option>";
                                }
                               ?>
                           </select>
                       </div>
                   </div>
                   <div class="form-group form-group-lg">
                       <label class="col-sm-2 control-label">Category</label>
                       <div class="col-sm-10">
                           <select name="category" class="form-control">
                               <?php
                                $stmt = $conn->prepare("SELECT * FROM categories");
                                $stmt->execute();
                                $cats = $stmt->fetchAll();
                                foreach($cats as $cat) {                                    
                                    echo "<option value='".$cat['category_id']."'";
                                    if($item['category_id'] == $cat['category_id']){echo "selected='selected'";}
                                    echo ">";
                                    echo $cat['category_name'];
                                    echo "</option>";
                                }
                               ?>
                           </select>
                       </div>
                   </div>
                   <div class="form-group form-group-lg">
                       <div class="col-sm-10 col-sm-offset-2">
                           <input type="submit" class="form-control btn btn-primary" value="Save">
                       </div>
                   </div>                   
               </form>
           </div> 
        </div>
    </section>
        
<?php 
    
      } else { 
        
        $msg =  "<div class='alert alert-danger'>This Id Not Exists</div>";
        
        redirectHome ($msg, 'index.php', 1);    
        
        }
?>