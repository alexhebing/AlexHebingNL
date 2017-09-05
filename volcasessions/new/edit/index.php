
<?php

  error_reporting(E_ALL);
ini_set('display_errors', 1);

include('master.php');

$sessions = $db->listSessions();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['btnNew']))
  {
        $datumTitel = test_input($_POST["naam"]);
        $audioPad = test_input($_POST["audioPad"]);
        $session = new Volcasession();
        $session->fillWithoutId($datumTitel, $audioPad);
        $session->naam = test_input($_POST["naam"]);
        $session->plaatjePad = test_input($_POST["plaatjePad"]);
        $session->boomFactor = test_input($_POST["boomFactor"]);
        $session->tempo = test_input($_POST["tempo"]);

        $db->insertSession($session);
        $sessions = $db->listSessions();
  }

  if (isset($_POST['btnUpdate']))
  {
    $removedSessions = json_decode($_POST["removedSessions"]);

    foreach($removedSessions as $session) {
      $db->deleteSession($session);
    }

    // $updatedSessions = json_decode($_POST["updatedSessions"]);

    // print_r($updatedSessions);

    // foreach($updatedSessions as $updatedSession) {
    //   $db->updateSession($updatedSession);
    // }

    $sessions = $db->listSessions();
  }
}

?>

<div class="imgcontainer">
    <img src="img/planet.jpg" width="100" height="100" alt="Avatar" class="avatar">
  </div>

<form form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  

  <div class="newBubbles">
    <div class="container">

      <h1>Nieuwe sessie toevoegen</h1>

      <label><b>Naam</b></label>
      <input type="text" placeholder="Voer naam in" name="naam">

      <label><b>Audiopad</b></label>
      <input type="text" placeholder="Plak url naar mp3" name="audioPad">

      <label><b>Boomfactor</b></label>
      <input type="text" placeholder="crunchy?" name="boomFactor">

      <label><b>Tempo</b></label>
      <input type="text" placeholder="bpm" name="tempo">

      <label><b>PlaatjePad</b></label>
      <input type="text" placeholder="Plak url naar plaatje" name="plaatjePad">

      <input type="submit" name='btnNew' class="noborder" value="Voeg nieuwe sessie toe" />      
    </div>
  </div>

  <div class="updateBubbles">
    <input type="hidden" name="updatedSessions" id="updatedSessions" data-bind="value: ko.toJSON(sessions)">
    <input type="hidden" id="removedSessions" name="removedSessions">
    
    <div class="container">

      <h1>Verwijder sessies</h1>
      <table>
        <thead><tr>
            <th>DatumTitel</th><th>Naam</th><th>Datum toegevoegd</th>
        </tr></thead>
        <tbody data-bind="foreach: sessions">
          <tr>
              <td><input type="text" data-bind="value: datumTitel"/></td>
              <td><input type="text" data-bind="value: naam"/></td>
              <td><input type="text" data-bind="value: datumToegevoegd" readonly/></td>               
              <td><a href="#" data-bind="click: $root.removeSession">Verwijder</a></td>
          </tr>    
        </tbody>
      </table>
      <input type="submit" name='btnUpdate' class="noborder" value="Voer veranderingen door" onclick="setHiddenFields()" />
    </div>
  </div>

</form>

<script src="scripts/knockout-3.4.2.js"></script>
<script>
 
var removedSessions = [];

function Volcasession(datumTitel, audioPad, tempo) {
  this.datumTitel = datumTitel;
  this.audioPad = audioPad;
  this.tempo(tempo);
}

// Overall viewmodel for this screen, along with initial state
function SessionsViewModel() {
    var self = this;
    self.sessions = ko.observableArray(getSessions());
    self.removeSession = function(session) 
    { 
      self.sessions.remove(session);
      removedSessions.push(session);
    }
}

function setHiddenFields()
{
  document.getElementById("removedSessions").value = JSON.stringify(removedSessions);
}

function getSessions()
{
  //console.log(JSON.parse( '<?php echo json_encode($sessions) ?>' ));
  return JSON.parse( '<?php echo json_encode($sessions) ?>' );
}

ko.applyBindings(new SessionsViewModel());
</script>