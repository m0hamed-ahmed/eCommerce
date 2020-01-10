<?php
    if (!$_SESSION['username'])
        header("location: login.php");
?>   
<section class="edit">
    <h1 class="text-center">Add Category</h1>
    <div class="container">
       <div  class="row">
           <form class="form-horizontal" method="post" action="categories.php?do=insert">
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Name</label>
                   <div class="col-sm-10">
                       <input type="text" class="form-control" name="name" placeholder="Name of Category" autocomplete="off" required="required">
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Description</label>
                   <div class="col-sm-10">
                       <input type="text" class="form-control" name="description" placeholder="Description">
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Ordering</label>
                   <div class="col-sm-10">
                       <input type="number" class="form-control" name="ordering" placeholder="Ordering" autocomplete="off">
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Parent ?</label>
                   <div class="col-sm-10">
                       <select name="parent" class="form-control">
                        <option value="0">None</option>
                        <?php
                            $cats = getAll("*", "categories", "where parent = 0", "", "category_id", "ASC");
                            foreach($cats as $cat) {
                                echo "<option value='".$cat['category_id']."'>";
                                    echo $cat['category_name'];
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
                           <input id="vis-yes" type="radio" name="visibility" value="0" checked="checked">
                           <label for="vis-yes">Yes</label>
                       </div>
                       <div>
                           <input id="vis-no" type="radio" name="visibility" value="1">
                           <label for="vis-no">No</label>
                       </div>
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Allow Comment</label>
                   <div class="col-sm-10">
                       <div>
                           <input id="com-yes" type="radio" name="comment" value="0" checked="checked">
                           <label for="com-yes">Yes</label>
                       </div>
                       <div>
                           <input id="com-no" type="radio" name="comment" value="1">
                           <label for="com-no">No</label>
                       </div>
                   </div>
               </div>
               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Allow Ads</label>
                   <div class="col-sm-10">
                       <div>
                           <input id="ads-yes" type="radio" name="ads" value="0" checked="checked">
                           <label for="ads-yes">Yes</label>
                       </div>
                       <div>
                           <input id="ads-no" type="radio" name="ads" value="1">
                           <label for="ads-no">No</label>
                       </div>
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