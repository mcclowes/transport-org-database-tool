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
				window.location = 'add_driver.php?id=' + <?php echo $id ?>;
			}
			
			function getDriver() {
			
				var id_data = {
					'Driver_ID': <?php echo $id; ?>
				};
				
				$.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'getDriver',
						'form_data': id_data
                    },
                    dataType: "json",
                    success: function(returned_data) {
                        alert(JSON.stringify(returned_data));
                        $('#fName').text(returned_data['fName']);
                        $('#sName').text(returned_data['sName']);
                        $('#DOB').text(returned_data['DOB']);
                        $('#Home_Tel_No').text(returned_data['Tel_No']);
                        $('#Line1').text(returned_data['Address']['Line1']);
                        $('#Line2').text(returned_data['Address']['Line2']);
                        $('#Line3').text(returned_data['Address']['Line3']);
                        $('#Line4').text(returned_data['Address']['Line4']);
                        $('#Line5').text(returned_data['Address']['Line5']);
                        $('#Post_Code').text(returned_data['Address']['Post_Code']);
                        $('#Mobile_Tel_No').text(returned_data['Mobile_No']);
                        $('#Licence_Number').text(returned_data['Licence_No']);
                        $('#Licence_Points').text(returned_data['Licence_Points']);
                        $('#Licence_Expiry').text(returned_data['Licence_Expires']);
                        $('#DBS_Number').text(returned_data['DBS_No']);
                        $('#DBS_Issue_Date').text(returned_data['DBS_Issued']);
                        $('#Emergency_Name').text(returned_data['Emergency_Name']);
                        $('#Emergency_Tel').text(returned_data['Emergency_Tel']);
                        $('#Emergency_Relationship').text(returned_data['Emergency_Relationship']);
                        $('#Is_Volunteer').text(returned_data['Is_Volunteer']);
                        
                    }
                });
			
			}

			function deleteDriver() {
				var id_data = {
					'Driver_ID': <?php echo $id; ?>
				};
				
				$.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'deleteDriver',
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
    <body onload="getDriver()">
        <div id="wctLogo"></div>
        <?php include 'nav.php' ?>
        <div id="page_wrapper">
	        <div id="main">
	            <div id="driverInfo">
	                <fieldset id="personalDetails">
							<legend>Personal Details</legend>
							<table>
								<tr><td><label>First Name: </label></td><td id="fName"/> <td></tr>
								<tr><td><label>Surname: </label></td><td id="sName"/> <td></tr>
								<tr><td><label>Date of Birth: </label></td><td id="DOB"/> <td></tr>
								<tr><td><label>Home Number: </label></td><td id="Home_Tel_No"/> </td></tr>
								<tr><td><label>Mobile Number: </label></td><td id="Mobile_Tel_No"/> </td></tr>
                                <tr><td><label>Is Driver a volunteer?</label></td><td id="Is_Volunteer" /> </td></tr>
							</table>
						</fieldset>
						<fieldset id="personalAddress">
							<legend>Address</legend>
							<table>
								<tr><td><label>Address line 1: </label></td><td id="Line1"/> </td></tr>
								<tr><td><label>Address line 2: </label></td><td id="Line2"/> </td></tr>
								<tr><td><label>Address line 3: </label></td><td id="Line3"/> </td></tr>
								<tr><td><label>Address line 4: </label></td><td id="Line4"/> </td></tr>
								<tr><td><label>Address line 5: </label></td><td id="Line5"/> </td></tr>
								<tr><td><label>Postcode: </label></td><td id="Post_Code"/> </td></tr>
							</table>
						</fieldset>
						<fieldset id="emergencyContact">
							<legend>Emergency Contact</legend>
							<table>
								<tr><td><label>Emergency Contact Name: </label></td><td id="Emergency_Name"/></td></tr>
								<tr><td><label>Emergency Contact Number: </label></td><td id="Emergency_Tel"/></td></tr>
								<tr><td><label>Emergency Contact Relationship:</label></td><td id="Emergency_Relationship"/></td></tr>
							</table>
						</fieldset>
					</div>
					<div id="page2">
						<fieldset id="personalDetails">
                            <legend>Driving License Details</legend>
                            <table>
                                <tr><td><label>License Number: </label></td><td id="Licence_Number"/> <td></tr>
                                <tr><td><label>Expiry Date: </label></td><td id="Licence_Expiry"/> <td></tr>
                                <tr><td><label>Points on license: </label></td><td id="Licence_Points"/> <td></tr>
                                <tr><td><label>DBS Number: </label></td><td id="DBS_Number"/> </td></tr>
                                <tr><td><label>DBS Issue Date: </label></td><td id="DBS_Issue_Date"/> </td></tr>
                            </table>
                        </fieldset>
	                </br>
	            </div>
	            <input type="submit" id='submitButton' name="submit" value="Edit" onclick='submit()' />
	            <input type="submit" id='submitButton' name="delete" value="Delete" onclick='deleteDriver()' />
	        </div>
	    </div>
    </body>
</html>