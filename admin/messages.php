<?php


use Admin\Libs\Contact;

include "inc/header.php";

?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    News letters<small> panel</small>
                </h1>
            </div>
        </div>
        <!-- /. ROW  -->
        <?php

        $contact = new Contact();

        $contact_data = $contact->find_all();

        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h3>Send The News Letters to Followers</h3>
                    <?php
                    foreach ($contact_data as $rows) {
                        $app = $rows['approval'];
                        if ($app == "Allowed") {
                        }
                    }
                    ?>
                    <p></p>
                    <p>
                    <div class="panel-body">
                        <button class="btn btn-primary btn" data-toggle="modal" data-target="#myModal">
                            Send New News Letters
                        </button>
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Compose News Letter</h4>
                                    </div>
                                    <form method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input name="title" class="form-control" placeholder="Enter Title">
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Subject</label>
                                                <input name="subject" class="form-control" placeholder="Enter Subject">
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="comment">News</label>
                                                <textarea name="news" class="form-control" rows="5" id="comment"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                            <input type="submit" name="log" value="Send" class="btn btn-primary">
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($_POST['log'])) {
                    $log = "INSERT INTO `newsletterlog`(`title`, `subject`, `news`) VALUES ('$_POST[title]','$_POST[subject]','$_POST[news]')";
                    if (mysqli_query($con, $log)) {
                        echo '<script>alert("New Room Added") </script>';
                    }
                }


                ?>

                </p>

            </div>
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
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Approval</th>
                                    <th>Remove</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $contact = new Contact();
                                $contact_data =  $contact->find_all();

                                foreach ($contact_data as $row) {

                                    $id = $row->getId(); // Assuming you have a getId() method in the Contact class
                                    $class = ($id % 2 == 1) ? "gradeC" : "gradeU";

                                    echo "<tr class='{$class}'>
                                            <td>" . $row->getFullName() . "</td>
                                            <td>" . $row->getPhoneNo() . "</td>
                                            <td>" . $row->getEmail() . "</td>
                                            <td>" . $row->getCDate() . "</td>
                                            <td>" . $row->getApproval() . "</td>
                                            <td><a href='newsletter.php?eid=" . $id . "' class='btn btn-primary'><i class='fa fa-edit'></i> Permission</a></td>
                                            <td><a href='newsletterdel.php?eid=" . $id . "' class='btn btn-danger'><i class='fa fa-edit'></i> Delete</a></td>
                                        </tr>";
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
    </div>
    <!-- /. ROW  -->

</div>

</div>


</div>
<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<!-- /. WRAPPER  -->
<!-- JS Scripts-->
<!-- jQuery Js -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- Bootstrap Js -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- Metis Menu Js -->
<script src="assets/js/jquery.metisMenu.js"></script>
<!-- DATA TABLE SCRIPTS -->
<script src="assets/js/dataTables/jquery.dataTables.js"></script>
<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
</script>
<!-- Custom Js -->
<script src="assets/js/custom-scripts.js"></script>


</body>

</html>