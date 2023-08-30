<?php

use Admin\Libs\AccessControl;
use Admin\Libs\Users;

include "inc/header.php";


$allowedRoles = ['admin', 'manager'];

AccessControl::checkAccess($allowedRoles);

?>


<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    ADMINISTRATOR<small> accounts </small>
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
                                        <th>User ID</th>
                                        <th>User name</th>
                                        <th>Password</th>
                                        <th>Role</th>
                                        <th>Update</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $user = new Users();



                                    foreach ($user->find_all() as $u) {

                                        $id = $u->getId();
                                        $us = $u->getUsname();
                                        $role = $u->getRole();
                                        $cssClass = ($id % 2 == 0) ? 'gradeC' : 'gradeU';

                                        echo "<tr class='$cssClass'>";
                                        echo "<td>" . $u->getId() . "</td>";
                                        echo "<td>" . $u->getUsname() . "</td>";
                                        echo "<td>" . $u->getPass() . "</td>";
                                        echo "<td>" . $u->getRole() . "</td>";
                                        echo "<td><a href='#' class='edit-btn' data-toggle='modal' data-target='#myModal' data-userid='$id' data-username='$us' data-pass='" . htmlentities($u->getPass()) . "' data-role='$role'>Edit</a></td>";
                                        echo "<td>";
                                        echo "<button class='btn btn-danger delete-btn' data-toggle='modal' data-target='#myModal2' data-userid='$id' data-username='$us'>Delete</button>";


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
                $user = new Users();
                // Check if the form for deleting the user is submitted
                if (isset($_POST['confirm_delete_user'])) {
                    $user_id = $_POST['user_id'];
                    $username = $_POST['username'];


                    $user = new Users();
                    $user->find_id($user_id);
                    $user->delete();


                    $session->message("User $username with ID $user_id deleted successfully");
                    header("Location: usersetting.php");
                }




                ?>

                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Delete User</h4>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this user?</p>
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
                        Add New Admin
                    </button>
                    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Add the User name and Password</h4>
                                </div>
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Add new User name</label>
                                            <input name="usname" class="form-control" placeholder="Enter User name">
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input name="pass" class="form-control" placeholder="Enter Password">
                                        </div>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="form-control" for="role">Role :</label>
                                            <select class="" name="role" id="role">
                                                <option value="admin">Administrator</option>
                                                <option value="worker">Worker</option>
                                            </select>
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
            if (isset($_POST['add_user'])) {
                $user = new Users();
                $user->setUsname($_POST['usname']);
                $user->setPass($_POST['pass']);
                $user->setRole($_POST['role']);

                if ($user->create()) {
                    $session->message("User added successfully");
                    header("Location: usersetting.php");
                } else {
                    $session->message("User create failed");
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
// Check if the form for updating the user is submitted
if (isset($_POST['update'])) {
    $user_id = $_POST['user_id']; // Assuming you can get the user ID from the form field

    $user = new Users();
    $user->find_id($user_id);

    $user->setUsname($_POST['usname']);
    $user->setPass($_POST['pass']);
    $user->setRole($_POST['role']);

    if ($user->update()) {
        $session->message("User updated successfully");
        header("Location: usersetting.php");
        exit(); // Make sure to include this line to stop further script execution
    } else {
        $session->message("User update failed");
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