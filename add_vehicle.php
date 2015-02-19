
<html>
    <head>
        <title>WCT Tool | Add Vehicle</title>
        <link rel="icon" type="image/png" href="./img/wct_icon.png">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <script type="text/javascript">
            function submit() {
                form_data = {
                    'Nickname':						document.getElementById('input-Nickname').value,
                    'Registration':						document.getElementById('input-Licence').value,
                    'Make':							document.getElementById('input-Make').value,
                    'Model':						document.getElementById('input-Model').value,
                    'Colour':						document.getElementById('input-Colour').value,
                    'Capacity_Passengers':			document.getElementById('number-Capacity_Passengers').value,
                    'Seating_Configurations':				document.getElementById('input-Capacity_Note').value,
                    'Tax_Due':						document.getElementById('date-Tax_Due').value,
                    'MOT_Due':						document.getElementById('date-MOT_Due').value,
                    'Inspection_Due':					document.getElementById('date-Safety_Due').value,
                    'Service_Due':					document.getElementById('date-Service_Due').value,
                    'Tail_Service_Due':				document.getElementById('date-Tail_Lift_Service_Due').value,
                    'Section_19_No':				document.getElementById('input-Permit_Number').value,
                    'Section_19_Due':				document.getElementById('date-Permit_Expiry').value
                };

                $.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'addVehicle',
                        'form_data': form_data
                    },
                    dataType: "json",
                    success: function(returned_data) {
                    }
                });
            }
        </script>
    </head>
    <body onload="startScreen()">
        <div id="wctLogo"></div>
        <?php include 'nav.php' ?>
        <div id="page_wrapper">
            <div id="main">
                <form method="POST" action="">
					<div id="page1">
						<fieldset id="personalDetails">
							<legend>Vehicle Details</legend>
							<table>
								<tr><td><label>Nickname: </label></td><td><input type="text" id="input-Nickname"/> <td></tr>
								<tr><td><label>Registration Number: </label></td><td><input type="text" id="input-Licence"/> <td></tr>
								<tr><td><label>Make: </label></td><td><input type="text" id="input-Make"/> <td></tr>
								<tr><td><label>Model: </label></td><td><input type="text" id="input-Model"/> <td></tr>
								<tr><td><label>Colour: </label></td><td><input type="text" id="input-Colour"/> <td></tr>
								<tr><td><label>Passenger seating capacity: </label></td><td><input type="text" id="number-Capacity_Passengers"/> </td></tr>
                                <tr><td><label>Capacity note (other configurations): </label></td><td><input type="text" id="input-Capacity_Note"/> </td></tr>
							</table>
						</fieldset>
						<fieldset id="emergencyContact">
							<legend>Maintentance Details</legend>
							<table>
								<tr><td><label>Tax Due: </label></td><td><input type="date" id="date-Tax_Due"/></td></tr>
								<tr><td><label>MOT Due: </label></td><td><input type="date" id="date-MOT_Due"/></td></tr>
								<tr><td><label>Safety Inspection Due:</label></td><td><input type="date" id="date-Safety_Due"/></td></tr>
		                        <tr><td><label>Service Due: </label></td><td><input type="date" id="date-Service_Due"/> </td></tr>
                                <tr><td><label>Tail Lift Service Due: </label></td><td><input type="date" id="date-Tail_Lift_Service_Due"/> </td></tr>
                                <tr><td><label>Section 19 Permit Number: </label></td><td><input type="text" id="input-Permit_Number"/> </td></tr>
                                <tr><td><label>Section 19 Expiry Date: </label></td><td><input type="date" id="date-Permit_Expiry"/> </td></tr>
                            </table>
						</fieldset>
					</div>
                    <input type="text" name="mobility" id="mobility" style='display:none;'/>
                    </br>
                </form>
				<div id="submitButton" onclick="submit();">Submit</div>
				<div id="cancelButton" onclick="cancel()">Cancel</div>
				<div id='result'></div> 
            </div>
        </div>
    </body>
</html>