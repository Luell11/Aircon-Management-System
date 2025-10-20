<?php
session_start();
include("dbcon.php"); 

$query = "SELECT sr.id, sr.address, sr.created_at, u.name 
          FROM service_request sr 
          JOIN users u ON sr.user_id = u.id 
          ORDER BY sr.created_at DESC 
          LIMIT 10";

$query_run = mysqli_query($con, $query);

// Debug if query failed
if (!$query_run) {
    die("Query Failed: " . mysqli_error($con));
}
?>
