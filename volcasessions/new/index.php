<?php
	error_reporting(E_ALL);
ini_set('display_errors', 1);


	include('edit/databaseHelper.php');
	$db = new dataBaseContext();
    $sessions = $db->listSessions();
?>

<html>
<head>
<title>Apparatus Rex</title>
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
	<script src="scripts/jquery-3.1.1.js"></script>
</head>

<body>

<div id="menu">
	<script>
		$('#menu').load('menu.html');
	</script>
</div>

<div class="content">
	<table id="myTable">
        <thead><tr>
            <th>Sessions</th><th>Tempo</th><th>Boomfactor</th>
        </tr></thead>
        <tbody data-bind="foreach: sessions">
          <tr>
              <td>
              	<div class="tablecontent">              	
	              	<img data-bind="attr: { 'src': plaatjePad }" width="120" heigth="120">
	              	<div class="audioTitle">
		              	<span data-bind="text: naam"></span>
		              	<audio controls>
						  <source data-bind="attr: { 'src': audioPad }" type="audio/mpeg">
						  Your browser does not support the audio tag.
						</audio>
					</div>
				</div>
              </td>
              <td>
              	<span data-bind="text: tempo"></span>
              </td>
              <td>
              	<span data-bind="text: boomFactor"></span>
              </td>
          </tr>    
        </tbody>
      </table>
</div>
</body>
<script src="edit/scripts/knockout-3.4.2.js"></script>
<script src="scripts/jquery.dataTables.js"></script>
<script>

// Overall viewmodel for this screen, along with initial state
function SessionsViewModel() {
    var self = this;
    self.sessions = ko.observableArray(getSessions());
    console.log("view model init");
}

function getSessions()
{
  console.log(JSON.parse( '<?php echo json_encode($sessions) ?>' ));
  return JSON.parse( '<?php echo json_encode($sessions) ?>' );
}

ko.applyBindings(new SessionsViewModel());

$(document).ready(function(){
    $('#myTable').DataTable({
    	"paging": false,
    	"searching": false,
    	"info": false
    });
});

</script>