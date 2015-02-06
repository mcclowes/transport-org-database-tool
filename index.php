
<html>
    <head>
        <title>WCT Tool | Home</title>
        <link rel="icon" type="image/png" href="./img/wct_icon.png">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<link href='css/fullcalendar.css' rel='stylesheet' />
		<link href='css/fullcalendar.print.css' rel='stylesheet' media='print' />
		<script src='calendar_api/lib/moment.min.js'></script>
		<script src='calendar_api/lib/jquery.min.js'></script>
		<script src='calendar_api/fullcalendar.min.js'></script>
		<script>

			$(document).ready(function() {
			
				var newEvents = loadEvents();
				var jsoEvents = eval(newEvents);
			
				var today = new Date();
				var dd = today.getDate();
				var mm = today.getMonth()+1; //January is 0!
				var yyyy = today.getFullYear();

				if(dd<10) {
					dd='0'+dd
				} 

				if(mm<10) {
					mm='0'+mm
				} 

				today = yyyy+'-'+mm+'-'+dd;
				
				$('#calendar').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay'
					},
					defaultDate: today,
					editable: true,
					eventLimit: true, // allow "more" link when too many events
					events: jsoEvents
				});
				
			});

		</script>
    </head>
    <body onload="loadJourneys()">
        <div id="wctLogo"></div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="journeys.html">Journeys</a>
                    <ul>
                        <li><a href="manage_journeys.php">Manage Journeys</a></li>
                        <li><a href="add_journeys.php">Add Journeys</a></li>
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
        <div id="main">
            Insert content here
        </div>
		<script>
	
			//Need to get stuff from database!
			function loadEvents() {		
				return "[	{		title: 'WI to Quiz Night',		start: '2015-02-03',		url: 'showJourneyInfo.php'	},	{		title: 'Shopping Trip',		start: '2015-02-09T11-00',		end: '2015-02-09T13-00', url: 'showJourneyInfo.php'	}]";	
			}
			
			function loadJourneys() {
			
				$.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'getJourneys'
                    },
                    dataType: "json",
                    success: function(returned_data) {
                        alert(JSON.stringify(returned_data));
                    }
                });
			
			}
			
			
		
		</script>
	<div id='cTitle'><br><br>Journey Overview</div>
	<div id='calendar'></div>
    </body>
</html>