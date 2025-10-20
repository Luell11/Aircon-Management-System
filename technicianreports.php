<?php 
include("dbcon.php");
$technician_id = $_SESSION['technician_id'];

// Completed jobs today
$sql1 = "SELECT COUNT(*) AS completed_today 
         FROM service_request 
         WHERE technician_id = ? AND status = 'In Progress' AND DATE(created_at) = CURDATE()";
$stmt1 = $con->prepare($sql1);
$stmt1->bind_param("i", $technician_id);
$stmt1->execute();
$result1 = $stmt1->get_result();
$row1 = $result1->fetch_assoc();
$completed_today = $row1['completed_today'];

// Earnings today
// Calculate today's earnings for the technician
$sql2 = "SELECT COALESCE(SUM(price), 0) AS earnings_today 
         FROM service_request 
         WHERE technician_id = ? 
         AND status IN ('Completed', 'Finished') 
         AND DATE(created_at) = CURDATE()";

if ($stmt2 = $con->prepare($sql2)) {
    $stmt2->bind_param("i", $technician_id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $row2 = $result2->fetch_assoc();
    $earnings_today = $row2['earnings_today'];
    $stmt2->close();
} else {
    die("Query failed: " . $con->error);
}

?>
