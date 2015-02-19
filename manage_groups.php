
<html>
    <head>
        <title>WCT Tool</title>
        <link rel="icon" type="image/png" href="./img/wct_icon.png">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        
        <script type="text/javascript">
        
            function submit(){
                window.location = 'show_group_info.php?id=' + document.getElementById('dropdown-Groups').value;
            }
            
            function populateGroups(){
                var dropdown = document.getElementById('dropdown-Groups');
                
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
                            item.textContent = returned_data[i]['Name'] + ' ' + returned_data[i]['Tel'];
                            item.value = returned_data[i]['Group_ID'];
                            dropdown.appendChild(item);
                        }
                    }
                });
            }
        </script>
    </head>
    <body onload='populateGroups()'>
        <div id="wctLogo"></div>
        <?php include 'nav.php' ?>
        <div id="main">
            <div>
                <tr><td><label>Choose a Group: </label></td><td>
                <select id="dropdown-Groups" name='Group_ID'>
                </select><td></tr>
            </div>
            <br>
            <div>
            <input type="submit" id="submitButton" name="submit" value="Submit" onclick='submit()' />
            </div>
        </div>
    </body>
</html>