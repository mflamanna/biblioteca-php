<?php
 include './services/connection.php';

    $id= $_GET['delete'];
    $mysqli->query("DELETE from worksofart WHERE id=$id");

    header("location: index.php");
?>