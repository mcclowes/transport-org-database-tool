
<html>
    <head>
        <title>WCT Tool</title>
        <link rel="icon" type="image/png" href="./img/wct_icon.png">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="table_sorter_api/themes/blue/style.css" type="text/css" media="screen" />
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="table_sorter_api/jquery.tablesorter.js"></script> 
		<script type="text/javascript" src="table_sorter_api/jquery.tablesorter.widgets.js"></script>
        
        <script type="text/javascript">

            function submit(id){
                window.location = 'show_vehicle_info.php?id=' + id;
            }
            
            function populateVehicles(){
                $.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'getVehicles'
                    },
                    dataType: "json",
                    success: function(returned_data) {
                    	var vehicle_table = document.getElementById('vehicle_body');
                        for(var i = 0; i < returned_data.length; i++) {
							var id = returned_data[i]['Vehicle_ID'];
							
							var row = vehicle_table.insertRow();
							row.id = ('Vehicle_ID_' + id);

 							var button = row.insertCell();
 							button.innerHTML = '<div class="button" id="view-Vehicle_' + id + '" onclick="submit(' + id + ')">View</div>';
							
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['Nickname'];
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['Registration'];
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['Make'];
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['Model'];
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['Colour'];
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['Capacity_Passengers'];
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['Seating_Configurations'];
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['Section_19_No'];
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['Section_19_Due'];
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['Tax_Due'];
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['MOT_Due'];
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['Inspection_Due'];
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['Service_Due'];
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['Tail_Service_Due'];
                        }
                        $("table").tablesorter(); 
                        $("table").trigger("update"); 
                    }
                });
            }
            
        </script>
    </head>
    <body onload="populateVehicles()">
        <div id="wctLogo"></div>
        <?php include 'nav.php' ?>
        <div id="main">
            <div>
            	<table cellspacing="1" class="tablesorter">
            		<thead>
						<tr>
							<th></th>
							<th>Nickname</th>
							<th>Registration</th>
							<th>Make</th>
							<th>Model</th>
							<th>Colour</th>
							<th>Capacity</th>
							<th>Seating Configurations</th>
							<th>Section 19 Number</th>
							<th>Section 19 due</th>
							<th>Tax due</th>
							<th>MOT due</th>
							<th>Inspection due</th>
							<th>Service due</th>
							<th>Tail Lift service due</th>
						</tr>
					</thead>
					<tbody id='vehicle_body'>
					</tbody>
				</table>
            </div>
        	<br>
        </div>
    </body>
</html>