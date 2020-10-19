<?php

require('backend_header.php');
require('db_connect.php');

?>


            <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Item </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="item_new.php" class="btn btn-outline-primary">
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
                                          <th>Brand</th>
                                          <th>Price</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                            $sql = "SELECT brand.name AS bname,
                                                     items.name AS iname,
                                                     items.price AS iprice,
                                                     items.id AS iid,
                                                     items.description AS idescription
                                                     FROM brand 
                                                     JOIN items 
                                                     ON brand.id = items.brand_id";
                                            $stmt = $conn->prepare($sql);

                                            $stmt->execute();

                                            $brand = $stmt->fetchAll();


                                        //Start Fetch item table

                                        $sql = "SELECT * FROM items";
                                            $stmt = $conn->prepare($sql);

                                            $stmt->execute();

                                            $items = $stmt->fetchAll();

                                            $i = 1;
                                            foreach ($brand as $b) {
                                                // $id = $category['id'];
                                                $id = $b['iid'];
                                                $brandname = $b['bname'];
                                                $itemname = $b['iname'];
                                                $itemprice = $b['iprice'];

                                        ?>

                                        <tr>
                                            <td> <?php echo $i++ ?>. </td>
                                            <td> <?php echo $itemname ?> </td>
                                            <td> <?php echo $brandname ?> </td>
                                            <td> <?php echo $itemprice ?> </td>
                                            <td>
                                                <a href="item_edit.php?iid=<?= $id ?>" class="btn btn-warning">
                                                    <i class="icofont-ui-settings"></i>
                                                </a>

                                                <form class="d-inline-block" onsubmit="return confirm('Are you sure want to delete?')" method="POST" action="item_delete.php">

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