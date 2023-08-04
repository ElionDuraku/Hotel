<?php

use Admin\Libs\Inventory;
include "inc/header.php";

?>

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    Inventory<small> part </small>
                </h1>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Message</th>
                                        <th>Update</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $inventory = new Inventory();

                                    foreach ($inventory->find_all() as $item) {
                                        $id = $item->getId();
                                        $productName = $item->getProductName();
                                        $quantity = $item->getQuantity();
                                        $price = $item->getPrice();
                                        $message = $item->getMessage();
                                        $cssClass = ($id % 2 == 0) ? 'gradeC' : 'gradeU';

                                        echo "<tr class='$cssClass'>";
                                        echo "<td>" . $item->getId() . "</td>";
                                        echo "<td>" . $item->getProductName() . "</td>";
                                        echo "<td>" . $item->getQuantity() . "</td>";
                                        echo "<td>" . $item->getPrice() . "</td>";
                                        echo "<td>" . $item->getMessage() . "</td>";
                                        echo "<td><a href='#' class='edit-btn' data-toggle='modal' data-target='#myModal' data-itemid='$id' data-productname='$productName' data-quantity='$quantity' data-price='$price' data-message='$message'>Edit</a></td>";
                                        echo "<td>";
                                        echo "<button class='btn btn-danger delete-btn' data-toggle='modal' data-target='#myModal2' data-itemid='$id' data-productname='$productName'>Delete</button>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <?php
                $inventory = new Inventory();

                // Kontrollojmë nëse është dorëzuar forma për të konfirmuar fshirjen e artikullit
                if (isset($_POST['confirm_delete_item'])) {
                    $id = $_POST['id'];
                    $productName = $_POST['productName'];

                    // Për shembull, le të supozojmë që klasa Inventory ka një metodë për gjetjen dhe fshirjen e artikullit sipas ID-së
                    $item = new Inventory();
                    $item->find_id($item_id);
                    $item->delete();

                    // Opsionalisht, mund të shtoni një mesazh ose të kryeni veprime të tjera këtu
                    $session->message("Item $productName with ID $id deleted successfully");
                    header("Location: inventory.php");
                }

                ?>

                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Delete product</h4>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this product?</p>
                            </div>

                            <!-- Add a form to handle the delete operation -->
                            <form id="deleteForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <input type="hidden" name="delete_user" value="1">
                                <input type="hidden" name="user_id" id="deleteUserId" value="">
                                <input type="hidden" name="username" id="deleteUsername" value="">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <input name="confirm_delete_user" type="submit" value="Delete" class="btn btn-danger">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>







                <!--End Advanced Tables -->
                <div class="panel-body">
                    <button class="btn btn-primary btn" data-toggle="modal" data-target="#myModal1">
                        Add New Product
                    </button>
                    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Add New Product</h4>
                                </div>
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Add new Product name</label>
                                            <input name="usname" class="form-control" placeholder="Enter Product name">
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Add Product Quantity</label>
                                            <input name="pass" class="form-control" placeholder="Enter Quantity">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <input type="submit" name="add_user" value="Add" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                if (isset($_POST['add_item'])) {
                    $item = new Inventory();
                    $item->setProductName($_POST['productName']);
                    $item->setQuantity($_POST['quantity']);
                    $item->setPrice($_POST['price']);
                    $item->setMessage($_POST['message']);

                    if ($item->create()) {
                        $session->message("Item added successfully");
                        header("Location: inventory.php");
                    } else {
                        $session->message("Item create failed");
                    }
                }
            ?>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Change the User name and Password</h4>
                        </div>
                        <form id="editForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Change User name</label>
                                    <input name="usname" id="editUsname" type="text" class="form-control" placeholder="Enter User name">
                                </div>
                                <div class="form-group">
                                    <label>Change Password</label>
                                    <input name="pass" id="editPass" type="text" class="form-control" placeholder="Enter Password">
                                </div>
                                <div class="form-group">
                                    <label class="form-control" for="role">Role :</label>
                                    <select class="" name="role" id="editRole">
                                        <option value="admin">Administrator</option>
                                        <option value="worker">Worker</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <input type="hidden" name="user_id" id="editUserId" value="">
                                <input type="submit" name="update" value="Update" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

<!-- /. ROW  -->
            <?php
                // Kontrollojmë nëse është dorëzuar forma për përditësimin e artikullit
                if (isset($_POST['update'])) {
                    $id = $_POST['id']; // Supozojmë se mund të merrni ID e artikullit nga fusha e formës

                    $item = new Inventory();
                    $item->find_id($id);

                    $item->setProductName($_POST['productName']);
                    $item->setQuantity($_POST['quantity']);
                    $item->setPrice($_POST['price']);
                    $item->setMessage($_POST['message']);

                    if ($item->update()) {
                        $session->message("Item updated successfully");
                        header("Location: inventory.php");
                        exit(); // Sigurohuni të përfshini këtë rresht për të ndaluar ekzekutimin e mëtejshëm të skriptit
                    } else {
                        $session->message("Item update failed");
                    }
                }
            ?>


<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<!-- JS Scripts-->
<!-- jQuery Js -->
<!-- Include jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- Bootstrap Js -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- Metis Menu Js -->
<script src="assets/js/jquery.metisMenu.js"></script>
<!-- Custom Js -->
<script src="assets/js/custom-scripts.js"></script>

<!-- Remove this duplicate script -->


<script>
    $(document).on('click', '.edit-btn', function() {
        var userId = $(this).data('userid');
        var usname = $(this).data('username');
        var pass = $(this).data('pass');
        var role = $(this).data('role');
        $("#editForm #editUserId").val(userId);
        $("#editForm #editUsname").val(usname);
        $("#editForm #editPass").val(pass);
        $("#editForm #editRole").val(role);
    });

    $('#myModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var userId = button.data('userid');
        var username = button.data('username');
        var modal = $(this);
        modal.find('input[name="user_id"]').val(userId);
        modal.find('input[name="username"]').val(username);
    });
</script>

</body>

</html>