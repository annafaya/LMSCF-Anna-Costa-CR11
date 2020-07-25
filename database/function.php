<?php
function clearString($param){
$val = trim($param);
$val = strip_tags($val);
$val = htmlspecialchars($val);
return $val;
}
// sanitize user input to prevent sql injection
?>
