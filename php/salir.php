<?php
session_start();
if (isset($_SESSION['listo'])) { 
   unset($_SESSION['listo']); 
}
header('Location: ../index.php'); 
exit;
?>