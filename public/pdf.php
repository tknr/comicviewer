<?php
include "../lib/config.php";
$filename = $CONFIG['local_base_dir'] . $_GET['p_filename'];

$path_parts = pathinfo($filename);

header("Content-type: application/pdf");
header('Content-Disposition: inline; filename="' . $path_parts['basename'] . '"');
header('Content-Length: ' . filesize($filename));
readfile($filename);
