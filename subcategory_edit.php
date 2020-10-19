<?php

require('backend_header.php');
require('db_connect.php');

// get id from address bar
$id = $_GET['sid'];

// draw out the query from db
$sql = "SELECT * FROM subcategories WHERE id = :value1";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':value1', $id);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

$sid = $row['id'];
$sname = $row['name'];
$scategory_id = $row['category_id'];

?>


    <div class="app-title">
        <div>
            <h1> <i class="icofont-list"></i> Edit Subcategory Form </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <a href="subcategory_update.php" class="btn btn-outline-primary">
                <i class="icofont-double-left"></i>
            </a>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form action="subcategory_update.php" method="POST" enctype="multipart/form-data">

                    	<input type="hidden" name="id" value="<?= $row['id'] ?>">
                        
                        <div class="form-group row">
                            <label for="name_id" class="col-sm-2 col-form-label"> Name </label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="name_id" name="name"
                              value="<?php echo $row['name'] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-sm-2 col-form-label"> Category </label>
                            <div class="col-sm-10">
                              <select class="form-control" id="category" name="category">
                                  <option>Choose Category</option>

                                  <?php

                                $sql = "SELECT * FROM categories";
                                $stmt = $conn->prepare($sql);

                                $stmt->execute();

                                $categories = $stmt->fetchAll();

                                // var_dump($rows);
                                foreach ($categories as $category) {

                                    $id = $category['id'];
                                    $name = $category['name'];
                                    
                                    ?>

                                    <option <?php if($id == $scategory_id) echo "selected" ?> value="<?php echo $id ?>">
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