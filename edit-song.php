<?

// This page offers a form that submits back to itself to insert new records into the database

// require the database initialization and functions
require 'database.php';
require 'functions.php';

//https://www.studentstutorial.com/php/php-mysql-data-update.php
$result = mysqli_query($db,"SELECT * FROM $databaseTable WHERE songid='" . $_GET['songid'] . "'");
$row = mysqli_fetch_array($result);

// read submitted data from the $_POST array
$songID = mysqli_real_escape_string($db, $_POST["addSongName"]);
$songName = mysqli_real_escape_string($db, $_POST["addSongName"]);
$songArtist = mysqli_real_escape_string($db, $_POST["addArtistName"]);
$songAlbum = mysqli_real_escape_string($db, $_POST["addAlbumName"]);
$songRating = mysqli_real_escape_string($db, $_POST["addRating"]);
$songVideo = mysqli_real_escape_string($db, $_POST["addVideo"]);


if (isset($_GET["songid"])){
  $songID = $_GET["songid"];
    
  if ( ($songName != "") && ($songArtist != "") && ($songAlbum != "") && ($songRating != "") && ($songVideo != "") ) {

    // update submitted information into the database
    // ideally we would analyze the info first to confirm it is accurate, but let's live dangerously
    // but we did use mysqli_real_escape_string() above for security reasons
    $sql = "UPDATE $databaseTable
            SET song_name = '$songName',
                song_artist = '$songArtist',
                song_album = '$songAlbum',
                song_rating = '$songRating',
                song_video = '$songVideo'
            WHERE songid = $songID";

    $result = $db->query($sql); // process the SQL logic above, and get a result back

    if (!$result) die("Insert Error: " . $sql . "<br>" . $db->error);

  }
}

// onward to the HTML!

?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Manager</title>

    <!-- external and internal CSS -->
    <link rel="stylesheet" href="styles.css" media="all">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
      /* in-file CSS here */
    </style>

    <!-- external and internal JavaScript -->
    <script src="scripts.js" defer></script>
    <!-- bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
      // in-page JavaScript here
    </script>
</head>
<body>
  <div class="d-flex justify-content-center">
    <div class="jumbotron w-50">
      <h1>
        Edit Song
      </h1>
      <form method="POST">
        <div class="form-group">
          <label for="addSongName">Song Name: </label>
          <input class="form-control" name="addSongName" id="addSongName" value="<? echo $row['song_name']; ?>" required></input>
        </div>

        <div class="form-group">
          <label for="addArtistName">Artist Name:</label>
          <input class="form-control" name="addArtistName" id="addArtistName" value="<? echo $row['song_artist']; ?>" required></input>
        </div>

        <div class="form-group">
          <label for="addAlbumName">Album Name:</label>
          <input class="form-control" name="addAlbumName" id="addAlbumName" value="<? echo $row['song_album']; ?>" required></input>
        </div>

        <div class="form-group">
          <label for="addRating">Rating: </label>
          <select class="form-control" name="addRating" id="addRating" value="<? echo $row['song_rating']; ?>" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </div>

        <div class="form-group">
          <label for="addVideo">Video URL: </label>
          <input type="url" class="form-control" name="addVideo" id="addVideo" value="<? echo $row['song_video']; ?>" required>
        </div>

        <button class="btn btn-primary" type="submit">Update Song</button>
      </form>
      <a href="index.php"><button class="btn btn-primary">Back to Music Manager</button></a>
    </div>
  </div>
</body>
</html>