<html>
    <head>
	
		<?php
			$id = $_GET['id'];
		?>
	
        <title>WCT Tool | Home</title>
        <link rel="icon" type="image/png" href="./img/wct_icon.png">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		
		<script>
		
			function submit() {
				window.location = 'add_vehicle.php?id=' + <?php echo $id ?>;
			}
			
			function getVehicle() {
			
				var id_data = {
					'Vehicle_ID': <?php echo $id; ?>
				};
				
				$.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'getVehicle',
						'form_data': id_data
                    },
                    dataType: "json",
                    success: function(returned_data) {
                        //alert(JSON.stringify(returned_data));
                        $('#Nickname').text(returned_data['Nickname']);
                        $('#Licence').text(returned_data['Registration']);
                        $('#Make').text(returned_data['Make']);
                        $('#Model').text(returned_data['Model']);
                        $('#Colour').text(returned_data['Colour']);
                        $('#Capacity_Passengers').text(returned_data['Capacity_Passengers']);
                        $('#Capacity_Note').text(returned_data['Seating_Configurations']);
                        $('#Tax_Due').text(returned_data['Tax_Due']);
                        $('#MOT_Due').text(returned_data['MOT_Due']);
                        $('#Safety_Due').text(returned_data['Inspection_Due']);
                        $('#Service_Due').text(returned_data['Service_Due']);
                        $('#Tail_Lift_Service_Due').text(returned_data['Tail_Service_Due']);
                        $('#Permit_Number').text(returned_data['Section_19_No']);
                        $('#Permit_Expiry').text(returned_data['Section_19_Due']);

                    }
                });
			
			}

			function deleteVehicle() {
				var id_data = {
					'Vehicle_ID': <?php echo $id; ?>
				};
				
				$.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'deleteVehicle',
						'form_data': id_data
                    },
                    dataType: "json",
					success: function(returned_data) {
	                    	window.location = 'index.php';
	                    }
	            });
			}
		
		</script>
		
    </head>
    <body onload="getVehicle()">
        <div id="wctLogo"></div>
        <?php include 'nav.php' ?>
        <div id="page_wrapper">
	        <div id="main">
	            <div id="vehicleInfo">
	                <fieldset id="VehicleDetails">
							<legend>Vehicle Details</legend>
							<table>
								<tr><td><label>Nickname: </label></td><td id="Nickname"> <td></tr>
								<tr><td><label>Registration Number: </label></td><td id="Licence"> <td></tr>
								<tr><td><label>Make: </label></td><td id="Make"> <td></tr>
								<tr><td><label>Model: </label></td><td id="Model"> <td></tr>
								<tr><td><label>Colour: </label></td><td id="Colour"> <td></tr>
								<tr><td><label>Passenger seating capacity: </label></td><td id="Capacity_Passengers"> </td></tr>
                                <tr><td><label>Capacity note (other configurations): </label></td><td id="Capacity_Note"> </td></tr>
							</table>
						</fieldset>
						<fieldset id="maintentanceDetails">
							<legend>Maintentance Details</legend>
							<table>
								<tr><td><label>Tax Due: </label></td><td id="Tax_Due"></td></tr>
								<tr><td><label>MOT Due: </label></td><td id="MOT_Due"></td></tr>
								<tr><td><label>Safety Inspection Due:</label></td><td id="Safety_Due"></td></tr>
		                        <tr><td><label>Service Due: </label></td><td id="Service_Due"> </td></tr>
                                <tr><td><label>Tail Lift Service Due: </label></td><td id="Tail_Lift_Service_Due"> </td></tr>
                                <tr><td><label>Section 19 Permit Number: </label></td><td id="Permit_Number"> </td></tr>
                                <tr><td><label>Section 19 Expiry Date: </label></td><td id="Permit_Expiry"> </td></tr>
                            </table>
						</fieldset>
					</div>
	                </br>
	            </div>
	            <input type="submit" id='submitButton' name="submit" value="Edit" onclick='submit()' />
	            <input type="submit" id='submitButton' name="delete" value="Delete" onclick='deleteVehicle()' />
	        </div>
	    </div>
    </body>
</html>