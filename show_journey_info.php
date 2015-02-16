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
            <div id="main">
            <div id="journeyInfo">
                <fieldset id="bookeeDetails">
                    <legend>Bookee Details</legend>
                    <table>
                        <tr><td><label>First Name: </label></td><td id="fName"><td></tr>
                        <tr><td><label>Surname: </label></td><td id="sName"><td></tr>
                        <tr><td><label>Contact Number: </label></td><td id="Tel_No"></td></tr>
                        <tr><td><label>Group: </label></td><td id="Group"></td></tr>
                    </table>
                </fieldset>
                <fieldset id="bookeeAddress">
                    <legend>Bookee Address</legend>
                    <table>
                        <tr><td><label>Address line 1: </label></td><td id="Address_Line1"></td></tr>
                        <tr><td><label>Address line 2: </label></td><td id="Address_Line2"></td></tr>
                        <tr><td><label>Address line 3: </label></td><td id="Address_Line3"></td></tr>
                        <tr><td><label>Address line 4: </label></td><td id="Address_Line4"></td></tr>
                        <tr><td><label>Address line 5: </label></td><td id="Address_Line5"></td></tr>
                        <tr><td><label>Postcode: </label></td><td id="Address_Post_Code"></td></tr>
                    </table>
                </fieldset>
                <fieldset id="journeyDetails">
                    <legend>Booking Details</legend>
                    <table>
                        <tr><td><label>Booking Date: </label></td><td id="Booking_Date"><td></tr>
                        <tr><td><label>Journey Description: </label></td><td id="Journey_Description"><td></tr>
                        <tr><td><label>Date required: </label></td><td id="Journey_Date"><td></tr>
                        <tr><td><label>No. of passengers: </label></td><td id="No_Passengers"><td></tr>
                        <tr><td><label>Passenger notes: </label></td><td id="Passengers_Note"><td></tr>
                        <tr><td><label>No. of wheelchair users/ transfers: </label></td><td id="Wheelchairs"><td></tr>
                        <tr><td><label>No. of wheelchair users/ transfers: </label></td><td id="Transferees"><td></tr>
                        <tr><td><label>Other access needs: </label></td><td id="Other_Access"><td></tr>
                        <tr><td><label>Booking taken by: </label></td><td id="Booked_By"><td></tr>
                    </table>
                </fieldset>
                <fieldset id="destinationAddress">
                    <legend>Destination Address</legend>
                    <table>
                        <tr><td><label>Address line 1: </label></td><td id="Destination_Line1"></td></tr>
                        <tr><td><label>Address line 2: </label></td><td id="Destination_Line2"></td></tr>
                        <tr><td><label>Address line 3: </label></td><td id="Destination_Line3"></td></tr>
                        <tr><td><label>Address line 4: </label></td><td id="Destination_Line4"></td></tr>
                        <tr><td><label>Address line 5: </label></td><td id="Destination_Line5"></td></tr>
                        <tr><td><label>Postcode: </label></td><td id="Destination_Post_Code"></td></tr>
                    </table>
                </fieldset>
                <fieldset id="pickupDetails">
                    <legend>Pickup Address</legend>
                    <table>
                        <tr><td><label>Address line 1: </label></td><td id="Pickup_1_Line1"></td></tr>
                        <tr><td><label>Address line 2: </label></td><td id="Pickup_1_Line2"></td></tr>
                        <tr><td><label>Address line 3: </label></td><td id="Pickup_1_Line3"></td></tr>
                        <tr><td><label>Address line 4: </label></td><td id="Pickup_1_Line4"></td></tr>
                        <tr><td><label>Address line 5: </label></td><td id="Pickup_1_Line5"></td></tr>
                        <tr><td><label>Postcode: </label></td><td id="Pickup_1_Post_Code"></td></tr>
                        <tr><td><label>Pickup Time: </label></td><td id="Pickup_1_Time"><td></tr>
                        <tr><td><label>Pickup Note: </label></td><td id="Pickup_1_Note"><td></tr>
                    </table>
                </fieldset>
                <!--add new pickup-->
                <fieldset id="returnDetails">
                    <legend>Pickup Address</legend>
                    <table>
                        <tr><td><label>Return time: </label></td><td id="Return_Time"><td></tr>
                        <tr><td><label>Return note: </label></td><td id="Return_Note"><td></tr>
                    </table>
                </fieldset>
                <fieldset id="officeUse">
                    <legend>Other Details</legend>
                    <table>
                        <tr><td><label>Driver: </label></td><td id="Driver"><td></tr>
                        <tr><td><label>Allocated Vehicle: </label></td><td id="Vehicle"><td></tr>
                        <tr><td><label>Keys to collect: </label></td><td id="Keys_To_Collect"><td></tr>
                        <tr><td><label>Price quoted: </label></td><td><td id="Quote"></tr>
                        <tr><td><label>Miles/KMs run: </label></td><td><td id="Distance_Run"></tr>
                        <tr><td><label>Invoiced cost: </label></td><td><td id="Invoiced_Cost"></tr>
                        <tr><td><label>Invoice sent on: </label></td><td id="Invoice_Sent"><td></tr>
                        <tr><td><label>Invoice paid on: </label></td><td id="Invoice_Paid"><td></tr>
                    </table>
                </fieldset>
                <fieldset id="notes">
                    <legend>Journey Notes</legend><p id="Journey_Notes"></p>
                </fieldset>
                    </br>
            </div>
        </div>
    </body>
</html>