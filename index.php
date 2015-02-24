
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
    </head>
    <body onload="loadJourneys()">
        <div id="wctLogo"></div>
        <?php include 'nav.php' ?>
        <script>
			var global_journeys = "";
		
			function buildJourneyString(returned_data) {
				
				var journeys = "[ ";
			
				for(var i = 0; i < returned_data.length; i++) {
					if (returned_data[i]['Type'] == "Group") {

						var colour = "#106500";
						var journey_date = new Date(changeDate(returned_data[i]['Journey_Date']));
						var curDate = new Date();

						if (journey_date < curDate) {
							colour = "#9FC199";
						}

						var journey = "{		title: '" + String(returned_data[i]['Journey_Description']) + "',		start: '" + changeDate(returned_data[i]['Journey_Date']) + "T" + formatTime(returned_data[i]['Pickup_Time']) + "', end: '" + changeDate(returned_data[i]['Journey_Date']) + "T" + formatTime(returned_data[i]['Return_Time']) + "',	url: 'show_group_journey_info.php?id=" + String(returned_data[i]['Journey_ID']) + "', color: '" + colour + "'	}";
						
					}
					else {

						var colour = "#006598";
						var journey_date = new Date(changeDate(returned_data[i]['Journey_Date']));
						var curDate = new Date();

						if (journey_date < curDate) {
							//colour = "#C7E1EF";
							colour = "#B3CAD7";
						}

						var journey = "{		title: '" + String(returned_data[i]['Journey_Description']) + "',		start: '" + changeDate(returned_data[i]['Journey_Date']) + "T" + formatTime(returned_data[i]['Pickup_Time']) + "', end: '" + changeDate(returned_data[i]['Journey_Date']) + "T" + formatTime(returned_data[i]['Return_Time']) + "',	url: 'show_TC_journey_info.php?id=" + String(returned_data[i]['Journey_ID']) + "', color: '" + colour + "'	}";
					}
					//var journey = "{		title: 'WI to Quiz Night',		start: '2015-02-03',		url: 'show_journey_info.php?id=1'	},	{		title: 'Shopping Trip',		start: '2015-02-09T11-00',		end: '2015-02-09T13-00', url: 'show_journey_info.php?id=2'	}";
					journeys += journey;
					if(i < (returned_data.length - 1)) {
						journeys += ", ";
					}
                }

				journeys += " ]";
				var newEvents = journeys;
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
					editable: false,
					eventLimit: true, // allow "more" link when too many events
					events: jsoEvents
				});
				
			}
			
			function changeDate(date_string) {			
				date_string = date_string.replace(/\//g, "-");				
				return date_string.split("-").reverse().join("-");	
			}

			function formatTime(time_string) {
				time_string = time_string.replace(/:/g, "-");
				return time_string.substr(0,time_string.length - 3);
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
                        buildJourneyString(returned_data);						
                    }
                });				
			}		
		</script>
		
        <div id="main">
        	<div id='cTitle'><br>Journey Overview</div>
			<div id='calendar'></div>
        </div>
    </body>
</html>