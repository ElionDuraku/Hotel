<?php

use Admin\Libs\Users;
use Admin\Libs\Session;

include "inc/header.php";

$session = new Session();
if ($session->isSignedIn()) {
    header("Location: admin/index.php");
}
?>

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    Edit User
                </h1>
            </div>
        </div>


        <?php
        $user = new Users();
        if (isset($_GET['userid'])) {
            $user = $user->find_id(($_GET['userid']));
        }
        if (isset($_POST['update_user'])) {
            $user->setUsname($_POST['usname']);
            $user->setPass($_POST['pass']);
            $user->setRole($_POST['role']);
            if ($user->update()) {
                $session->message("User modified succesfully");
                header("Location: admin/usersetting.php");
            }
        }

        ?>
        <div class="col-lg-9">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <form id="editForm" method="post" action="usersetting.php">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-2">Update User</h3>
                    </div>

                    <div class="card-body">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Change User name</label>
                                <input name="usname" value="<?php if (!empty($user->getUsname())) {
                                                                echo $user->getUsname();
                                                            } ?>" id="editUsname" type="text" class="form-control" placeholder="Enter User name">
                            </div>
                            <div class="form-group">
                                <label>Change Password</label>
                                <input name="pass" id="editPass" value="<?php if (!empty($user->getPass())) {
                                                                            echo $user->getPass();
                                                                        } ?>" type="text" class="form-control" placeholder="Enter Password">
                            </div>
                            <div class="form-group">
                                <label class="form-control" for="role">Role :</label>
                                <select class="" name="role" id="editRole">
                                    <option value="admin">Administrator</option>
                                    <option value="worker">Worker</option>
                                </select>
                            </div>
                        </div>
                        <input class="btn btn-primary" id="login" value="Update User" type="submit" name="update_user" />
                    </div>
                </form>
                <div class="card-footer text-center">
                    <div class="small">
                        <a href="register.html">
                            Have an account? Go to login</a>
                    </div>
                </div>
            </div>
        </div>













        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<!-- JS Scripts-->
<!-- jQuery Js -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- Bootstrap Js -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- Metis Menu Js -->
<script src="assets/js/jquery.metisMenu.js"></script>
<!-- Custom Js -->
<script src="assets/js/custom-scripts.js"></script>

<!-- Remove this duplicate script -->
<script>
    $('#myModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var userId = button.data('userid');
        var usname = button.data('username');
        var pass = button.data('pass');
        var role = button.data('role');
        var modal = $(this);
        modal.find('#editUsname').val(usname);
        modal.find('#editPass').val(pass);
        modal.find('#editRole').val(role);
    });
</script>


</body>

</html>