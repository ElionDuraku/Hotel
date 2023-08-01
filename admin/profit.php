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
                    Profit Details<small> </small>
                </h1>
            </div>
        </div>
        <!-- /. ROW  -->


        <div class="row">

            <?php
            $payment = new Payment();
            $chart_data = $payment->getPaymentChartData();
            ?>


            <br>
            <br>
            <br>
            <br>
            <div id="chart"></div>
            <div class="col-md-12">
                <!-- Advanced Tables -->

                <?php
                $payment = new Payment();
                $paymentRecords = $payment->find_all();
                ?>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Check in</th>
                                        <th>Check out</th>
                                        <th>Room Rent</th>
                                        <th>Bed Rent</th>
                                        <th>Meals</th>
                                        <th>Gr.Total</th>
                                        <th>Profit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($paymentRecords as $row) {
                                        $id = $row->id;
                                        $class = ($id % 2 == 1) ? 'gradeC' : 'gradeU';
                                        echo "<tr class='{$class}'>
                                        <td>{$row->id}</td>
                                        <td>{$row->title} {$row->fname} {$row->lname}</td>
                                        <td>{$row->cin}</td>
                                        <td>{$row->cout}</td>
                                        <td>\${$row->ttot}</td>
                                        <td>\${$row->mepr}</td>
                                        <td>\${$row->btot}</td>
                                        <td>\${$row->fintot}</td>
                                        <td>$<?php echo $row->fintot * 10 / 100; ?></td>
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
<script>
    Morris.Bar({
        element: 'chart',
        data: [<?php echo $chart_data; ?>],
        xkey: 'date',
        ykeys: ['profit'],
        labels: ['Profit'],
        hideHover: 'auto',
        stacked: true
    });
</script>