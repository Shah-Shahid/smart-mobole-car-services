<?php
function sanitize($conn, $variable)
{
$safe= mysqli_real_escape_string($conn, $variable);	
return $safe;
}

?>