<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/projectpgd/core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
if (isset($_GET['add'])) {
$parentQuery = $db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY category");
if ($_POST) {
    $title = sanitize($_POST['title']);
    $categories = sanitize($_POST['child']);
    $price = sanitize($_POST['price']);
    $list_price = sanitize($_POST['list_price']);
    $sizes = sanitize($_POST['sizes']);
    $description = sanitize($_POST['description']);
    $errors = array();
    if (!empty($_POST['sizes'])) {
        $sizeString = sanitize($_POST['sizes']);
        $sizeString = rtrim($sizeString,',');echo $sizeString;
        $sizeArray = explode(',',$sizeString);
        $sArray = array();
        $qArray = array();
        foreach($sizeArray as $ss){
            $s = explode(':', $ss);
            $sArray[] = $s[0];
            $qArray[] = $s[1];
        }
    } else {$sizeArray = array();}
    $required = array('title','price','parent','child','sizes');
    foreach($required as $field){
        if($_POST[$field] == ''){
            $errors[]= 'All Fields With Asterix are required.';
            break;
        }
    }
    if (!empty($_FILES)){
        var_dump($_FILES);
        $photo = $_FILES['photo'];
        $name = $photo['name'];
        $nameArray = explode('.',$name);
        $fileName = $nameArray[0];
        $fileExt = $nameArray[1];
        $mime = explode('/',$photo['type']);
        $mimeType = $mime[0];
        $mimeExt = $mime[1];
        $tmpLoc = $photo['tmp_name'];
        $fileSize = $photo['size'];
        $allowed = array('png','jpg','jpeg','gif');
        $uploadPath = BASEURL.'/projectpgd/images'.$uploadName;
        $uploadName = md5(microtime).'.'.$fileExt;
        $dbpath = '/projectpgd/images'.$uploadName;
        if ($mimeType != 'image') {
            $errors[] = 'The file must be an image.';
        }
        if (!in_array($fileExt, $allowed)) {
            $errors[] = 'The file extension must be a png, jpg, jpeg,or gif.';
        }
        if ($fileSize > 15000000) {
            $errors[] = 'The files size must be under 15MB.';
        }
    }
    if(!empty($errors)){
        echo display_errors($errors);
    }else{
        //upload file and insert into database
        move_upload_file($tmploc,$uploadPath);
        $insertSql = "INSERT INTO services (`title`,`price`,`list_price`,`categories`,`sizes`,) VALUES ()";
    }
}
?>
    <h2 class="text-center">Add A New Service</h2><hr>
    <form action="services.php?add=1" method="POST" enctype="multipart/form-data">
        <div class="form-group col-md-3">
            <label for="title">Title*:</label>
            <input type="text" name="title" id="title" class="form-control" value="<?=(isset($_POST['title'])?   sanitize($_POST['title']): '');?>">
        </div>
        <div class="form-group col-md-3">
            <label for="parent">Parent Category*:</label>
            <select class="form-control" name="parent" id="parent">
                <option value=""<?=((isset($_POST['parent']) && $_POST['parent'] == '')? 'selected' : '');?>></option>
                <?php while($parent = mysqli_fetch_assoc($parentQuery)): ?>
                    <option value="<?=$parent['id'];?>"<?=(isset($_POST['parent']) && ($_POST['parent'] == $parent['id'])?'select': '');?>><?=$parent['category'];?></option>
                <?php endwhile; ?>   
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="child">Child Category*:</label>
            <select class="form-control" name="child" id="child"></select>
        </div>
        <div class="form-group col-md-3">
            <label for="price">Price*:</label>
            <input type="text" name="price" id="price" class="form-control" value="<?=((isset($_POST['price']))? sanitize($_POST['price']): '');?>">
        </div>
        <div class="form-group col-md-3">
            <label for="price">List Price:</label>
            <input type="text" name="list_price" id="list_price" class="form-control" value="<?=((isset($_POST['list_price']))?sanitize($_POST['list_price']): '');?>">
        </div>
        <div class="form-group col-md-3">
            <label>Quantitiy & Sizes*:</label>
            <button class="btn btn-default form-control" onclick="jQuery('#sizesModal').modal('toggle');return false;">Quantity & Sizes</button>
        </div>
        <div class="form-group col-md-3">
            <label for="sizes">Sizes & Qty Preview:</label>
            <input type="text" name="sizes" id="sizes" class="form-control" value="<?=((isset($_POST['sizes']))?$_POST['sizes']:'');?>" readonly>
        </div>
        <div class="form-group col-md-6">
            <label for="photo">Services Photo:</label>
            <input type="file" name="photo" id="photo" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="6"><?=((isset($_POST['description']))?sanitize($_POST['description']): '');?></textarea>
        </div>
        <div class="form-group pull-right">
            <input type="submit" value="Add Services" class="form-control btn btn-success pull-right">
        </div><div class="clearfix"></div>
    </form>
    <!-- Modal -->
    <div class="modal fade" id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="sizesModalLabel">Size & Quantity</h4>
        </div>
        <div class="modal-body">
                <div class="container-fluid">
                    <?php for($i=1; $i <=12; $i++ ): ?>
                        <div class="form-group col-md-4">
                            <label for="size<?=$i;?>">Size:</label>
                            <input type="text" name="size<?=$i;?>" id="size<?=$i;?>" value="<?=((!empty($sArray[$i-1]))?$sArray[$i-1] : '');?>" class="form-control">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="qty<?=$i;?>">Quantity:</label>
                            <input type="number" name="qty<?=$i;?>" id="qty<?=$i;?>" value="<?=((!empty($qArray[$i-1]))?$qArray[$i-1] : '');?>" min="0" class="form-control">
                        </div>
                    <?php endfor; ?>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="updateSizes();jQuery('#sizesModal').modal('toggle');return false">Save changes</button>
        </div>
        </div>
    </div>
    </div>
    <?php } else {
    $sql = "SELECT * FROM services WHERE deleted = 0";
    $sresults = $db->query($sql);
    if (isset($_GET['featured'])){
        $id = (int)$_GET['id'];
        $featured = (int)$_GET['featured'];
        $servicesSql = "UPDATE services SET featured = '$featured' WHERE id = '$id'";
        $db->query($servicesSql);
        header('Location: services.php');
    }
    ?>
    <h2 class="text-center">Services</h2>
        <a href="services.php?add=1" class="btn btn-success pull-right" id="add-services-btn">Add Services</a>
        <div class="clearfix"></div>
        <style>
            #add-services-btn{
                margin-top:-35px;
            }
        </style>
    <hr>

    <table class="table table-bordered table-condensed table-striped">
        <thead><th></th><th>Services</th><th>Price</th><th>Category</th><th>Featured</th><th>Sold</th></thead>
        <tbody>
        <?php while($services = mysqli_fetch_assoc($sresults)): 
                $childID = $services['categories'];
                $catSql = "SELECT * FROM categories WHERE id = '$childID'";
                $result = $db->query($catSql);
                $child = mysqli_fetch_assoc($result);
                $parentID = $child['parent'];
                $pSql = "SELECT * FROM categories WHERE id = '$parentID'";
                $presult = $db->query($pSql);
                $parent = mysqli_fetch_assoc($presult);
                $category = $parent['category'].'~'.$child['category'];
            
            ?>
            <tr>
                <td>
                <a href="services.php?edit=<?=$services['id']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a> 
                <a href="services.php?delete=<?=$services['id']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a> 

                </td>
                <td><?=$services['title'];?></td>
                <td><?=money($services['price']);?></td>
                <td><?=$category;?></td>
                <td><a href="services.php?featured=<?=(($services['featured'] == 0)? '1': '0');?>&id=<?=$services['id'];?>" class="btn btn-xs btn-default">
                    <span class="glyphicon glyphicon-<?=(($services['featured' ] == 1)? 'minus':'plus');?>"></span>
                    </a>&nbsp <?=(($services['featured'] ==1)?'Featured Services': '');?></td>
                <td>0</td>
            </tr> 
        <?php endwhile; ?>
        </tbody>
    </table>
    <?php } include 'includes/footer.php';?>
