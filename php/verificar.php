<?php

session_start();
if (!isset($_SESSION['listo']) 
    || $_SESSION['listo'] !== true) { 
    header('Location: ../'); 
    exit;
}
?>