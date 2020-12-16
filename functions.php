<?

// This file contains one function to generate a table of information of data

// output a table of results, including a checkbox if $includeCheckbox is true
// receive the songs as a database object into $allSongs
function outputSongResults($allSongs, $includeCheckbox = false) {
	
	$counter = 1;
	$output = "";
	$output .= "<table cellpadding='10'>\n";
	
	// loop through $allAppts with each $row available as $appt
	foreach ($allSongs as $song) {
		$output .= "\t<tr style='background-color: #ddd;'>\n";
		
    $output .= "\t\t<td>" . $song["song_video"] . "</td>\n";
		$output .= "\t\t<td>" . $song["song_name"] . "</td>\n";
		$output .= "\t\t<td>" . $song["song_artist"] . "</td>\n";
		$output .= "\t\t<td>" . $song["song_album"] . "</td>\n";
		$output .= "\t\t<td>" . $song["song_rating"] . "</td>\n";
   
    if ($includeCheckbox) {
			$checkboxID = "song[" . $counter . "]";
			$checkboxValue = $song["songid"];
			$output .= "\t\t<td><input type='checkbox' id='$checkboxID' name='$checkboxID' value='$checkboxValue'></td>\n";
		}
		
		$output .= "\t</tr>\n";
			
		$counter++;
	}
	$output .= "</table>";
	
	return $output;
}