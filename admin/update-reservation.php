<?php
use Admin\Libs\Roombook;

require_once "./autoloader.php"; 

$roombook = new Roombook();
$reservations = $roombook->find_all();

foreach ($reservations as $trow) {
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
