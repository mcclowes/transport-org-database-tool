
<html>
    <head>
        <title>WCT Tool</title>
        <link rel="icon" type="image/png" href="./img/wct_icon.png">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        
        <script type="text/javascript">
        
            function submit(){
                window.location = 'show_driver_info.php?id=' + document.getElementById('dropdown-Drivers').value;
            }
            
            function populateDrivers(){
                var dropdown = document.getElementById('dropdown-Drivers');
                
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
                            item.textContent = returned_data[i]['fName'] + ' ' + returned_data[i]['sName'];
                            item.value = returned_data[i]['Driver_ID'];
                            dropdown.appendChild(item);
                        }
                    }
                });
            }
        </script>
    </head>
    <body onload='populateDrivers()'>
        <div id="wctLogo"></div>
        <?php include 'nav.php' ?>
        <div id="main">
            <div>
                <tr><td><label>Choose a driver: </label></td><td>
                <select id="dropdown-Drivers" name='Driver_ID'>
                </select><td></tr>
            </div>
            <br>
            <div>
            <input type="submit" id="submitButton" name="submit" value="Submit" onclick='submit()' />
            </div>
        </div>
    </body>
</html>