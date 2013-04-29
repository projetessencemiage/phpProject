<?php 
$ens = $_GET['enseigne'];
$add = $_GET['adresse'];
$CP = $_GET['cp'];
$city = $_GET['ville'];
$phone = $_GET['tel'];

echo "<img src=\"../../images/icone_infos_station.png\">";
echo "<h4>$ens</h4>";
echo "$add";
echo "$CP";
echo "$city";echo"</br>";
echo "Tel: ".$phone;
?>

