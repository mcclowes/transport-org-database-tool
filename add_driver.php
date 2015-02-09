
<html>
    <head>
        <title>WCT Tool | Add Driver</title>
        <link rel="icon" type="image/png" href="./img/wct_icon.png">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <script type="text/javascript">
            function submit(form_type) {
                form_data = {
                    'fName':                        document.getElementById('input-fName').value,
                    'sName':                        document.getElementById('input-sName').value,
                    'Address':{
                        'Line1':                    document.getElementById('input-Line1').value,
                        'Line2':                    document.getElementById('input-Line2').value,
                        'Line3':                    document.getElementById('input-Line3').value,
                        'Line4':                    document.getElementById('input-Line4').value,
                        'Line5':                    document.getElementById('input-Line5').value,
                        'Post_Code':                document.getElementById('input-Post_Code').value
                    },
                    'Tel_No':                       document.getElementById('input-Tel_No').value,
                    'Emergency_Name':               document.getElementById('input-Emergency_Name').value,
                    'Emergency_Tel':                document.getElementById('input-Emergency_Tel').value,
                    'Emergency_Relationship':       document.getElementById('input-Emergency_Relationship').value,
                    'DOB':                          document.getElementById('date-DOB').value,
                    'Details_Wheelchair':           document.getElementById('dropdown-Details_Wheelchair').value,
                    'Details_Wheelchair_Type':      document.getElementById('dropdown-Details_Wheelchair_Type').value,
                    'Details_Wheelchair_Seat':      document.getElementById('dropdown-Details_Wheelchair_Seat').value,
                    'Details_Scooter':              document.getElementById('dropdown-Details_Scooter').value,
                    'Details_Mobility_Aid':         document.getElementById('dropdown-Details_Mobility_Aid').value,
                    'Details_Shopping_Trolley':     document.getElementById('dropdown-Details_Shopping_Trolley').value,
                    'Details_Guide_Dog':            document.getElementById('dropdown-Details_Guide_Dog').value,
                    'Details_People_Carrier':       document.getElementById('dropdown-Details_People_Carrier').value,
                    'Details_Assistant':            document.getElementById('dropdown-Details_Assistant').value,
                    'Details_Travelcard':           document.getElementById('dropdown-Details_Travelcard').value,
                    'Reasons_Transport':            document.getElementById('boolean-Reasons_Transport').checked,
                    'Reasons_Bus_Stop':             document.getElementById('boolean-Reasons_Bus_Stop').checked,
                    'Reasons_Anxiety':              document.getElementById('boolean-Reasons_Anxiety').checked,
                    'Reasons_Door':                 document.getElementById('boolean-Reasons_Door').checked,
                    'Reasons_Handrails':            document.getElementById('boolean-Reasons_Handrails').checked,
                    'Reasons_Lift':                 document.getElementById('boolean-Reasons_Lift').checked,
                    'Reasons_Level_Floors':         document.getElementById('boolean-Reasons_Level_Floors').checked,
                    'Reasons_Low_Steps':            document.getElementById('boolean-Reasons_Low_Steps').checked,
                    'Reasons_Assistance':           document.getElementById('boolean-Reasons_Assistance').checked,
                    'Reasons_Board_Time':           document.getElementById('boolean-Reasons_Board_Time').checked,
                    'Reasons_Wheelchair_Access':    document.getElementById('boolean-Reasons_Wheelchair_Access').checked,
                    'Reasons_Other':                document.getElementById('input-Reasons_Other').value
                };
                
                $.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': form_type,
                        'form_data': form_data
                    },
                    dataType: "json",
                    success: function(returned_data) {
                        $('#result').replaceWith('<div id="result">'+returned_data+'</div>');
                        window.location = "http://www.google.com/"
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

        </script>
    </head>
    <body onload="startScreen()">
        <div id="wctLogo"></div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="journeys.html">Journeys</a>
                    <ul>
                        <li><a href="manage_journeys.php">Manage Journeys</a></li>
                        <li><a href="add_journey.php">Add Journeys</a></li>
                    </ul>
                </li>
                <li><a href="groups.html">Groups</a>
                    <ul>
                        <li><a href="manage_groups.php">Manage Groups</a></li>
                        <li><a href="add_group.php">Add group</a></li>
                    </ul>
                </li>
                <li><a href="members.html">Members</a>
                    <ul>
                        <li><a href="manage_members.php">Manage Members</a></li>
                        <li><a href="add_member.php">Add Member</a></li>
                    </ul>
                </li>
                <li><a href="vehicles.html">Vehicles</a>
                    <ul>
                        <li><a href="manage_vehicles.php">Manage Vehicles</a></li>
                        <li><a href="add_vehicle.php">Add vehicle</a></li>
                    </ul>
                </li>
                <li><a href="drivers.html">Drivers</a>
                    <ul>
                        <li><a href="manage_drivers.php">Manage Drivers</a></li>
                        <li><a href="add_driver.php">Add Driver</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="page_wrapper">
            <div id="main">
                <form method="POST" action="">
                <!-- bother with for attribute? -->
					<div id="page1">
						<fieldset id="personalDetails">
							<legend>Personal Details</legend>
							<table>
								<tr><td><label>First Name: </label></td><td><input type="text" id="input-fName"/> <td></tr>
								<tr><td><label>Surname: </label></td><td><input type="text" id="input-sName"/> <td></tr>
								<tr><td><label>Date of Birth: </label></td><td><input type="date" id="date-DOB"/> <td></tr>
								<tr><td><label>Contact Number: </label></td><td><input type="text" id="input-Tel_No"/> </td></tr>
							</table>
						</fieldset>
						<fieldset id="personalAddress">
							<legend>Address</legend>
							<table>
								<tr><td><label>Address line 1: </label></td><td><input type="text" id="input-Line1"/> </td></tr>
								<tr><td><label>Address line 2: </label></td><td><input type="text" id="input-Line2"/> </td></tr>
								<tr><td><label>Address line 3: </label></td><td><input type="text" id="input-Line3"/> </td></tr>
								<tr><td><label>Address line 4: </label></td><td><input type="text" id="input-Line4"/> </td></tr>
								<tr><td><label>Address line 5: </label></td><td><input type="text" id="input-Line5"/> </td></tr>
								<tr><td><label>Postcode: </label></td><td><input type="text" id="input-Post_Code"/> </td></tr>
							</table>
						</fieldset>
						<fieldset id="emergencyContact">
							<legend>Emergency Contact</legend>
							<table>
								<tr><td><label>Emergency Contact Name: </label></td><td><input type="text" id="input-Emergency_Name"/></td></tr>
								<tr><td><label>Emergency Contact Number: </label></td><td><input type="text" id="input-Emergency_Tel"/></td></tr>
								<tr><td><label>Emergency Contact Relationship:</label></td><td><input type="text" id="input-Emergency_Relationship"/></td></tr>
							</table>
						</fieldset>
					</div>
					<div id="page2">
						<fieldset id="personalDetails">
                        licence expiry date, points on licence, DBS No., DBS issue date, emergency contact details and photo
                            <legend>Driving License Details</legend>
                            <table>
                                <tr><td><label>License Number: </label></td><td><input type="text" id="input-fName"/> <td></tr>
                                <tr><td><label>Expiry Date: </label></td><td><input type="date" id="input-sName"/> <td></tr>
                                <tr><td><label>Points on license: </label></td><td><input type="text" id="date-DOB"/> <td></tr>
                                <tr><td><label>DBS Number: </label></td><td><input type="text" id="input-Tel_No"/> </td></tr>
                                <tr><td><label>DBS Issue Date: </label></td><td><input type="date" id="input-Tel_No"/> </td></tr>
                            </table>
                        </fieldset>
					</div>
					<div id="page3">
						<fieldset id="serviceReasons">
							<legend>Photo Upload</legend>
							<tr><td><label>Select File: </label></td><td><input type="file" id="input-fName"/> <td></tr>
						</fieldset>
					</div>
                    <input type="text" name="mobility" id="mobility" style='display:none;'/>
                    </br>
                </form>
				<div id="nextButton" onclick="next()">Next</div>
				<div id="submitButton" onclick="submit('addTcMember');">Submit</div>
				<div id="cancelButton" onclick="cancel()">Cancel</div>
				<div id='result'></div> 
            </div>
        </div>
    </body>
</html>