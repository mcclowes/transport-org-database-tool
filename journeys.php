
<html>
    <head>
        <title>WCT Tool</title>
        <link rel="icon" type="image/png" href="./img/wct_icon.png">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        
        
        <script type="text/javascript">
        
        	function submit(){
        		
        		add_journey.php
        	
                $.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'getJourney',
                        'form_data': form_data
                    },
                    dataType: "json",
                    success: function(returned_data) {
                        $('#result').replaceWith('<div id="result">'+returned_data+'</div>');
                    }
                });
            }
            
            function populateJourneys(){
            	var dropdown = document.getElementById('dropdown-Journeys');
            	
                $.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'getJourneys'
                    },
                    dataType: "json",
                    success: function(returned_data) {
                    	for(var i = 0; i < returned_data.length; i++) {
                    		var item = document.createElement("option");
                    		item.textContent = returned_data[i]['Journey_Description'] + ' (' + returned_data[i]['Journey_Date'] + ')';
                    		item.value = returned_data[i]['Journey_ID'];
                    		dropdown.appendChild(item);
                    	}
                    }
                });
            }

        </script>
        
    </head>
<<<<<<< HEAD
    <body onload='populateJourneys()'>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="journeys.html">Journeys</a>
                    <ul>
                        <li><a href="journeys.php">Manage Journeys</a></li>
                        <li><a href="add_journey.php">Add Journey</a></li>
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
=======
    <body>
        <?php include 'nav.php' ?>
>>>>>>> FETCH_HEAD
        <div id="main">
        	<div>
        	<form method='POST' action='add_journey.php'>
				<tr><td><label>Journeys: </label></td><td>
				<select id="dropdown-Journeys" name='Journey_ID'> 
					<option>Choose a Journey</option>
				</select><td></tr>
				</div>
				<input type="submit" name="submit" value="Submit" />
			</form>
        </div>
    </body>
</html>