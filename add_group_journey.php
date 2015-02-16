
<html>
    <head>
        <title>WCT Tool | Add Journey</title>
        <link rel="icon" type="image/png" href="./img/wct_icon.png">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

		<?php
			if (isset($_POST['submitButton'])) {
				$is_edit = true;
				
				$id = $_POST['Journey_ID'];
			}
			else {
				$is_edit = false;
			}
		?>

        <script type="text/javascript">
        	//GLOBAL VARIABLE FOR NUMBER OF PICKUPS
        	number_of_pickups = 1;
        
            function submit() {
            	var date = new Date();
                form_data = {
                	'Booking_Date':					date.getFullYear() + '/' + (date.getMonth()+1) + '/' + date.getDate(),
                    'fName':                        document.getElementById('input-fName').value,
                    'sName':                        document.getElementById('input-sName').value,
                    'Tel_No':                       document.getElementById('input-Tel_No').value,
                    'Group':						document.getElementById('dropdown-Group').value,
                    'Address':{
                        'Line1':                    document.getElementById('input-Address_Line1').value,
                        'Line2':                    document.getElementById('input-Address_Line2').value,
                        'Line3':                    document.getElementById('input-Address_Line3').value,
                        'Line4':                    document.getElementById('input-Address_Line4').value,
                        'Line5':                    document.getElementById('input-Address_Line5').value,
                        'Post_Code':                document.getElementById('input-Address_Post_Code').value
                    },
                    'Journey_Description':			document.getElementById('input-Journey_Description').value,
                    'Journey_Date':                	document.getElementById('date-Journey_Date').value,
                    'No_Passengers':       			document.getElementById('number-No_Passengers').value,
                    'Passengers_Note':              document.getElementById('input-Passengers_Note').value,
                    'Wheelchairs':                  document.getElementById('number-Wheelchairs').value,
                    'Transferees':                  document.getElementById('number-Transferees').value,
                    'Other_Access':                 document.getElementById('input-Other_Access').value,
                    'Booked_By': 					document.getElementById('input-Booked_By').value,
                    'Destination':{
						'Line1':					document.getElementById('input-Destination_Line1').value,
						'Line2':					document.getElementById('input-Destination_Line2').value,
						'Line3':					document.getElementById('input-Destination_Line3').value,
						'Line4':					document.getElementById('input-Destination_Line4').value,
						'Line5':					document.getElementById('input-Destination_Line5').value,
						'Post_Code':				document.getElementById('input-Destination_Post_Code').value
					},
					'Pickups':{
						'No_Pickups':				number_of_pickups,
						'1':{
							'Time':					document.getElementById('input-Pickup_1_Time').value,
							'Note':					document.getElementById('input-Pickup_1_Note').value,
							'Address':{
								'Line1':			document.getElementById('input-Pickup_1_Line1').value,
								'Line2':			document.getElementById('input-Pickup_1_Line2').value,
								'Line3':			document.getElementById('input-Pickup_1_Line3').value,
								'Line4':			document.getElementById('input-Pickup_1_Line4').value,
								'Line5':			document.getElementById('input-Pickup_1_Line5').value,
								'Post_Code':		document.getElementById('input-Pickup_1_Post_Code').value
							}
						}
					},
					'Return_Time':					document.getElementById('input-Return_Time').value,
					'Return_Note':					document.getElementById('input-Return_Note').value,
					'Driver':						document.getElementById('dropdown-Driver').value,
					'Vehicle':						document.getElementById('dropdown-Vehicle').value,
					'Keys_To_Collect':				document.getElementById('input-Keys_To_Collect').value,
					'Quote':						document.getElementById('input-Quote').value,
					'Distance_Run':					document.getElementById('input-Distance_Run').value,
					'Invoiced_Cost':				document.getElementById('input-Invoiced_Cost').value,
					'Invoice_Sent':					document.getElementById('date-Invoice_Sent').value,
					'Invoice_Paid':					document.getElementById('date-Invoice_Paid').value,
					'Journey_Notes':				document.getElementById('input-Journey_Notes').value,
                };
                
                
                $.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'addJourney',
                        'form_data': form_data
                    },
                    dataType: "json",
                    success: function(returned_data) {
                    	window.location = 'http://community.dur.ac.uk/zack.hodari/CEP_Project/index.php';
                    }
                });
            }

            var i = 0;

            function next(){
                var pages = ['#page1', '#page2', '#page3'];
                var currentPage = $(pages[i]);
                var nextPage = $(pages[i+1]);

                currentPage.animate({
                    height: "toggle"
                }, 500, function(){
                    currentPage.hide();
                    nextPage.animate({
                        height: "toggle"
                    });  
                });

                i = i + 1;

                if (i == pages.length - 1){
                    $('#nextButton').animate({
                        height : "toggle"
                    }, 250, function(){
                        $('#submitButton').show();
                    }); 
                }
            }

            function cancel(){
                window.location.href = "";
            }

            function startScreen(){
                $('#page2').hide();
                $('#page3').hide();
                $('#submitButton').hide();
                var i = 0;
            }
        	
            function populateGroups(){
            	var dropdown = document.getElementById('dropdown-Group');
            	
                $.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'getGroups'
                    },
                    dataType: "json",
                    success: function(returned_data) {
                    	for(var i = 0; i < returned_data.length; i++) {
                    		var item = document.createElement("option");
                    		item.textContent = returned_data[i]['Name'];
                    		item.value = returned_data[i]['Group_ID'];
                    		dropdown.appendChild(item);
                    	}
                    }
                });
            }
            
            function populateDrivers(){
            	var dropdown = document.getElementById('dropdown-Driver');
            	
                $.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'getDrivers'
                    },
                    dataType: "json",
                    success: function(returned_data) {
                    	for(var i = 0; i < returned_data.length; i++) {
                    		var item = document.createElement("option");
                    		item.textContent = returned_data[i]['fName'] + ' ' + returned_data[i]['sName'] + ' (' + returned_data[i]['Address']['Post_Code'] + ')';
                    		item.value = returned_data[i]['Driver_ID'];
                    		dropdown.appendChild(item);
                    	}
                    }
                });
            }
        	
            function populateVehicles(){
            	var dropdown = document.getElementById('dropdown-Vehicle');
            	
                $.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'getVehicles'
                    },
                    dataType: "json",
                    success: function(returned_data) {
                    	for(var i = 0; i < returned_data.length; i++) {
                    		var item = document.createElement("option");
                    		item.textContent = returned_data[i]['Nickname'] + ' (' + returned_data[i]['Registration'] + ')';
                    		item.value = returned_data[i]['Vehicle_ID'];
                    		dropdown.appendChild(item);
                    	}
                    }
                });
            }
            
            function populateEditFields(Journey_ID) {
            	
                $.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'getJourney',
                        'form_data': {'Journey_ID': Journey_ID}
                    },
                    dataType: "json",
                    success: function(returned_data) {
                		
						document.getElementById('input-fName').value = returned_data['fName'];
						document.getElementById('input-sName').value = returned_data['sName'];
						document.getElementById('input-Tel_No').value = returned_data['Tel_No'];
						document.getElementById('dropdown-Group').value = returned_data['Group_ID']; //CHANGE THIS TO FIND GROUP NAME
						document.getElementById('input-Address_Line1').value = returned_data['Address']['Line1'];
						document.getElementById('input-Address_Line2').value = returned_data['Address']['Line2'];
						document.getElementById('input-Address_Line3').value = returned_data['Address']['Line3'];
						document.getElementById('input-Address_Line4').value = returned_data['Address']['Line4'];
						document.getElementById('input-Address_Line5').value = returned_data['Address']['Line5'];
						document.getElementById('input-Address_Post_Code').value = returned_data['Post_Code'];
						document.getElementById('input-Journey_Description').value = returned_data['Journey_Description'];
						document.getElementById('date-Journey_Date').value = returned_data['Journey_Date'];
						document.getElementById('number-No_Passengers').value = returned_data['No_Passengers'];
						document.getElementById('input-Passengers_Note').value = returned_data['Passengers_Note'];
						document.getElementById('number-Wheelchairs').value = returned_data['Wheelchairs'];
						document.getElementById('number-Transferees').value = returned_data['Transferees'];
						document.getElementById('input-Other_Access').value = returned_data['Other_Access'];
						document.getElementById('input-Booked_By').value = returned_data['Booked_By'];
						document.getElementById('input-Destination_Line1').value = returned_data['Destination']['Line1'];
						document.getElementById('input-Destination_Line2').value = returned_data['Destination']['Line2'];
						document.getElementById('input-Destination_Line3').value = returned_data['Destination']['Line3'];
						document.getElementById('input-Destination_Line4').value = returned_data['Destination']['Line4'];
						document.getElementById('input-Destination_Line5').value = returned_data['Destination']['Line5'];
						document.getElementById('input-Destination_Post_Code').value = returned_data['Destination']['Post_Code'];
												
						document.getElementById('input-Pickup_1_Time').value = returned_data['Pickups'][1]['Time'];
						document.getElementById('input-Pickup_1_Note').value = returned_data['Pickups'][1]['Note'];
						document.getElementById('input-Pickup_1_Line1').value = returned_data['Pickups'][1]['Address']['Line1'];
						document.getElementById('input-Pickup_1_Line2').value = returned_data['Pickups'][1]['Address']['Line2'];
						document.getElementById('input-Pickup_1_Line3').value = returned_data['Pickups'][1]['Address']['Line3'];
						document.getElementById('input-Pickup_1_Line4').value = returned_data['Pickups'][1]['Address']['Line4'];
						document.getElementById('input-Pickup_1_Line5').value = returned_data['Pickups'][1]['Address']['Line5'];
						document.getElementById('input-Pickup_1_Post_Code').value = returned_data['Pickups'][1]['Address']['Post_Code'];
						
// 						number_of_pickups = returned_data['Pickups']['No_Pickups'];
// 						for (var x = 1; x <= number_of_pickups; x++) {
// 							document.getElementById('input-Pickup_' + x + '_Time').value = returned_data['Pickups'][x]['Time'];
// 							document.getElementById('input-Pickup_' + x + '_Note').value = returned_data['Pickups'][x]['Note'];
// 							document.getElementById('input-Pickup_' + x + '_Line1').value = returned_data['Pickups'][x]['Address']['Line1'];
// 							document.getElementById('input-Pickup_' + x + '_Line2').value = returned_data['Pickups'][x]['Address']['Line2'];
// 							document.getElementById('input-Pickup_' + x + '_Line3').value = returned_data['Pickups'][x]['Address']['Line3'];
// 							document.getElementById('input-Pickup_' + x + '_Line4').value = returned_data['Pickups'][x]['Address']['Line4'];
// 							document.getElementById('input-Pickup_' + x + '_Line5').value = returned_data['Pickups'][x]['Address']['Line5'];
// 							document.getElementById('input-Pickup_' + x + '_Post_Code').value = returned_data['Pickups'][x]['Address']['Post_Code'];
// 						}
						
						document.getElementById('input-Return_Time').value = returned_data['Return_Time'];
						document.getElementById('input-Return_Note').value = returned_data['Return_Note'];
						document.getElementById('dropdown-Driver').value = returned_data['Driver'];
						document.getElementById('dropdown-Vehicle').value = returned_data['Vehicle'];
						document.getElementById('input-Keys_To_Collect').value = returned_data['Keys_To_Collect'];
						document.getElementById('input-Quote').value = returned_data['Quote'];
						document.getElementById('input-Distance_Run').value = returned_data['Distance_Run'];
						document.getElementById('input-Invoiced_Cost').value = returned_data['Invoiced_Cost'];
						document.getElementById('date-Invoice_Sent').value = returned_data['Invoice_Sent'];
						document.getElementById('date-Invoice_Paid').value = returned_data['Invoice_Paid'];
						document.getElementById('input-Journey_Notes').value = returned_data['Journey_Notes'];	
                    }
                });
            }
            
            function init(){
				startScreen();
				populateDrivers();
				populateVehicles();
				populateGroups();
				
				var is_edit = '<?php echo $is_edit; ?>';
				if (is_edit == '1') {
					var id = '<?php echo $id; ?>'
					populateEditFields(id);
				}
			}

        </script>
    </head>
    <body onload="init();">
        <div id="wctLogo"></div>
        <?php include 'nav.php' ?>
        <div id="page_wrapper">
            <div id="main">
                <form method="POST" action="">
                <!-- bother with form attribute? -->
					<div id="page1">
						<fieldset id="bookeeDetails">
							<legend>Bookee Details</legend>
							<table>
								<tr><td><label>First Name: </label></td><td><input type="text" id="input-fName"/> <td></tr>
								<tr><td><label>Surname: </label></td><td><input type="text" id="input-sName"/> <td></tr>
								<tr><td><label>Contact Number: </label></td><td><input type="text" id="input-Tel_No"/> </td></tr>
								
    							<tr><td><label>Group: </label></td><td>
								<select id="dropdown-Group"> 
									<option>Choose a Group</option>
								</select><td></tr>
							</table>
						</fieldset>
						<fieldset id="bookeeAddress">
							<legend>Bookee Address</legend>
							<table>
								<tr><td><label>Address line 1: </label></td><td><input type="text" id="input-Address_Line1"/> </td></tr>
								<tr><td><label>Address line 2: </label></td><td><input type="text" id="input-Address_Line2"/> </td></tr>
								<tr><td><label>Address line 3: </label></td><td><input type="text" id="input-Address_Line3"/> </td></tr>
								<tr><td><label>Address line 4: </label></td><td><input type="text" id="input-Address_Line4"/> </td></tr>
								<tr><td><label>Address line 5: </label></td><td><input type="text" id="input-Address_Line5"/> </td></tr>
								<tr><td><label>Postcode: </label></td><td><input type="text" id="input-Address_Post_Code"/> </td></tr>
							</table>
						</fieldset>
					</div>
					<div id="page2">
						<fieldset id="journeyDetails">
							<legend>Booking Details</legend>
                            <table>
                                <tr><td><label>Journey Description: </label></td><td><input type="text" id="input-Journey_Description" placeholder="E.g. WI to Wolsingham Pool"/> <td></tr>
    							<tr><td><label>Date required: </label></td><td><input type="date" id="date-Journey_Date"/> <td></tr>
                                <tr><td><label>No. of passengers: </label></td><td><input type="text" id="number-No_Passengers"/> <td></tr>
                                <tr><td><label>Passenger notes: </label></td><td><input type="text" id="input-Passengers_Note" placeholder="E.g. 5 Children 2 Adults"/> <td></tr>
                                <tr><td><label>No. of wheelchair users: </label></td><td><input type="text" id="number-Wheelchairs"/> <td></tr>
                                <tr><td><label>No. of wheelchair transfers: </label></td><td><input type="text" id="number-Transferees"/> <td></tr>
                                <tr><td><label>Other access needs: </label></td><td><input type="text" id="input-Other_Access"/> <td></tr>
                                <tr><td><label>Booking taken by: </label></td><td><input type="text" id="input-Booked_By"/> <td></tr>
                            </table>
                        </fieldset>
                        <fieldset id="destinationAddress">
                            <legend>Destination Address</legend>
                            <table>
                                <tr><td><label>Address line 1: </label></td><td><input type="text" id="input-Destination_Line1"/> </td></tr>
                                <tr><td><label>Address line 2: </label></td><td><input type="text" id="input-Destination_Line2"/> </td></tr>
                                <tr><td><label>Address line 3: </label></td><td><input type="text" id="input-Destination_Line3"/> </td></tr>
                                <tr><td><label>Address line 4: </label></td><td><input type="text" id="input-Destination_Line4"/> </td></tr>
                                <tr><td><label>Address line 5: </label></td><td><input type="text" id="input-Destination_Line5"/> </td></tr>
                                <tr><td><label>Postcode: </label></td><td><input type="text" id="input-Destination_Post_Code"/> </td></tr>
                            </table>
                        </fieldset>
                        <fieldset id="pickupDetails">
                            <legend>Pickup Address</legend>
                            <table>
                                <tr><td><label>Address line 1: </label></td><td><input type="text" id="input-Pickup_1_Line1"/> </td></tr>
                                <tr><td><label>Address line 2: </label></td><td><input type="text" id="input-Pickup_1_Line2"/> </td></tr>
                                <tr><td><label>Address line 3: </label></td><td><input type="text" id="input-Pickup_1_Line3"/> </td></tr>
                                <tr><td><label>Address line 4: </label></td><td><input type="text" id="input-Pickup_1_Line4"/> </td></tr>
                                <tr><td><label>Address line 5: </label></td><td><input type="text" id="input-Pickup_1_Line5"/> </td></tr>
                                <tr><td><label>Postcode: </label></td><td><input type="text" id="input-Pickup_1_Post_Code"/> </td></tr>
                                <tr><td><label>Pickup Time: </label></td><td><input type="text" id="input-Pickup_1_Time"/> <td></tr>
                                <tr><td><label>Pickup Note: </label></td><td><input type="text" id="input-Pickup_1_Note" placeholder="E.g. Number of people to collect at this locaiton"/> <td></tr>
                            </table>
                        </fieldset>
<!--ADD A NEW PICKUP-->
                        <fieldset id="returnDetails">
                            <legend>Pickup Address</legend>
                            <table>
                                <tr><td><label>Return time: </label></td><td><input type="text" id="input-Return_Time"/> <td></tr>
                                <tr><td><label>Return note: </label></td><td><input type="textarea" id="input-Return_Note" placeholder="List any special requirements"/> <td></tr>
                            </table>
                        </fieldset>
					</div>
					<div id="page3">
						<fieldset id="officeUse">
                            <legend>Other Details</legend>
                            <table>
    							<tr><td><label>Driver: </label></td>
								<td><select id="dropdown-Driver"> 
									<option>Choose a Driver</option>
								</select><td></tr>
    							<tr><td><label>Allocated Vehicle: </label></td>
								<td><select id="dropdown-Vehicle"> 
									<option>Choose a Vehicle</option>
								</select><td></tr>
                                <tr><td><label>Keys to collect: </label></td><td><input type="text" id="input-Keys_To_Collect" placeholder="E.g. Weardale Hub at 8.45am"/> <td></tr>
                                <tr><td><label>Price quoted: </label></td><td><input type="text" id="input-Quote"/> <td></tr>
                                <tr><td><label>Miles/KMs run: </label></td><td><input type="text" id="input-Distance_Run"/> <td></tr>
                                <tr><td><label>Invoiced cost: </label></td><td><input type="text" id="input-Invoiced_Cost"/> <td></tr>
                                <tr><td><label>Invoice sent on: </label></td><td><input type="text" id="date-Invoice_Sent"/> <td></tr>
                                <tr><td><label>Invoice paid on: </label></td><td><input type="text" id="date-Invoice_Paid"/> <td></tr>
                            </table>
                        </fieldset>
                        <fieldset id="notes">
                            <legend>Journey Notes</legend>
                            <input type="textarea" id="input-Journey_Notes" placeholder="Any additional notes"/>
                        </fieldset>
					</div>
                    <input type="text" name="mobility" id="mobility" style='display:none;'/>
                    </br>
                </form>
				<div id="nextButton" onclick="next()">Next</div>
				<div id="submitButton" onclick="submit();">Submit</div>
				<div id="cancelButton" onclick="cancel()">Cancel</div>
				<div id='result'></div> 
            </div>
        </div>
    </body>
</html>