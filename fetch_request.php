<?php
session_start();
include("dbcon.php"); 

$query = "SELECT sr.id, sr.address, sr.created_at, u.first_name, u.last_name, sr.location_room, sr.status, preferred_date 
          FROM service_request sr 
          JOIN users u ON sr.user_id = u.id 
          WHERE sr.status = 'Pending'         
          ORDER BY sr.created_at DESC 
          LIMIT 10";

$query_run = mysqli_query($con, $query);

$in_progress_edit = "SELECT sr.id, sr.address, sr.created_at, u.first_name, u.last_name, sr.location_room, sr.status 
          FROM service_request sr 
          JOIN users u ON sr.user_id = u.id 
          WHERE sr.status  IN ('In Progress','Pending')          
          ORDER BY sr.created_at DESC 
          LIMIT 10";

$in_progress_edit_run = mysqli_query($con, $in_progress_edit);

function countOpenTickets() {
    global $con;
    $sql = "SELECT COUNT(*) as total FROM service_request
            WHERE service_request.status IN ('In Progress','Pending')";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function totalCompleted() {
    global $con;
    $sql = "SELECT COUNT(*) as total FROM service_request sr
            WHERE sr.status IN ('Completed')";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}


function totalTechnician() {
    global $con;

    $total_sql = "SELECT COUNT(*) AS total_techs FROM users WHERE role = 'technician'";
    $total_run = mysqli_query($con, $total_sql);
    $total_row = mysqli_fetch_assoc($total_run);
    $total_techs = $total_row['total_techs'];

    $active_sql = "SELECT COUNT(*) AS active_techs FROM users WHERE role = 'technician' AND status = 'Online'";
    $active_run = mysqli_query($con, $active_sql);
    $active_row = mysqli_fetch_assoc($active_run);
    $active_techs = $active_row['active_techs'];

    return $active_techs . '/' . $total_techs;
}

function inprogress() {
    global $con;

    $total_sql = "SELECT COUNT(*) AS total_progress FROM service_request WHERE status= 'In Progress'";
    $total_run = mysqli_query($con, $total_sql);
    $total_row = mysqli_fetch_assoc($total_run);
    $total_progress = $total_row['total_progress'];

    $finished_sql = "SELECT COUNT(*) AS finished_work FROM service_request WHERE status IN('In Progress', 'Pending')";
    $finished_run = mysqli_query($con, $finished_sql);
    $finished_row = mysqli_fetch_assoc($finished_run);
    $finished_work = $finished_row['finished_work'];

    return  $total_progress .'/'. $finished_work;
}


 
$user_id = $_SESSION['auth_user']['id'];

$customerquery = "SELECT sr.id, sr.service_type, sr.status, sr.preferred_date,
                    sr.technician_id, price, u.phone, sr.price, sr.ac_brand,
                    CONCAT(u.first_name, ' ', u.last_name) AS technician_name
                  FROM service_request sr
                  LEFT JOIN users u ON sr.technician_id = u.id 
                  WHERE sr.user_id = '$user_id' 
                    AND sr.status IN('Pending', 'In Progress')
                  ORDER BY sr.created_at DESC";

$customerquery_run = mysqli_query($con, $customerquery);



$technician_id = $_SESSION['auth_user']['id']; // get logged-in technician ID

$activejobs = "
    SELECT sr.*, u.* 
    FROM service_request sr 
    INNER JOIN users u ON sr.user_id = u.id 
    WHERE sr.status = 'In Progress' 
      AND sr.technician_id = '$technician_id'
";

$activejobs_run = mysqli_query($con, $activejobs);


$techavailability = "SELECT * FROM users WHERE id = $user_id";
$techavailability_run = mysqli_query($con, $techavailability);

function timeAgo($datetime) {
    $timestamp = strtotime($datetime);
    $diff = time() - $timestamp;

    if ($diff < 0) {    
        return $diff;
    }   elseif ($diff <3600) {
    return(floor($diff/60))." minutes ago";
    }   elseif ($diff < 86400) {
    return(floor($diff/3600))." hours ago";
    }   else {
    return(floor($diff/86400))." days ago";
    }
}

$technician_id = $_SESSION['auth_user']['id']; // use the correct session variable

$schedulejobs = "
    SELECT sr.*, u.*, sr.id AS job_id
    FROM service_request sr
    INNER JOIN users u ON sr.user_id = u.id
    WHERE sr.status = 'In Progress'
      AND sr.technician_id = '$technician_id'
";
$schedulejobs_run = mysqli_query($con, $schedulejobs);


$reports = "SELECT sr.id AS job_id, sr.service_type, CONCAT(u.first_name, ' ', u.last_name) AS customer_name
                  FROM service_request sr
                  INNER JOIN users u on sr.user_id = u.id
                  WHERE sr.status = 'Completed'
                  ORDER BY sr.created_at DESC";
$reports_run = mysqli_query($con, $reports);


$userid = $_SESSION['auth_user']['id'];
$userprofile = "SELECT * FROM users WHERE id = $userid";
$userprofile_run = mysqli_query($con, $userprofile);



$completed = "SELECT CONCAT(t.first_name, ' ', t.last_name) AS technician_name, CONCAT(u.first_name, ' ', u.last_name) AS customer_name, sr.status AS service_status, sr.id AS service_id, sr.*, u.* FROM service_request sr
                  INNER JOIN users t on sr.technician_id = t.id
                  INNER JOIN users u on sr.user_id = u.id
                  WHERE sr.status IN ('Finished', 'Completed', 'Proof') AND sr.technician_id = '$technician_id'
                  ORDER BY sr.created_at DESC";
$completed_run = mysqli_query($con, $completed);

$technician = "SELECT * FROM users
                WHERE role IN ('technician')";
$technician_run = mysqli_query($con, $technician);

$adminquery = "SELECT 
                  CONCAT(u.first_name, ' ', u.last_name) AS customer_name,
                  sr.status AS service_status, 
                  CONCAT(t.first_name, ' ', t.last_name) AS technician_name, 
                  sr.id AS service_id, 
                  sr.*, 
                  u.*
               FROM service_request sr
               INNER JOIN users u ON sr.user_id = u.id  
               LEFT JOIN users t ON sr.technician_id = t.id            
               WHERE sr.status IN ('In Progress', 'Pending')";


$adminquery_run = mysqli_query($con, $adminquery);

$adminqueryfinished = "SELECT 
                CONCAT(u.first_name, ' ', u.last_name) AS customer_name, 
                CONCAT(t.first_name, ' ', t.last_name) AS technician_name, 
                sr.status AS service_status, sr.id AS service_id, sr.*, u.* FROM service_request sr
                INNER JOIN users t on sr.technician_id = t.id
                INNER JOIN users u on sr.user_id = u.id
                WHERE sr.status IN ('Completed', 'Proof')";

$adminqueryfinished_run = mysqli_query($con, $adminqueryfinished);


$cancelled = "SELECT
                sr.id AS service_id, sr.*
                FROM service_request sr WHERE sr.status = 'Cancelled'";

$cancelled_run = mysqli_query($con, $cancelled);
?>




