<?php

use Admin\Libs\Payment;
use Admin\Libs\Roombook;
use Admin\Libs\Rooms;

require_once "./autoloader.php";

include "inc/header.php";

?>

<?php
if (!isset($_GET["rid"])) {
	header("location:index.php");
} else {


	$id = $_GET['rid'];
	$roombook = new Roombook();

	$roomData = $roombook->find_id($id); // Assuming you have a method in Roombook class to fetch data by ID

	if ($roomData) {
		// Fetch the data from the object
		$title = $roomData->getTitle();
		$fname = $roomData->getFName();
		$lname = $roomData->getLName();
		$email = $roomData->getEmail();
		$nat = $roomData->getNational();
		$country = $roomData->getCountry();
		$Phone = $roomData->getPhone();
		$troom = $roomData->getTRoom();
		$nroom = $roomData->getNRoom();
		$bed = $roomData->getBed();
		$non = $roomData->getNRoom();
		$meal = $roomData->getMeal();
		$cin = $roomData->getCin();
		$cout = $roomData->getCout();
		$sta = $roomData->getStat();
		$days = $roomData->getNodays();
	} else {
		// Room data not found, handle the error here (e.g., redirect or display an error message)
		header("location:index.php");
		exit();
	}
}
?>

<div id="page-wrapper">
	<div id="page-inner">


		<div class="row">
			<div class="col-md-12">
				<h1 class="page-header">
					Room Booking<small> <?php echo  $cin; ?> </small>
				</h1>
			</div>


			<div class="col-md-8 col-sm-8">
				<div class="panel panel-info">
					<div class="panel-heading">
						Booking Conformation
					</div>
					<div class="panel-body">

						<div class="table-responsive">
							<table class="table">
								<tr>
									<th>DESCRIPTION</th>
									<th>INFORMATION</th>

								</tr>
								<tr>
									<th>Name</th>
									<th><?php echo $title . $fname . $lname; ?> </th>

								</tr>
								<tr>
									<th>Email</th>
									<th><?php echo $email; ?> </th>

								</tr>
								<tr>
									<th>Nationality </th>
									<th><?php echo $nat; ?></th>

								</tr>
								<tr>
									<th>Country </th>
									<th><?php echo $country;  ?></th>

								</tr>
								<tr>
									<th>Phone No </th>
									<th><?php echo $Phone; ?></th>

								</tr>
								<tr>
									<th>Type Of the Room </th>
									<th><?php echo $troom; ?></th>

								</tr>
								<tr>
									<th>No Of the Room </th>
									<th><?php echo $nroom; ?></th>

								</tr>
								<tr>
									<th>Meal Plan </th>
									<th><?php echo $meal; ?></th>

								</tr>
								<tr>
									<th>Bedding </th>
									<th><?php echo $bed; ?></th>

								</tr>
								<tr>
									<th>Check-in Date </th>
									<th><?php echo $cin; ?></th>

								</tr>
								<tr>
									<th>Check-out Date</th>
									<th><?php echo $cout; ?></th>

								</tr>
								<tr>
									<th>No of days</th>
									<th><?php echo $days; ?></th>

								</tr>
								<tr>
									<th>Status Level</th>
									<th><?php echo $sta; ?></th>

								</tr>





							</table>
						</div>



					</div>
					<div class="panel-footer">
						<form method="post">
							<div class="form-group">
								<label>Select the Confirmation</label>
								<select name="conf" class="form-control">
									<option value selected> </option>
									<option value="Confirm">Confirm</option>


								</select>
							</div>
							<input type="submit" name="co" value="Confirm" class="btn btn-success">

						</form>
					</div>
				</div>
			</div>

			<?php

			$room = new Rooms();
			$roomsArray = $room->find_all();

			$r = 0;
			$sc = 0;
			$gh = 0;
			$sr = 0;
			$dr = 0;

			foreach ($roomsArray as $rRow) {
				$r = $r + 1;
				$s = $rRow->getType();
				$p = $rRow->getPlace();

				if ($s == "Superior Room") {
					$sc = $sc + 1;
				}

				if ($s == "Guest House") {
					$gh = $gh + 1;
				}
				if ($s == "Single Room") {
					$sr = $sr + 1;
				}
				if ($s == "Deluxe Room") {
					$dr = $dr + 1;
				}
			}
			?>
			?>

			<?php

			$payment = new Payment();
			$paymentsArray = $payment->find_all();

			$cr = 0;
			$csc = 0;
			$cgh = 0;
			$csr = 0;
			$cdr = 0;

			foreach ($paymentsArray as $pRow) {
				$cr = $cr + 1;
				$cs = $pRow->getTotalRooms();

				if ($cs == "Superior Room") {
					$csc = $csc + 1;
				}

				if ($cs == "Guest House") {
					$cgh = $cgh + 1;
				}
				if ($cs == "Single Room") {
					$csr = $csr + 1;
				}
				if ($cs == "Deluxe Room") {
					$cdr = $cdr + 1;
				}
			}


			?>
			<div class="col-md-4 col-sm-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						Available Room Details
					</div>
					<div class="panel-body">
						<table width="200px">

							<tr>
								<td><b>Superior Room </b></td>
								<td><button type="button" class="btn btn-primary btn-circle"><?php
																								$f1 = $sc - $csc;
																								if ($f1 <= 0) {
																									$f1 = "NO";
																									echo $f1;
																								} else {
																									echo $f1;
																								}


																								?> </button></td>
							</tr>
							<tr>
								<td><b>Guest House</b> </td>
								<td><button type="button" class="btn btn-primary btn-circle"><?php
																								$f2 =  $gh - $cgh;
																								if ($f2 <= 0) {
																									$f2 = "NO";
																									echo $f2;
																								} else {
																									echo $f2;
																								}

																								?> </button></td>
							</tr>
							<tr>
								<td><b>Single Room </b></td>
								<td><button type="button" class="btn btn-primary btn-circle"><?php
																								$f3 = $sr - $csr;
																								if ($f3 <= 0) {
																									$f3 = "NO";
																									echo $f3;
																								} else {
																									echo $f3;
																								}

																								?> </button></td>
							</tr>
							<tr>
								<td><b>Deluxe Room</b> </td>
								<td><button type="button" class="btn btn-primary btn-circle"><?php

																								$f4 = $dr - $cdr;
																								if ($f4 <= 0) {
																									$f4 = "NO";
																									echo $f4;
																								} else {
																									echo $f4;
																								}
																								?> </button></td>
							</tr>
							<tr>
								<td><b>Total Rooms </b> </td>
								<td> <button type="button" class="btn btn-danger btn-circle"><?php

																								$f5 = $r - $cr;
																								if ($f5 <= 0) {
																									$f5 = "NO";
																									echo $f5;
																								} else {
																									echo $f5;
																								}
																								?> </button></td>
							</tr>
						</table>





					</div>
					<div class="panel-footer">

					</div>
				</div>
			</div>
		</div>
		<!-- /. ROW  -->

	</div>
	<!-- /. ROW  -->




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
<!-- Morris Chart Js -->
<script src="assets/js/morris/raphael-2.1.0.min.js"></script>
<script src="assets/js/morris/morris.js"></script>
<!-- Custom Js -->
<script src="assets/js/custom-scripts.js"></script>


</body>

</html>

<?php
include('db.php');

if (isset($_POST['co'])) {
	$st = $_POST['conf'];

	if ($st == "Conform") {
		$room = new Rooms();

		$urb = "UPDATE `roombook` SET `stat`='$st' WHERE id = '$id'";

		if ($f1 == "NO") {
			echo "<script type='text/javascript'> alert('Sorry! Not Available Superior Room ')</script>";
		} else if ($f2 == "NO") {
			echo "<script type='text/javascript'> alert('Sorry! Not Available Guest House')</script>";
		} else if ($f3 == "NO") {
			echo "<script type='text/javascript'> alert('Sorry! Not Available Single Room')</script>";
		} else if ($f4 == "NO") {
			echo "<script type='text/javascript'> alert('Sorry! Not Available Deluxe Room')</script>";
		} else {
			if ($room->update($urb)) {
				// Rest of your code for calculations and database operations

				echo "<script type='text/javascript'> alert('Booking Conform')</script>";
				echo "<script type='text/javascript'> window.location='roombook.php'</script>";
			} else {
				echo "Error updating: ";
			}
		}
	}
}
?>