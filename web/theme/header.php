<?php
$file = "headers/header_winter%s.jpg";

$file = sprintf($file, rand(1, 9));

header("location: " . $file);
exit;

?>