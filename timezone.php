<?php
$timezone_offset_minutes = $_GET['time']; 
$timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);

// Asia/Kolkata
echo $timezone_name;
 die;

 ?>