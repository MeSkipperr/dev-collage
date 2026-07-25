<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    $doc_root = rtrim($_SERVER['DOCUMENT_ROOT'], '/');
    $dir = rtrim(str_replace($doc_root, '', __DIR__), '/');
    header("Location: $dir/login.php");
    exit;
}
?>
