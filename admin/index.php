<?php
require_once("includes/header.php");
if (!$session->is_signed_in() || !$session->is_admin()) {
    header("location:login.php");
    exit();
}
require_once("includes/sidebar.php");
require_once("includes/content-top.php");
require_once("includes/content.php");
require_once("includes/widget.php");
require_once("includes/footer.php");
?>
