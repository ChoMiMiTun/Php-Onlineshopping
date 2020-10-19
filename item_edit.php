<?php

require('backend_header.php');
require('db_connect.php');

// get id from address bar
$id = $_GET['iid'];

// draw out the query from db
$sql = "SELECT * FROM items WHERE id = :value1";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':value1', $id);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

$iid = $row['id'];
$iname = $row['name'];
$iprice = $row['price'];
$idescription = $row['description'];
$ibrand_id = $row['brand_id'];
$iscategory_id = $row['subcategory_id'];

?>


    <div class="app-title">
        <div>
            <h1> <i class="icofont-list"></i> Item Form </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <a href="item_list.php" class="btn btn-outline-primary">
                <i class="icofont-double-left"></i>
            </a>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form action="item_update.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="oldphoto" value="<?= $row['photo'] ?>">
                        
<!--                         <div class="form-group row">
                            <label for="profile" class="col-sm-2 col-form-label"> Profile </label>
                            <div class="col-sm-10">
                              <input type="file" id="profile" name="photo">
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <label for="photo_id" class="col-sm-2 col-form-label"> Profile </label>
                            <div class="col-sm-10">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Old Photo</a>
                                        <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">New Photo </a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <img src="<?= $row['photo'] ?>" class="img-fluid my-3" width="120px">
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        
                                        <input type="file" id="photo_id" name="newphoto" class="my-3">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label"> Name </label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name'] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                        <div class="col-md-2">
                            <label for="uniqueprice" class="col-form-label"> Price </label>
                        </div>
                        <div class="col-md-10">

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="uniqueprice-tab" data-toggle="tab" href="#uniqueprice" role="tab" aria-controls="uniqueprice"> Unique Price </a>
                                </li>
      
                                <li class="nav-item">
                                    <a class="nav-link" id="discount-tab" data-toggle="tab" href="#discount" role="tab"> Discount </a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="uniqueprice" role="tabpanel" aria-labelledby="uniqueprice-tab">
                                    <input type="text" class="form-control my-3" name="uniqueprice"value="<?php echo $row['price'] ?>">
                                </div>
                            
                                <div class="tab-pane fade" id="discount" role="tabpanel">
                                    <input type="text"  id="discount" name="discount" class="form-control my-4" value="<?php echo $row['discount'] ?>">
                                </div>
                            </div>  
                            
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label"> Description </label>
                        <div class="col-sm-10">
                          <!-- <input type="text" class="form-control" id="description" name="description"> -->
                          <textarea rows="4" class="form-control" id="description" name="description">
                              <?php echo $row['description'] ?>
                          </textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="brand" class="col-sm-2 col-form-label"> Brand </label>
                        <div class="col-sm-10">
                          <select class="form-control" id="brand" name="brand">
                              <option>Choose Brand</option>

                                <?php

                                    $sql = "SELECT * FROM brand";
                                    $stmt = $conn->prepare($sql);

                                    $stmt->execute();

                                    $brands = $stmt->fetchAll();

                                    // var_dump($rows);
                                    foreach ($brands as $brand) {

                                        $id = $brand['id'];
                                        $name = $brand['name'];
                                        
                                        ?>

                                        <option <?php if($id == $ibrand_id) echo "selected" ?> value="<?php echo $id ?>">
                                        <?php echo $name ?>
                                            
                                        </option>
                                    
                                <?php } ?>

                          </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="subcategory" class="col-sm-2 col-form-label"> Subcategory </label>
                        <div class="col-sm-10">
                          <select class="form-control" id="subcategory" name="subcategory">
                              <option>Choose Subcategory</option>

                              <?php
                                
                                    $sql = "SELECT * FROM subcategories";
                                    $stmt = $conn->prepare($sql);

                                    $stmt->execute();

                                    $subcategories = $stmt->fetchAll();

                                    // var_dump($rows);
                                    foreach ($subcategories as $subcategory) {

                                        $id = $subcategory['id'];
                                        $name = $subcategory['name'];
                                        
                                        ?>

                                        <option <?php if($id == $iscategory_id) echo "selected" ?> value="<?php echo $id ?>">
                                        <?php echo $name ?>
                                            
                                        </option>
                                    
                                <?php } ?>

                          </select>
                        </div>
                    </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">
                                    <i class="icofont-save"></i>
                                    Save
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


<?php

require('backend_footer.php');

?>