
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
				var colours = ["#F44336", "#2196F3", "#4CAF50", "#FFEB3B", "#FF9800", "#9C27B0", "#009688", "#8BC34A", "#E91E63", "#00BCD4","#795548", "#FFC107", "#3F51B5","#CDDC39", "#BD5158", "#040C41", "#915C0C", "#ED6F83", "#BB4F11", "#148674"];
				var j = -1;
				var ids = [];
				var cols = [];

				var colour = "#F44336";
			
				for(var i = 0; i < returned_data.length; i++) {

					var isIn = $.inArray(returned_data[i]['Vehicle_ID'], ids);

					if(isIn == -1){						
						j = j + 1;
						colour = colours[j];
						ids.push(returned_data[i]['Vehicle_ID']);
						cols.push(colour);
						$("#checkboxCont").append( "<input type='checkbox' onclick ='updateCalendar()' name='vehicle_" + returned_data[i]['Vehicle_ID'] + "' value='" + returned_data[i]['Vehicle_ID'] + "' checked>   " + "<div class='color-box' style='background-color: " + colour + ";'>  " + returned_data[i]['Vehicle_Name'] + "</div>" + "<br><br>" );
					} else {
						var ind = ids.indexOf(returned_data[i]['Vehicle_ID']);
						colour = cols[ind];
					}

					if (returned_data[i]['Type'] == "Group") {

						var journey = "{		title: '" + String(returned_data[i]['Journey_Description']) + "',		start: '" + changeDate(returned_data[i]['Journey_Date']) + "T" + formatTime(returned_data[i]['Pickup_Time']) + "', end: '" + changeDate(returned_data[i]['Journey_Date']) + "T" + formatTime(returned_data[i]['Return_Time']) + "',	url: 'show_group_journey_info.php?id=" + String(returned_data[i]['Journey_ID']) + "', className: 'v" + String(returned_data[i]['Vehicle_ID']) + "', color: '" + colour + "'	}";
						
					}
					else {						

						var journey = "{		title: '" + String(returned_data[i]['Journey_Description']) + "',		start: '" + changeDate(returned_data[i]['Journey_Date']) + "T" + formatTime(returned_data[i]['Pickup_Time']) + "', end: '" + changeDate(returned_data[i]['Journey_Date']) + "T" + formatTime(returned_data[i]['Return_Time']) + "',	url: 'show_TC_journey_info.php?id=" + String(returned_data[i]['Journey_ID']) + "', className: 'v" + String(returned_data[i]['Vehicle_ID']) + "', color: '" + colour + "'	}";
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
				
				$('#vcalendar').fullCalendar({
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

			function updateCalendar(){
				$('#vcalendar').fullCalendar('refetchEvents');
				
				$("#checkboxCont input[type=checkbox]").each(function()
     			{
     				if($(this).prop('checked') == false){
     					$('.v' + $(this).val() + '').hide();     					
     				}
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
		
        <div id="vmain">
        	<div id='main'>
				<div id='vcalendar' onclick="updateCalendar()"></div>
				<div id ='checkboxCont'></div>
			</div>
        </div>
    </body>
</html>