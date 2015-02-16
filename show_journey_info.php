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
                    success: function(returned_data) {
                        //alert(JSON.stringify(returned_data));
                        $('#fName').text(returned_data['fName']);
                        $('#sName').text(returned_data['sName']);
                        $('#Tel_No').text(returned_data['Tel_No']);
                        $('#Group').text(returned_data['Group_Name']);
                        $('#Address_Line1').text(returned_data['Address']['Line1']);
                        $('#Address_Line2').text(returned_data['Address']['Line2']);
                        $('#Address_Line3').text(returned_data['Address']['Line3']);
                        $('#Address_Line4').text(returned_data['Address']['Line4']);
                        $('#Address_Line5').text(returned_data['Address']['Line5']);
                        $('#Address_Post_Code').text(returned_data['Address']['Post_Code']);
                        $('#Booking_Date').text(returned_data['Booking_Date']);
                        $('#Journey_Description').text(returned_data['Journey_Description']);
                        $('#Journey_Date').text(returned_data['Journey_Date']);
                        $('#No_Passengers').text(returned_data['No_Passengers']);
                        $('#Passengers_Note').text(returned_data['Passengers_Note']);
                        $('#Wheelchairs').text(returned_data['Wheelchairs']);
                        $('#Transferees').text(returned_data['Transferees']);
                        $('#Other_Access').text(returned_data['Other_Access']);
                        $('#Booked_By').text(returned_data['Booked_By']);
                        $('#Destination_Line1').text(returned_data['Destination']['Line1']);
                        $('#Destination_Line2').text(returned_data['Destination']['Line2']);
                        $('#Destination_Line3').text(returned_data['Destination']['Line3']);
                        $('#Destination_Line4').text(returned_data['Destination']['Line4']);
                        $('#Destination_Line5').text(returned_data['Destination']['Line5']);
                        $('#Destination_Post_Code').text(returned_data['Destination']['Post_Code']);
                        //Add more pick up stuff
                        $('#Pickup_1_Line1').text(returned_data['Pickups'][0]['Address']['Line1']);
                        $('#Pickup_1_Line2').text(returned_data['Pickups'][0]['Address']['Line2']);
                        $('#Pickup_1_Line3').text(returned_data['Pickups'][0]['Address']['Line3']);
                        $('#Pickup_1_Line4').text(returned_data['Pickups'][0]['Address']['Line4']);
                        $('#Pickup_1_Line5').text(returned_data['Pickups'][0]['Address']['Line5']);
                        $('#Pickup_1_Post_Code').text(returned_data['Pickups'][0]['Address']['Post_Code']);
                        $('#Pickup_1_Time').text(returned_data['Pickups'][0]['Time']);
                        $('#Pickup_1_Note').text(returned_data['Pickups'][0]['Note']);
                        $('#Return_Time').text(returned_data['Return_Time']);
                        $('#Return_Note').text(returned_data['Return_Note']);
                        $('#Driver').text(returned_data['Driver_Name']);
                        $('#Vehicle').text(returned_data['Vehicle_Nickname']);
                        $('#Keys_To_Collect').text(returned_data['Keys_To_Collect']);
                        $('#Quote').text(returned_data['Quote']);
                        $('#Distance_Run').text(returned_data['Distance_Run']);
                        $('#Invoiced_Cost').text(returned_data['Invoiced_Cost']);
                        $('#Invoice_Sent').text(returned_data['Invoice_Sent']);
                        $('#Invoice_Paid').text(returned_data['Invoice_Paid']);
                        $('#Journey_Notes').text(returned_data['Journey_Note']);



                    }
                });
			
			}
		
		</script>
		
    </head>
    <body onload="getJourney()">
        <div id="wctLogo"></div>
        <?php include 'nav.php' ?>
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
                        <tr><td><label>No. of wheelchair users: </label></td><td id="Wheelchairs"><td></tr>
                        <tr><td><label>No. of wheelchair transferees: </label></td><td id="Transferees"><td></tr>
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
                    <legend>Return Details</legend>
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