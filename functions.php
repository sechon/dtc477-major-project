<?

// This file contains one function to generate a table of information of data

// output a table of results, including a checkbox if $includeCheckbox is true
// receive the songs as a database object into $allSongs
function outputSongResults($allSongs, $includeCheckbox = false) {
	
	$counter = 1;
	$output = "";
	$output .= "<table cellpadding='10'>\n";
  
  $output .= "\t\t<td>PLAY</td>\n";
  $output .= "\t\t<td>NAME</td>\n";
  $output .= "\t\t<td>ARTIST</td>\n";
  $output .= "\t\t<td>ALBUM</td>\n";
  $output .= "\t\t<td>RATING</td>\n";
	
	// loop through $allSongs with each $row available as $appt
  if (is_array($allSongs) || is_object($allSongs)){
    foreach ($allSongs as $song) {
      $output .= "\t<tr style='background-color: #ddd;'>\n";

      $output .= "\t\t<td><a target=\"_blank\" href=\"" . $song["song_video"] . "\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-play\" viewBox=\"0 0 16 16\">
      <path fill-rule=\"evenodd\" d=\"M10.804 8L5 4.633v6.734L10.804 8zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C4.713 12.69 4 12.345 4 11.692V4.308c0-.653.713-.998 1.233-.696l6.363 3.692z\"/>
      </svg></td>\n";
      $output .= "\t\t<td>" . $song["song_name"] . "</td>\n";
      $output .= "\t\t<td>" . $song["song_artist"] . "</td>\n";
      $output .= "\t\t<td>" . $song["song_album"] . "</td>\n";
      $output .= "\t\t<td>" . starRating($song["song_rating"]) . "</td>\n";

      if ($includeCheckbox) {
        $checkboxID = "song[" . $counter . "]";
        $checkboxValue = $song["songid"];
        $output .= "\t\t<td><input type='checkbox' id='$checkboxID' name='$checkboxID' value='$checkboxValue'></td>\n";
      }

      $output .= "\t</tr>\n";

      $counter++;
    }
  }
	$output .= "</table>";
	
	return $output;
}

function starRating ($songRating){
  $star = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-star\" viewBox=\"0 0 16 16\">
  <path fill-rule=\"evenodd\" d=\"M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z\"/>
  </svg>";
  
  switch ($songRating){
    case 1:
      return $star;
      break;
    case 2:
      return $star . $star;
      break;
    case 3:
      return $star . $star . $star;
      break;
    case 4:
      return $star . $star . $star . $star;
      break;
    case 5:
      return $star . $star . $star . $star . $star;
      break;
  }
  
}