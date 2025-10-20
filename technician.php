<!DOCTYPE html>
<html lang="en">

<?php
include("fetch_request.php");
include("includesss/header.php");
$openTickets = countOpenTickets();
include("technicianreports.php");

?>
<?php $backgroundImage = 'dash.jpg'; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician</title>
    <link rel="stylesheet" href="technician.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css?v=<?php echo time() ?>" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <div class="header">
        <div>
            <h1>Technician Dashboard</h1>
            <h3>Aircon Ayos - Professional Service</h3>
        </div>
        <div class="tech-info">
            <?php while ($row = mysqli_fetch_assoc($techavailability_run)) : ?>
            <p><strong><?php echo $row['first_name']. ' '. $row['last_name'] ?></strong></p>            
            <p>ID: TECH<?php echo $row['id'] ?></p>
            <?php endwhile; ?>               
            <span id="indicator" class="status-indicator online"></span>
            <select id="status-select">
            <option value="online" selected>Online</option>
            <option value="working">Working</option>
            <option value="off-duty">Off-Duty</option>
            </select> 
            <script>
            const indicator = document.getElementById("indicator");
            const select = document.getElementById("status-select");

            select.addEventListener("change", () => {
                let status = select.value;

                // Change dot color instantly
                indicator.className = "status-indicator " + status;

                // Send update to PHP (AJAX)
                fetch("update_status.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "status=" + status
                })
                .then(res => res.text())
                .then(data => console.log(data));
            });
            </script>   

        </div>
        </div>
        <div class="navbar">
        </div>
        <div class="content">
            <div id="activejobs" class="tab-content active">
                <div class="grids">
                    

                    <div class="stat-cards">
    <h3><?php echo $completed_today; ?></h3>
    <p>Active Jobs</p>
</div>
<div class="stat-cards">
    <h3>₱<?php echo number_format($earnings_today, 2); ?></h3>
    <p>Earnings</p>
</div>
                
                </div>
                <div class="jobs-grid">        
                        <?php while ($row = mysqli_fetch_assoc($activejobs_run)) : ?>
                            <div class="job-card
                            <?php
                                echo ($row['service_type'] == 'Repair') ? 'high-priority' :
                                (($row['service_type'] == 'Maintenance') ? 'medium-priority' :
                                (($row['service_type'] == 'Installation' || $row['service_type'] == 'Inspection') ? 'low-priority' : ''));
                            ?>
                            ">
                                <div class="priority-badge 
                                <?php 
                                    echo ($row['service_type'] == 'Repair') ? 'badge-high' :
                                         (($row['service_type'] == 'Maintenance') ? 'badge-medium' :
                                         (($row['service_type'] == 'Installation' || $row['service_type'] == 'Inspection') ? 'badge-low' : ''));
                                ?>">
                                    <?php echo $row['service_type']; ?>
                                </div>                               
                                    <div class="customer-info">
                                        <h4><?php echo $row['first_name']. ' '. $row['last_name']; ?>
                                        <div class="location-info">
                                            <p><?php echo $row['address'] ?></p>
                                        </div>
                                        <p><strong>Phone: </strong><?php echo $row['phone'] ?? 'N/A' ?></p>                             
                                </div>
                                <div class="job-details">
                                    <h5><?php echo $row ['location_room']. ' - ' .$row['ac_model'] ?></h5>
                                    <p><strong>Issue: </strong><?php echo $row['issue_description'] ?> </p>
                                    <p><strong>Model: </strong><?php echo $row['ac_model'] ?> </p>   
                                    <p><strong>Customer Notes: "</strong><?php echo $row['customer_notes'] ?>" </p>
                                    <p><strong>Date: </strong><?php echo $row['preferred_date'] ?> </p>   
                                    <p><strong>Earnings: </strong><?php echo $row['price'] ?> </p>   
                                    
                                </div>
                                <br><br><br>
                                <div class="time-info">
                                    <p>Requested: <?php echo timeAgo($row['created_at'])?></p>
                                </div>
                                
                                    <form class="job-actions" action="start_job.php" method="POST">        
                                    <input type="hidden" name="job_id" value="<?php echo $row['id']?>">                           
                                    
                                    <button class="btn btn-warning" onclick="callcustomer('09295790716')">Call Customer</button>
                                    </form> 
                                
                            </div>
                    <?php endwhile; ?>

                </div>
            </div>

            <div id="schedule" class="tab-content">
                <h2>Today Schedule's</h2>
                <div class="box">
                    
                    <?php while($row = mysqli_fetch_assoc($schedulejobs_run)) : ?>
                        <div class="cardie">
                            <div class="information maintenance">
                                <p><strong><?php echo date("F j g:ia", strtotime($row['preferred_date']))?></strong></p>
                                <p><strong><?php echo $row['service_type'] ?></strong> - <?php echo $row['first_name'] ?></p>
                                <p>Address: <?php echo $row['address'] ?></p>
                                <p>Customer notes: <?php echo $row['customer_notes']?></p>
                                <p><strong>Earnings: </strong><?php echo $row['price']?></p>
                                <p>Contacts: <?php echo $row['phone'] ?></p>
                                <div class="photo-container">
                                <img src="<?php echo $row['photo']; ?>" alt="Job Photo">
                                </div>
                                
                                      
                                    <br><br>                 
                                    
                                <button class="btnreport completed" onclick="openModal()">Completed </button> 
                                <form method="POST" action="jobdone.php" enctype="multipart/form-data">       
                                    
                                <div class="modal" id="completedModal">
                                    <div class="modal-content">
                                        <h2>Submit Proof</h2>
                                        <label for="technician-notes">Technician Notes:</label>
                                        <textarea id="technician-notes" name="technician_note" rows="4" style="resize: vertical; width:100%;" placeholder="Enter detailed notes here..."></textarea>
                                        
                                        <label for="proofphoto">Technician Proof: </label>
                                        <input type="file" name="proof_photo"> 
                                        <button class="btnreport completed" type="submit" onclick="return confirm('Are you sure you want to submit?')">Completed </button> 
                                        <input type="hidden" name="job_id" value="<?php echo $row['job_id']; ?>"> 
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <script>
                            function openModal() {
                            document.getElementById("completedModal").style.display = "flex";
                            }
                        </script>
                    <?php endwhile; ?>

                </div>
            </div>
            
            <div id="completed" class="tab-content">
                <div class="box">
                    <h2>Completed Jobs </h2>
                </div>                
                    <div class="card2">
                        <?php while($row = mysqli_fetch_assoc($completed_run)) : ?>
                        <div class="clientinformation">
                            <div class="customer-info">
                                <p><strong><?php echo date('F, d, Y', strtotime($row['date_finished'])) ?></strong></p>
                                <p><strong>Customer Name: </strong><?php echo $row['customer_name'] ?></p>
                                <p><strong>Service Type: </strong><?php echo $row['service_type'] ?></p>
                                <p><strong><?php echo $row['ac_model'] ?> Type</strong> - Completed at <?php echo date("h i:a", strtotime($row['date_finished'])) ?></p>
                                <p><strong>Issue:</strong> <?php echo $row['customer_notes'] ?> </p>
                                <p><strong>Cost:</strong> <?php echo $row['price'] ?? 'N/A' ?> </p>                           
                            </div> 
                        
                    </div>    
                <?php endwhile; ?>                                                                  
                </div>            
            </div>

            <div id="reports" class="tab-content">
                <h2>Job Report</h2>
                
                    <form action="reports.php" method="POST">
                        <div class="form-group">
                            <label for="job-select">Select Job</label>
                            <select id="job-select" name="job_id">
                                <?php while($row = mysqli_fetch_assoc($reports_run)) : ?>
                                <option value="<?php echo $row['job_id']; ?>"><?php echo $row['customer_name'] ?> --- <?php echo $row['service_type'] ?></option>
                                <?php endwhile; ?> 
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="work-performed">Work Performed</label>
                            <textarea id="work-performed" name="work_performed" rows="4" placeholder="Describe the work completed"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="parts-used">Parts Used</label>
                            <textarea id="parts-used" name="parts_used" rows="3" placeholder="List parts and materials used"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="labor-cost">Labor Cost</label>
                            <textarea id="labor-cost" name="labor_cost" placeholder="0.00"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="parts-cost">Parts Cost</label>
                            <textarea id="parts-cost" name="parts_cost" placeholder="0.00"></textarea>
                        </div>
                        <br><br>
                        <button class="btnreport submit" name="submit_report" >Submit Report</button>
                </form>
                               
            </div>
        </div>
    </div> 
    <script src="technician.js"></script> 
    
</body>
</html>