<?php

require('backend_header.php');
require('db_connect.php');

?>


            <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Sub-Category </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="subcategory_new.php" class="btn btn-outline-primary">
                        <i class="icofont-plus"></i>
                    </a>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                        <tr>
                                          <th>#</th>
                                          <th>Name</th>
                                          <th>Category</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                            <?php

                                            $sql = "SELECT categories.name AS cname,
                                                     subcategories.name AS sname,
                                                     subcategories.id AS sid 
                                                     FROM categories 
                                                     JOIN subcategories 
                                                     ON categories.id = subcategories.category_id";
                                            $stmt = $conn->prepare($sql);

                                            $stmt->execute();

                                            $categories = $stmt->fetchAll();

                                            // var_dump($rows);
                                            $i =1;
                                            foreach ($categories as $category) {
                                                $id = $category['sid'];
                                                $categoryname = $category['cname'];
                                                $subcategoryname = $category['sname'];

                                        ?>

                                        <tr>
                                            <td> <?php echo $i++ ?>. </td>
                                            <td> <?php echo $subcategoryname ?> </td>
                                            <td> <?php echo $categoryname ?> </td>
                                            <td>
                                                <a href="subcategory_edit.php?sid=<?= $id ?>" class="btn btn-warning">
                                                    <i class="icofont-ui-settings"></i>
                                                </a>

                                                <form class="d-inline-block" onsubmit="return confirm('Are you sure want to delete?')" method="POST" action="subcategory_delete.php">

                                                    <input type="hidden" name="id" value="<?= $id ?>">

                                                    <button class="btn btn-outline-danger">
                                                        <i class="icofont-close"></i>
                                                    </button>

                                                </form>
                                            </td>

                                        </tr>

                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<?php

require('backend_footer.php');

?>