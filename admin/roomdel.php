<?php

use Admin\Libs\Rooms;

include "inc/header.php";



$room = new Rooms();
$roomIds = $room->getRoomIds();
?>

<div id="page-wrapper">
	<div id="page-inner">
		<div class="row">
			<div class="col-md-12">
				<h1 class="page-header">
					DELETE ROOM <small></small>
				</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						Delete room
					</div>
					<div class="panel-body">
						<form name="form" method="post">
							<div class="form-group">
								<label>Select the Room ID *</label>
								<select name="id" class="form-control" required>
									<option value="" selected></option>
									<?php
									foreach ($roomIds as $roomId) {
										echo '<option value="' . $roomId . '">' . $roomId . '</option>';
									}
									?>

								</select>
							</div>


							<input type="submit" name="del" value="Delete Room" class="btn btn-primary">
						</form>

						<?php


						// Kontrollojmë nëse është dorëzuar forma për të konfirmuar fshirjen e artikullit
						if (isset($_POST['del'])) {
							$did = $_POST['id'];


							// Delete the product
							$item = new Rooms();
							$item->find_id($did);
							$item->delete();
						}

						?>
					</div>

				</div>
			</div>


			<?php
			$room = new Rooms();

			$rooms = $room->find_all();

			if (count($rooms) > 0) {
				echo "<div class='row'>";

				foreach ($rooms as $room) {
					$id = $room->getType();
					$panel_color = "";

					switch ($id) {
						case "Superior Room":
							$panel_color = "blue";
							break;
						case "Deluxe Room":
							$panel_color = "green";
							break;
						case "Guest House":
							$panel_color = "brown";
							break;
						case "Single Room":
							$panel_color = "red";
							break;
					}

					echo "<div class='col-md-3 col-sm-12 col-xs-12'>
                <div class='panel panel-primary text-center no-boder bg-color-$panel_color'>
                    <div class='panel-body'>
                        <i class='fa fa-users fa-5x'></i>
                        <h3>" . $room->getBedding() . "</h3>
                    </div>
                    <div class='panel-footer back-footer-$panel_color'>
                        " . $room->getType() . "
                    </div>
                </div>
            </div>";
				}

				echo "</div>";
			} else {
				echo "No rooms found.";
			}
			?>

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


</body>

</html>