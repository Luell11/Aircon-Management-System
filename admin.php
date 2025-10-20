<!DOCTYPE html>

<?php 
include("fetch_request.php");
$openTickets = countOpenTickets();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Admin Panel</title>
</head>
<body>
    <div class="sidebar">
        <div class="menu">
            <h1>Menu</h1>
        </div>
        <ul>
            <li><img src = "Images/dashboard (2).png"> &nbsp; <span>Dashboard</span></li>
            <li><img src = "Images/technician.png"> &nbsp; <span>Technicians</span></li>
            <li><img src = "Images/order.png"> &nbsp; <span>Work Orders</span></li>
            <li><img src = "Images/report.png"> &nbsp; <span>Reports</span></li>
            <li><img src = "Images/money.jpg"> &nbsp; <span>Income</span></li>
        </ul>
    </div>
    <div class="container">
        <div class="header">
            <h1>Dashboard</h1> 

        </div>
        <div class="content">
            <div class="cards">
                
                <div class="card">
                    <div class="box">
                        <h1>8/12</h1>
                        <h3>Active Technicians</h3>
                    </div>
                    <div class="icon-case">
                        <img src="Images/technician.png">
                    </div>                    
                </div>
                <div class="card">
                    <div class="box">
                        <h1><?php echo $openTickets; ?></h1>
                        <h3>Open Tickets</h3>
                    </div>
                    <div class="icon-case">
                        <img src="Images/order.png">
                    </div>                    
                </div>
                <div class="card">
                    <div class="box">
                        <h1>5</h1>
                        <h3>Critical Issues</h3>
                    </div>
                    <div class="icon-case">
                        <img src="Images/technician.png">
                    </div>                    
                </div>
                <div class="card">
                    <div class="box">
                        <h1>6/24</h1>
                        <h3>In-Progress Work</h3>
                    </div>
                    <div class="icon-case">
                        <img src="Images/technician.png">
                    </div>                    
                </div>
            </div>
            <div class="content-2">
                <div class="recent">
                <div class="title">
                    <h2>Recent Service Tickets</h2>
                    <a href="#" class="btn">View All</a>
                </div>
                
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Ticket</th>
                        <th>Apartment Unit</th>
                        <th>Time</th>
                        <th>Option</th>
                    </tr>
                    <?php if(mysqli_num_rows($query_run) > 0): ?> 
                        <?php while($row = mysqli_fetch_assoc($query_run)): ?>
                            <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo date("M d, Y h:i A", strtotime($row['created_at'])); ?></td>
                                <td><a href="view_request.php?id=<?php echo $row['id']; ?>" class="btn">View</a></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>         
                </table>
                
                </div>
            <div class="technician">
                <div class="title">
                    <h2>Technican Availablity</h2>
                    <a href="#" class="btn">View All</a>
                </div>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Option</th>

                    </tr>
                    <tr>
                        <td>Ekel Pogi</td>
                        <td class="status-available">Available</td>
                        <td><a href="#" class="btn">View</a></td>
                    </tr>
                    <tr>
                        <td>Ekel Pogi</td>
                        <td class="status-working">Working</td>
                        <td><a href="#" class="btn">View</a></td>
                    </tr>
                    <tr>
                        <td>Ekel Pogi</td>
                        <td class="status-off-duty">Off-Duty</td>
                        <td><a href="#" class="btn">View</a></td>
                    </tr>
                    <tr>
                        <td>Ekel Pogi</td>
                        <td class="status-working">Working</td>
                        <td><a href="#" class="btn">View</a></td>
                    </tr>
                    <tr>
                        <td>Ekel Pogi</td>
                        <td class="status-available">Available</td>
                        <td><a href="#" class="btn">View</a></td>
                    </tr>
                    
                </table>                                               
                </div>                                
            </div>   

            <div class="content-2">
                <div class="recent">
                <div class="title">
                    <h2>Quick Actions</h2>
                    
                    
                </div>
                <br>
                <div class="bts">
                    <a href="#" class="btn2">Select Worker</a>
                    <a href="#" class="btn2">Add Technicians</a>
                    <a href="#" class="btn2">Check Inventory</a>
                    <a href="#" class="btn2">Schedule</a>
                </div>
            
                             
        </div>  
        <div class="technician">
                <div class="title">
                    <h2>Email</h2>
                    
                </div>  
                <label for="about">Email: </label>
                <textarea id="email" placeholder="Write text Here"></textarea>
                <br><br><br><br><br><br><br><br><br><br><br><br>
                <a href="#" class="btn2">Send</a>     
    </div>
    </div>
    </div>
    </div>
</body>
</html>
