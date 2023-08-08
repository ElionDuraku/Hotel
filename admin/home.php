<?php

use Admin\Libs\Contact;
use Admin\Libs\Roombook;

include "inc/header.php";

?>


<div id="page-wrapper">
    <div id="page-inner">

        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    Status <small>Room Booking </small>
                </h1>
            </div>
        </div>
        <!-- /. ROW  -->

        <?php

        $roombook = new Roombook(); // Assuming you have a Roombook class for handling database interactions

        $c = 0;
        foreach ($roombook->find_all() as $row) {
            $new = $row->getStat();
            $cin = $row->getCin();
            $id = $row->getId();

            if ($cin) {
                $c = $c + 1;
            }
        }

        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">

                    </div>
                    <div class="panel-body">
                        <div class="panel-group" id="accordion">

                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            <button class="btn btn-default" type="button">
                                                New Room Bookings <span class="badge"><?php echo $c; ?></span>
                                            </button>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse in" style="height: auto;">
                                    <div class="panel-body">
                                        <div class="panel panel-default">

                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Name</th>
                                                                <th>Email</th>
                                                                <th>Country</th>
                                                                <th>Room</th>
                                                                <th>Bedding</th>
                                                                <th>Meal</th>
                                                                <th>Check In</th>
                                                                <th>Check Out</th>
                                                                <th>Status</th>
                                                                <th>More</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $roombook = new Roombook();

                                                            foreach ($roombook->find_all() as $trow) {
                                                                $check_in = $trow->getCin();

                                                                if (isset($check_in)) {
                                                                    echo "<tr>";
                                                                    echo "<td>" . $trow->getId() . "</td>";
                                                                    echo "<td>" . $trow->getFName() . " " . $trow->getLName() . "</td>";
                                                                    echo "<td>" . $trow->getEmail() . "</td>";
                                                                    echo "<td>" . $trow->getCountry() . "</td>";
                                                                    echo "<td>" . $trow->getTRoom() . "</td>";
                                                                    echo "<td>" . $trow->getBed() . "</td>";
                                                                    echo "<td>" . $trow->getMeal() . "</td>";
                                                                    echo "<td>" . $trow->getCin() . "</td>";
                                                                    echo "<td>" . $trow->getCout() . "</td>";
                                                                    echo "<td>" . $trow->getStat() . "</td>";
                                                                    echo "<td><a href='roombook.php?rid=" . $trow->getId() . "' class='btn btn-primary'>Action</a></td>";
                                                                    echo "</tr>";
                                                                }
                                                            }


                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End  Basic Table  -->
                                    </div>
                                </div>
                            </div>

                            <?php
                            $r = 0;
                            foreach ($roombook->find_all() as $u) {
                                $cin = $u->getCin();
                                if (isset($cin)) {
                                    $r = $r + 1;
                                }
                            }
                            ?>

                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed">
                                            <button class="btn btn-primary" type="button">
                                                Booked Rooms <span class="badge"><?php echo $r; ?></span>
                                            </button>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <?php
                                        foreach ($roombook->find_all() as $u) {
                                            $br = $u->getStat();
                                            if ($br != "Conform") {
                                                $fid = $u->getId();

                                                echo "<div class='col-md-3 col-sm-12 col-xs-12'>
                                                        <div class='panel panel-primary text-center no-boder bg-color-blue'>
                                                            <div class='panel-body'>
                                                                <i class='fa fa-users fa-5x'></i>
                                                                <h3>" . $u->getFName() . "</h3>
                                                            </div>
                                                            <div class='panel-footer back-footer-blue'>
                                                                <a href='show.php?sid=" . $fid . "'><button class='btn btn-primary btn' data-toggle='modal' data-target='#myModal'>
                                                                    Show
                                                                </button></a>
                                                                " . $u->getTRoom() . "
                                                            </div>
                                                        </div>
                                                    </div>";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $contact = new Contact(); // Assuming you have a Contact class for handling database interactions

                            $f = 0;
                            foreach ($contact->find_all() as $u) {
                                $f = $f + 1;
                            }
                            ?>

                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">
                                            <button class="btn btn-primary" type="button">
                                                Followers <span class="badge"><?php echo $f; ?></span>
                                            </button>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Full Name</th>
                                                            <th>Email</th>
                                                            <th>Follow Start</th>
                                                            <th>Permission status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($contact->find_all() as $u) {
                                                            echo "<tr>";
                                                            echo "<th>" . $u->getId() . "</th>";
                                                            echo "<th>" . $u->getFullname() . "</th>";
                                                            echo "<th>" . $u->getEmail() . "</th>";
                                                            echo "<th>" . $u->getCdate() . "</th>";
                                                            echo "<th>" . $u->getApproval() . "</th>";
                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <a href="messages.php" class="btn btn-primary">More Action</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DEOMO-->
    <!-- Rest of the code here... -->

</div>
<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<!-- JS Scripts -->
<!-- jQuery Js -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- Bootstrap Js -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- Metis Menu Js -->
<script src="assets/js/jquery.metisMenu.js"></script>
<!-- Morris Chart Js -->
<script src="assets/js/morris/raphael-2.1.0.min.js"></script>
<script src="assets/js/morris/morris.js"></script>
<!-- Custom Js -->
<script src="assets/js/custom-scripts.js"></script>

</body>

</html>