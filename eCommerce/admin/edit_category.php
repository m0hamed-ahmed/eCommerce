<?php

    if (!$_SESSION['username']) {
        
        header("location: login.php");
        
    }

    $id = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

    $stmt = $conn->prepare("SELECT * FROM categories WHERE category_id = ?");
    $stmt->execute(array($id));
    $cat = $stmt->fetch();

    if($stmt->rowCount() > 0) {

?>

        
    <section class="edit">
        <h1 class="text-center">Edit Category</h1>
        <div class="container">
           <div  class="row">
               <form class="form-horizontal" method="post" action="categories.php?do=update">
               <input type="hidden" name="cat_id" value="<?php echo $cat['category_id'] ?>">
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Name</label>
                   <div class="col-sm-10">
                       <input type="text" class="form-control" name="name" value="<?php echo $cat['category_name'] ?>" >
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Description</label>
                   <div class="col-sm-10">
                       <input type="text" class="form-control" name="description" value="<?php echo $cat['description'] ?>">
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Ordering</label>
                   <div class="col-sm-10">
                       <input type="number" class="form-control" name="ordering" value="<?php echo $cat['ordering'] ?>">
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Parent ?</label>
                   <div class="col-sm-10">
                       <select name="parent" class="form-control">
                        <option value="0">None</option>
                        <?php
                            $cats = getAll("*", "categories", "where parent = 0", "", "category_id", "ASC");
                            foreach($cats as $c) {
                                echo "<option value='".$c['category_id']."'";
                                    if($c['category_id'] == $cat['parent']) {echo "selected='selected'";}
                                    echo">";
                                    echo $c['category_name'];
                                echo "</option>";
                            }  
                        ?>
                       </select>
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Visibility</label>
                   <div class="col-sm-10">
                       <div>
                           <input id="vis-yes" type="radio" name="visibility" value="0" <?php if($cat['visibility'] == 0 ) {echo 'checked'; } ?> >
                           <label for="vis-yes">Yes</label>
                       </div>
                       <div>
                           <input id="vis-no" type="radio" name="visibility" value="1" <?php if($cat['visibility'] == 1 ) {echo 'checked'; } ?> >
                           <label for="vis-no">No</label>
                       </div>
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Allow Comment</label>
                   <div class="col-sm-10">
                       <div>
                           <input id="com-yes" type="radio" name="comment" value="0" <?php if($cat['allow_comment'] == 0 ) {echo 'checked'; } ?> >
                           <label for="com-yes">Yes</label>
                       </div>
                       <div>
                           <input id="com-no" type="radio" name="comment" value="1" <?php if($cat['allow_comment'] == 1 ) {echo 'checked'; } ?> >
                           <label for="com-no">No</label>
                       </div>
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Allow Ads</label>
                   <div class="col-sm-10">
                       <div>
                           <input id="ads-yes" type="radio" name="ads" value="0" <?php if($cat['allow_ads'] == 0 ) {echo 'checked'; } ?> >
                           <label for="ads-yes">Yes</label>
                       </div>
                       <div>
                           <input id="ads-no" type="radio" name="ads" value="1" <?php if($cat['allow_ads'] == 1 ) {echo 'checked'; } ?> >
                           <label for="ads-no">No</label>
                       </div>
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