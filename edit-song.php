<?

// This page offers a form that submits back to the database to insert new records into the database

// require the database initialization and functions
require 'database.php';
require 'functions.php';

//buffer reset - https://stackoverflow.com/questions/6974691/php-page-redirect-problem-cannot-modify-header-information
ob_start();

//https://www.studentstutorial.com/php/php-mysql-data-update.php
//using songid to get database values to appear on form for editing
$result = mysqli_query($db,"SELECT * FROM $databaseTable WHERE songid='" . $_GET['songid'] . "'");
$row = mysqli_fetch_array($result);

// read submitted data from the $_POST array
$songID = mysqli_real_escape_string($db, $_POST["addSongName"]);
$songName = mysqli_real_escape_string($db, $_POST["addSongName"]);
$songArtist = mysqli_real_escape_string($db, $_POST["addArtistName"]);
$songAlbum = mysqli_real_escape_string($db, $_POST["addAlbumName"]);
$songRating = mysqli_real_escape_string($db, $_POST["addRating"]);
$songVideo = mysqli_real_escape_string($db, $_POST["addVideo"]);

// get songid from music manager
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
    // redirect back home after song is updated on the database
    header("Location:index.php");
  }
}

?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Manager - Edit</title>

    <!-- external and internal CSS -->
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css" media="all">

    <!-- bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  </head>

  <body>
    <!-- start top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
      <a class="navbar-brand" href="index.php">Music Manager</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="btn btn-inverse btn-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-inverse btn-link" href="add-song.php">Add Song</a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- start edit song form -->
    <div class="d-flex justify-content-center">
      <div class="jumbotron jumbotron-custom shadow-custom w-50">
        <h1>
          Edit Song
        </h1>
        <form method="POST">
          <div class="form-group">
            <label for="addSongName">Song Name: </label>
            <!-- using songid, get database value to edit -->
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

          <button class="btn btn-custom shadow-custom" type="submit">Update Song</button>
        </form>
        <a href="index.php"><button class="btn btn-custom shadow-custom">Back to Music Manager</button></a>
      </div>
    </div>
  </body>

  </html>