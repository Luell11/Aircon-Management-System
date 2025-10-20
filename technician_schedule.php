<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>




    <div id="schedule" class="tab-content">
                <h2>Today Schedule's</h2>
                <div class="box">
                    
                    <?php while($row = mysqli_fetch_assoc($schedulejobs_run)) : ?>
                        <div class="cardie">
                            <div class="information maintenance">
                                <p><strong><?php echo date("F j g:ia", strtotime($row['preferred_date']))?></strong></p>
                                <p><strong><?php echo $row['service_type'] ?></strong> - <?php echo $row['name'] ?></p>
                                <p>Address: <?php echo $row['address'] ?></p>
                                <p>Customer notes: <?php echo $row['customer_notes']?></p>
                                <p><strong>Earnings: </strong><?php echo $row['price']?></p>
                                <p>Contacts: <?php echo $row['phone'] ?></p>
                                <div class="photo-container">
                                <img src="<?php echo $row['photo']; ?>" alt="Job Photo">
                                </div>
                                <form method="POST" action="jobdone.php">       
                                    <input type="hidden" name="job_id" value="<?php echo $row['job_id']; ?>">   
                                    <br><br>                 
                                <button class="btnreport completed" type="submit">Completed </button> 
                                </form>
                            </div>
                        </div>
                    <?php endwhile; ?>

                </div>
            </div>
    
</body>
</html>