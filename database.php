<?

// This file opens a MySQL connection to the database you created in cPanel

// define database values
$databaseServer = "165.227.218.225"; // IP number of database, may be on the same server
$databaseName = "spencere_477musicmanager"; // database name
$databaseUser = "spencere_demomusicmanager"; // user name
$databasePassword = "OyyK5JVv1pPy";  // user password

$databaseTable = "music_manager";  // main table name

/*
Available columns in this table:
- id: integer, auto-incremented unique identifier
- appt: timestamp of the appointment date and time of 
- patient_name: varchar of the patient’s name
- patient_complaint: varchar summarizing the patient’s reason for visit
- physician_name: varchar of the assigned physician’s name
*/

// attempt DB connection and die() if it fails
$db = new mysqli($databaseServer, $databaseUser, $databasePassword, $databaseName);
if ($db->connect_error) die("Database connection failed: " . $db->connect_error);

/*

Now you can set strings of SQL and submit them like this:

$sql = "SELECT * FROM $databaseTable"; 
$result = $db->query($sql);
if (!$result) die("Error: " . $sql . "<br>" . $db->error);

*/