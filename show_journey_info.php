<html>
    <head>
	
		<?php
			$id = $_GET['id'];
			echo($id);
		?>
	
        <title>WCT Tool | Home</title>
        <link rel="icon" type="image/png" href="./img/wct_icon.png">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		
		<script>
			
			function getJourney() {
			
				var id_data = {
					'Journey_ID': <?php echo $id; ?>
				};
				
				$.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'getJourney',
						'form_data': id_data
                    },
                    dataType: "json",
                    complete: function(returned_data) {						
						$('#main').replaceWith('<div id="main">'+JSON.stringify(returned_data)+'</div>');						
                    }
                });
			
			}
		
		</script>
		
    </head>
    <body onload="getJourney()">
        <div id="wctLogo"></div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="journeys.php">Journeys</a>
                    <ul>
                        <li><a href="journeys.php">Manage Journeys</a></li>
                        <li><a href="add_journey.php">Add Journey</a></li>
                    </ul>
                </li>
                <li><a href="groups.php">Groups</a>
                    <ul>
                        <li><a href="manage_groups.php">Manage Groups</a></li>
                        <li><a href="add_group.php">Add group</a></li>
                    </ul>
                </li>
                <li><a href="members.php">Members</a>
                    <ul>
                        <li><a href="manage_members.php">Manage Members</a></li>
                        <li><a href="add_member.php">Add Member</a></li>
                    </ul>
                </li>
                <li><a href="vehicles.php">Vehicles</a>
                    <ul>
                        <li><a href="manage_vehicles.php">Manage Vehicles</a></li>
                        <li><a href="add_vehicle.php">Add vehicle</a></li>
                    </ul>
                </li>
                <li><a href="drivers.php">Drivers</a>
                    <ul>
                        <li><a href="manage_drivers.php">Manage Drivers</a></li>
                        <li><a href="add_driver.php">Add Driver</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="main">
            Insert content here
        </div>
    </body>
</html>