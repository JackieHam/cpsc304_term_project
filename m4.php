<?php
// The preceding tag tells the web server to parse the following text as PHP
// rather than HTML (the default)

// The following 3 lines allow PHP errors to be displayed along with the page
// content. Delete or comment out this block when it's no longer needed.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set some parameters

// Database access configuration
$config["dbuser"] = "ora_taas2002";			// change "cwl" to your own CWL
$config["dbpassword"] = "a97993992";	// change to 'a' + your student number
$config["dbserver"] = "dbhost.students.cs.ubc.ca:1522/stu";
$db_conn = NULL;	// login credentials are used in connectToDB()

$success = true;	// keep track of errors so page redirects only if there are no errors

$show_debug_alert_messages = false; // show which methods are being triggered (see debugAlertMessage())

// The next tag tells the web server to stop parsing the text as PHP. Use the
// pair of tags wherever the content switches to PHP
?>

<html>

<head>
	<title>Group 72 M4, M5</title>
</head>

<body>
	<h2>Reset All Tables</h2>
	<p>If you wish to reset the table press on the reset button. If this is the first time you're running this page, you MUST use reset</p>

	<form method="POST" action="m4.php">
		<!-- "action" specifies the file or page that will receive the form data for processing. As with this example, it can be this same file. -->
		<input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
		<p><input type="submit" value="Reset" name="reset"></p>
	</form>

	<hr />

	<h2>Insert New Player Info</h2>
	<form method="POST" action="m4.php">
		<input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
		Player ID: <input type="text" name="insPID"> <br /><br />
		Record ID: <input type="text" name="insRID"> <br /><br />
		NPC ID: <input type="text" name="insNID"> <br /><br />
		Player Name: <input type="text" name="insPlayerName"> <br /><br />
		Player Region: <input type="text" name="insplayerRegion"> <br /><br />
		Player Join Date: <input type="date" name="insJoinDate"> <br /><br />
		In Game Hour: <input type="number" name="insInGameHour"> <br /><br />
		Ally formation Date: <input type="date" name="insFormDate"> <br /><br />
		Number of Missions: <input type="number" name="insNumMissions"> <br /><br />
		<input type="submit" value="Insert" name="insertSubmit"></p>
	</form>

	<hr />

	<h2>Delete Player Info</h2>
        <p> Remove a record from the database </p>
        <form method="POST" action="m4.php"> <!--refresh page when submitted-->
            <input type="hidden" id="deleteQueryRequest" name="deleteQueryRequest">
            Record ID: <input type="text" name="delRID"> <br /><br />
            <input type="submit" value="Delete" name="deleteSubmit"></p>
        </form>
    <hr />

	<!-- <h2>Update Name in Player_Info</h2>
	<p>The values are case sensitive and if you enter in the wrong case, the update statement will not do anything.</p>

	<form method="POST" action="oracle-test.php">
		<input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
		Old Name: <input type="text" name="oldName"> <br /><br />
		New Name: <input type="text" name="newName"> <br /><br />

		<input type="submit" value="Update" name="updateSubmit"></p>
	</form>

	<hr /> -->

	<h2>Count the Tuples in Player Info</h2>
	<form method="GET" action="m4.php">
		<input type="hidden" id="countTupleRequest" name="countTupleRequest">
		<input type="submit" name="countTuples"></p>
	</form>

	<hr />

	<h2>Display Tuples in Player Info</h2>
	<form method="GET" action="m4.php">
		<input type="hidden" id="displayTuplesRequest" name="displayTuplesRequest">
		<input type="submit" name="displayTuples"></p>
	</form>

	<hr />

<!-- View All Tuples in Player_Record2 Table -->
	<h2>Display All Records in Player Record</h2>
	<form method="GET" action="m4.php">
		<input type="hidden" id="displayrecordRequest" name="displayrecordRequest">
		<input type="submit" name="displayrecord"></p>
	</form>

<!-- Join Player_Info, Player_Record2-->
	<h2>Display Player Info and Player Record of Players Satisfying Criteria</h2>
	<form method="GET" action="m4.php">
		<input type="hidden" id="joinRequest" name="joinRequest">
		Total Points >= <input type="integer" name="minPoint"> <br /><br />
		<input type="submit" name="join"></p>
	</form>

	<hr />

<!-- View All Tuples in Mission Table -->
	<h2>Display All Records in Mission</h2>
	<form method="GET" action="m4.php">
		<input type="hidden" id="displaymissionRequest" name="displaymissionRequest">
		<input type="submit" name="displaymission"></p>
	</form>

	<hr />

<!-- Nested Aggregation on Mission2 -->
	<h2>Compute Maximum Average Time (Minutes) Spent on Each Mission Grouped by Record ID</h2>
	<form method="GET" action="m4.php">
		<input type="hidden" id="nestedAggRequest" name="nestedAggRequest">
		<input type="submit" name="nestedAgg"></p>
	</form>

	<hr />

<!-- Division on Player_Record2 and Mission2-->
	<h2>Find Record IDs of Records that Track All Missions</h2>
	<form method="GET" action="m4.php">
		<input type="hidden" id="divisionRequest" name="divisionRequest">
		<input type="submit" name="division"></p>
	</form>

	<hr />

	<?php
	// The following code will be parsed as PHP

	function debugAlertMessage($message)
	{
		global $show_debug_alert_messages;

		if ($show_debug_alert_messages) {
			echo "<script type='text/javascript'>alert('" . $message . "');</script>";
		}
	}

	// return value?
	function executeSQLScript($path)
	{
		global $db_conn, $success;
		$commands = file_get_contents($path);
		$commands = explode(";", $commands);

		foreach ($commands as $command) {
			$command = trim($command);
			$statement = oci_parse($db_conn, $command);
			if (!$statement) {
				echo "<br>Cannot parse the following command: " . $command . "<br>";
				$e = OCI_Error($db_conn); // For oci_parse errors pass the connection handle
				echo htmlentities($e['message']);
				$success = False;
			}
			$r = oci_execute($statement, OCI_DEFAULT);
			if (!$r) {
				echo "<br>Cannot execute the following command: " . $command . "<br>";
				$e = oci_error($statement); // For oci_execute errors pass the statementhandle
				echo htmlentities($e['message']);
				$success = False;
			}
		}
	}


	function executePlainSQL($cmdstr)
	{ //takes a plain (no bound variables) SQL command and executes it
		//echo "<br>running ".$cmdstr."<br>";
		global $db_conn, $success;

		$statement = oci_parse($db_conn, $cmdstr);
		//There are a set of comments at the end of the file that describe some of the OCI specific functions and how they work

		if (!$statement) {
			echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
			$e = OCI_Error($db_conn); // For oci_parse errors pass the connection handle
			echo htmlentities($e['message']);
			$success = False;
		}

		$r = oci_execute($statement, OCI_DEFAULT);
		if (!$r) {
			echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
			$e = oci_error($statement); // For oci_execute errors pass the statementhandle
			echo htmlentities($e['message']);
			$success = False;
		}

		return $statement;
	}

	function executeBoundSQL($cmdstr, $list)
	{
		/* Sometimes the same statement will be executed several times with different values for the variables involved in the query.
		In this case you don't need to create the statement several times. Bound variables cause a statement to only be
		parsed once and you can reuse the statement. This is also very useful in protecting against SQL injection.
		See the sample code below for how this function is used */

		global $db_conn, $success;
		$statement = oci_parse($db_conn, $cmdstr);

		if (!$statement) {
			echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
			$e = OCI_Error($db_conn);
			echo htmlentities($e['message']);
			$success = False;
		}

		foreach ($list as $tuple) {
			foreach ($tuple as $bind => $val) {
				//echo $val;
				//echo "<br>".$bind."<br>";
				oci_bind_by_name($statement, $bind, $val);
				unset($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
			}

			$r = oci_execute($statement, OCI_DEFAULT);
			if (!$r) {
				echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
				$e = OCI_Error($statement); // For oci_execute errors, pass the statementhandle
				echo htmlentities($e['message']);
				echo "<br>";
				$success = False;
			}
		}
	}

	function printResult($result)
	{ //prints results from a select statement
		echo "<br>Retrieved data from table Player Info:<br>";
		echo "<table>";
		echo "<tr><th>Player ID</th><th>Record ID</th><th>NPC ID</th><th>Player Name</th><th>Region</th><th>Join Date</th><th>In Game Hour</th><th>Ally Form Date</th><th>Number of Missions</th></tr>";

		while ($row = OCI_Fetch_Array($result, OCI_ASSOC)) {
			echo "<tr><td>" . $row["PID"] . "</td><td>" . $row["RID"] . "</td><td>" . $row["NID"] . "</td><td>" . $row['PLAYERNAME'] . "</td><td>" . $row["REGION"] . "</td><td>" . $row["JOINDATE"] . "</td><td>" . $row["INGAMEHOUR"] . "</td><td>" . $row["FORMDATE"] . "</td><td>" . $row["NUMMISSIONS"] . "</td></tr>"; //or just use "echo $row[0]"
		}

		echo "</table>";
	}

	function connectToDB()
	{
		global $db_conn;
		global $config;

		// Your username is ora_(CWL_ID) and the password is a(student number). For example,
		// ora_platypus is the username and a12345678 is the password.
		// $db_conn = oci_connect("ora_cwl", "a12345678", "dbhost.students.cs.ubc.ca:1522/stu");
		$db_conn = oci_connect($config["dbuser"], $config["dbpassword"], $config["dbserver"]);

		if ($db_conn) {
			debugAlertMessage("Database is Connected");
			return true;
		} else {
			debugAlertMessage("Cannot connect to Database");
			$e = OCI_Error(); // For oci_connect errors pass no handle
			echo htmlentities($e['message']);
			return false;
		}
	}

	function disconnectFromDB()
	{
		global $db_conn;

		debugAlertMessage("Disconnect from Database");
		oci_close($db_conn);
	}


	// function handleUpdateRequest()
	// {
	// 	global $db_conn;

	// 	$old_name = $_POST['oldName'];
	// 	$new_name = $_POST['newName'];

	// 	// you need the wrap the old name and new name values with single quotations
	// 	executePlainSQL("UPDATE Player_Info SET name='" . $new_name . "' WHERE name='" . $old_name . "'");
	// 	oci_commit($db_conn);
	// }

	function handleResetRequest()
	{
		global $db_conn;
		// Drop old table
		executeSQLScript("m4_drop.sql");

		// Create new table
		echo "<br> creating new tables <br>";
		executeSQLScript("m4_create.sql");
		oci_commit($db_conn);

		// Insert values
		echo "<br> inserting values into tables <br>";
		executeSQLScript("m4_insert.sql");
		oci_commit($db_conn);
	}

	function handleInsertRequest()
	{
		global $db_conn, $success;

		//Getting the values from user and insert data into the table
		$insPID = $_POST['insPID'];
		$insRID = $_POST['insRID'];
		$insNID = $_POST['insNID'];
		$joinDate = new DateTime($_POST['insJoinDate']);
		$formDate = new DateTime($_POST['insFormDate']);
		$today = new DateTime();


		if (!$insPID || !$insRID || !$insNID) {
			echo "<script type='text/javascript'>alert('Player ID, Record ID and NPC ID cannot be empty, please input a value!');</script>";
			$success = False;
			return;
		}

		$resultPID = executePlainSQL("SELECT Count(*) FROM Player_Info WHERE PID = '$insPID'");

		if (($row = oci_fetch_row($resultPID)) != false && $row[0] > 0) {
			echo "<script type='text/javascript'>alert('Player ID \"$insPID\" already exists, and you cannot create duplicated records.');</script>";
			$success = False;
			return;
		}

		$resultRID1 = executePlainSQL ("SELECT Count(*) FROM Player_Record2 WHERE RID = '$insRID'");
		$resultRID2 = executePlainSQL ("SELECT Count(*) FROM Player_Info WHERE RID = '$insRID'");
		if (($row = oci_fetch_row($resultRID1)) != false && $row[0] == 0) {
			echo "<script type='text/javascript'>alert('Record ID \"$insRID\" does not exist yet, pleasae create corresponding record in Player Record table 2 first.');</script>";
			$success = False;
			return;
		} else if (($row = oci_fetch_row($resultRID2)) != false && $row[0] > 0) {
			echo "<script type='text/javascript'>alert('Player Info with Record ID \"$insRID\" already exists, and you cannot create duplicated records.');</script>";
			$success = False;
			return;
		}

		$resultNID1 = executePlainSQL ("SELECT Count(*) FROM NPC_Ally2 WHERE NID = '$insNID'");
		$resultNID2 = executePlainSQL ("SELECT Count(*) FROM Player_Info WHERE NID = '$insNID'");

		if (($row = oci_fetch_row($resultNID1)) != false && $row[0] == 0) {
			echo "<script type='text/javascript'>alert('NPC ID \"$insNID\" does not exist yet, pleasae create corresponding record in NPC table 2 first.');</script>";
			$success = False;
			return;
		} else if (($row = oci_fetch_row($resultNID2)) != false && $row[0] > 0) {
			echo "<script type='text/javascript'>alert('Player Info with NPC ID \"$insNID\" already exists, and you cannot create duplicated records.');</script>";
			$success = False;
			return;
		}

		if ($joinDate > $today || $formDate > $today) {
			echo "<script type='text/javascript'>alert('Date has to be on or before today\\'s date.');</script>";
			$success = False;
			return;
		}



		$tuple = array(
			":bind1" => $_POST['insPID'],
			":bind2" => $_POST['insRID'],
			":bind3" => $_POST['insNID'],
			":bind4" => $_POST['insPlayerName'],
			":bind5" => $_POST['insplayerRegion'],
			":bind6" => $_POST['insJoinDate'],
			":bind7" => $_POST['insInGameHour'],
			":bind8" => $_POST['insFormDate'],
			":bind9" => $_POST['insNumMissions']
		);

		$alltuples = array(
			$tuple
		);

		executeBoundSQL("insert into Player_Info values (:bind1, :bind2, :bind3, :bind4, :bind5, TO_DATE(:bind6, 'YYYY-MM-DD'), :bind7, TO_DATE(:bind8, 'YYYY-MM-DD'), :bind9)", $alltuples);
		oci_commit($db_conn);
	}

	function handleDeleteRequest() 
	{
		global $db_conn, $success;

		$delRID = $_POST['delRID'];

		if (!$delRID) {
			echo "<script type='text/javascript'>alert(Record ID cannot be empty, please input a value!');</script>";
			$success = False;
			return;
		}

		$tuple = array (
			":delRID" => $_POST['delRID'],
		);

		$alltuples = array (
			$tuple
		);

		executeBoundSQL("
		DELETE 
		FROM Player_Record2 R
		WHERE R.RID = :delRID
	", $alltuples);

	OCICommit($db_conn);

	}

	function handleCountRequest()
	{
		global $db_conn;

		$result = executePlainSQL("SELECT Count(*) FROM Player_Info");

		if (($row = oci_fetch_row($result)) != false) {
			echo "<br> The number of tuples in Player Info: " . $row[0] . "<br>";
		}
	}

	function handleDisplayRequest()
	{
		global $db_conn;
		$result = executePlainSQL("SELECT * FROM Player_Info");
		printResult($result);
	}

	// HANDLE ALL POST ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
	function handlePOSTRequest()
	{
		if (connectToDB()) {
			if (array_key_exists('deleteQueryRequest', $_POST)) {
				handleDeleteRequest();
			} else if (array_key_exists('resetTablesRequest', $_POST)) {
				handleResetRequest();
			// } else if (array_key_exists('updateQueryRequest', $_POST)) {
			// 	handleUpdateRequest();
			} else if (array_key_exists('insertQueryRequest', $_POST)) {
				handleInsertRequest();
			}

			disconnectFromDB();
		}
	}

	// HANDLE ALL GET ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
	function handleGETRequest()
	{
		if (connectToDB()) {
			if (array_key_exists('countTuples', $_GET)) {
				handleCountRequest();
			} elseif (array_key_exists('displayTuples', $_GET)) {
				handleDisplayRequest();
			}

			disconnectFromDB();
		}
	}

	if (isset($_POST['reset']) || isset($_POST['updateSubmit']) || isset($_POST['insertSubmit']) || isset($_POST['deleteSubmit'])) {
		handlePOSTRequest();
	} else if (isset($_GET['countTupleRequest']) || isset($_GET['displayTuplesRequest'])) {
		handleGETRequest();
	}

	// End PHP parsing and send the rest of the HTML content
	?>
</body>

</html>
