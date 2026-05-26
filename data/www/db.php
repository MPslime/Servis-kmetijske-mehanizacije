<?php
$servername="podatkovna-baza";
$username="root";
$password="superVarnoGeslo";
$dbname="SKM";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Povezava je uspešna";
} catch(PDOException $e) {
  echo "Povezava ni uspešna: " . $e->getMessage();
}
?>
