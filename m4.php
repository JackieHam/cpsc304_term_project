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
$config["dbuser"] = "ora_akam1227";			// change "cwl" to your own CWL
$config["dbpassword"] = "a83279505";	// change to 'a' + your student number
$config["dbserver"] = "dbhost.students.cs.ubc.ca:1522/stu";
$db_conn = NULL;	// login credentials are used in connectToDB()

$success = true;	// keep track of errors so page redirects only if there are no errors

$show_debug_alert_messages = true; // show which methods are being triggered (see debugAlertMessage())

// The next tag tells the web server to stop parsing the text as PHP. Use the
// pair of tags wherever the content switches to PHP
?>

<html>

<head>
	<title>Group 72 M4, M5</title>
</head>

<body>
	<h2>Reset</h2>
	<p>If you wish to reset the table press on the reset button. If this is the first time you're running this page, you MUST use reset</p>

	<form method="POST" action="m4.php">
		<!-- "action" specifies the file or page that will receive the form data for processing. As with this example, it can be this same file. -->
		<input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
		<p><input type="submit" value="Reset" name="reset"></p>
	</form>

	<hr />

	<!-- <h2>Insert Values into Player_Info</h2>
	<form method="POST" action="oracle-test.php">
		<input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
		Number: <input type="text" name="insNo"> <br /><br />
		Name: <input type="text" name="insName"> <br /><br />

		<input type="submit" value="Insert" name="insertSubmit"></p>
	</form>

	<hr />

	<h2>Update Name in Player_Info</h2>
	<p>The values are case sensitive and if you enter in the wrong case, the update statement will not do anything.</p>

	<form method="POST" action="oracle-test.php">
		<input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
		Old Name: <input type="text" name="oldName"> <br /><br />
		New Name: <input type="text" name="newName"> <br /><br />

		<input type="submit" value="Update" name="updateSubmit"></p>
	</form>

	<hr /> -->

	<h2>Count the Tuples in Player_Info</h2>
	<form method="GET" action="m4.php">
		<input type="hidden" id="countTupleRequest" name="countTupleRequest">
		<input type="submit" name="countTuples"></p>
	</form>

	<hr />

	<h2>Display Tuples in Player_Info</h2>
	<form method="GET" action="m4.php">
		<input type="hidden" id="displayTuplesRequest" name="displayTuplesRequest">
		<input type="submit" name="displayTuples"></p>
	</form>


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

	// function executeBoundSQL($cmdstr, $list)
	// {
	// 	/* Sometimes the same statement will be executed several times with different values for the variables involved in the query.
	// 	In this case you don't need to create the statement several times. Bound variables cause a statement to only be
	// 	parsed once and you can reuse the statement. This is also very useful in protecting against SQL injection.
	// 	See the sample code below for how this function is used */

	// 	global $db_conn, $success;
	// 	$statement = oci_parse($db_conn, $cmdstr);

	// 	if (!$statement) {
	// 		echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
	// 		$e = OCI_Error($db_conn);
	// 		echo htmlentities($e['message']);
	// 		$success = False;
	// 	}

	// 	foreach ($list as $tuple) {
	// 		foreach ($tuple as $bind => $val) {
	// 			//echo $val;
	// 			//echo "<br>".$bind."<br>";
	// 			oci_bind_by_name($statement, $bind, $val);
	// 			unset($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
	// 		}

	// 		$r = oci_execute($statement, OCI_DEFAULT);
	// 		if (!$r) {
	// 			echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
	// 			$e = OCI_Error($statement); // For oci_execute errors, pass the statementhandle
	// 			echo htmlentities($e['message']);
	// 			echo "<br>";
	// 			$success = False;
	// 		}
	// 	}
	// }

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

	// function handleInsertRequest()
	// {
	// 	global $db_conn;

	// 	//Getting the values from user and insert data into the table
	// 	$tuple = array(
	// 		":bind1" => $_POST['insNo'],
	// 		":bind2" => $_POST['insName']
	// 	);

	// 	$alltuples = array(
	// 		$tuple
	// 	);

	// 	executeBoundSQL("insert into Player_Info values (:bind1, :bind2)", $alltuples);
	// 	oci_commit($db_conn);
	// }

	function handleCountRequest()
	{
		global $db_conn;

		$result = executePlainSQL("SELECT Count(*) FROM Player_Info");

		if (($row = oci_fetch_row($result)) != false) {
			echo "<br> The number of tuples in Player_Info: " . $row[0] . "<br>";
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
			if (array_key_exists('resetTablesRequest', $_POST)) {
				handleResetRequest();
			// } else if (array_key_exists('updateQueryRequest', $_POST)) {
			// 	handleUpdateRequest();
			// } else if (array_key_exists('insertQueryRequest', $_POST)) {
			// 	handleInsertRequest();
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

	if (isset($_POST['reset']) || isset($_POST['updateSubmit']) || isset($_POST['insertSubmit'])) {
		handlePOSTRequest();
	} else if (isset($_GET['countTupleRequest']) || isset($_GET['displayTuplesRequest'])) {
		handleGETRequest();
	}

	// End PHP parsing and send the rest of the HTML content
	?>
</body>

</html>