<?php

use Admin\Libs\Session;
use Admin\Libs\Payment;

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
                    Payment Details<small> </small>
                </h1>
            </div>
        </div>
        <!-- /. ROW  -->


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
                                        <th>Room type</th>
                                        <th>Bed Type</th>
                                        <th>Check in</th>
                                        <th>Check out</th>
                                        <th>No of Room</th>
                                        <th>Meal Type</th>

                                        <th>Room Rent</th>
                                        <th>Bed Rent</th>
                                        <th>Meals </th>
                                        <th>Gr.Total</th>
                                        <th>Print</th>

                                    </tr>
                                </thead>
                                <tbody>

                                
                                <?php
                                    $payment = new Payment();
                                    $paymentRecords = $payment->find_all();

                                    foreach ($paymentRecords as $row) {
                                        $id = $row->id;
                                        $class = ($id % 2 == 1) ? 'gradeC' : 'gradeU';

                                        echo "<tr class='{$class}'>
                                        <td>{$row->title} {$row->fname} {$row->lname}</td>
                                        <td>{$row->troom}</td>
                                        <td>{$row->tbed}</td>
                                        <td>{$row->cin}</td>
                                        <td>{$row->cout}</td>
                                        <td>{$row->nroom}</td>
                                        <td>{$row->meal}</td>
                                        <td>{$row->ttot}</td>
                                        <td>{$row->mepr}</td>
                                        <td>{$row->btot}</td>
                                        <td>{$row->fintot}</td>
                                        <td><a href='print.php?pid={$id}'><button class='btn btn-primary'><i class='fa fa-print'></i> Print</button></a></td>
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