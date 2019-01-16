<?php
$pdo = new PDO('sqlite:chinook.db');
$sql = "
  SELECT  genres.Name AS genre,
          tracks.Name AS name,
          albums.Title AS title,
          artists.Name AS artist,
          tracks.UnitPrice AS price
  FROM genres
  INNER JOIN tracks
  ON genres.GenreID = tracks.GenreId
  INNER JOIN albums
  ON tracks.AlbumId = albums.AlbumId
  INNER JOIN artists
  ON albums.ArtistId = artists.ArtistId
";

if (isset($_GET['genre'])) {
  $sql = $sql . 'WHERE genres.Name = ?';
}

$statement = $pdo->prepare($sql);


if (isset($_GET['genre'])) {
  $statement->bindParam(1,$_GET['genre']);
}



$statement->execute();
$genres = $statement->fetchAll(PDO::FETCH_OBJ);
// var_dump($genres);
// echo $genres[0]->Name;
// die();

 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Week 2</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <button>  <a href="/"> ← </a> </button> <br>
<h1>
<?php if (isset($_GET['genre'])) { ?>
<?php print_r($_GET['genre']);} else{ echo "All Genres";} ?>
</h1>
  <table class="table">
    <tr>
      <th> Track Name </th>
      <th> Album Title </th>
      <th> Artist Name </th>
      <th> Price </th>
    </tr>
<?php foreach($genres as $genre) : ?>
    <tr>
      <td> <?php echo $genre->name ?> </td>
      <td> <?php echo $genre->title ?> </td>
      <td> <?php echo $genre->artist ?> </td>
      <td> <?php echo $genre->price ?> </td>
    </tr>
  <?php endforeach ?>


  <?php if(count($genres)=== 0) : ?>
    <?php header("Location: /tracks.php"); ?>
  <?php endif ?>

  </table>
</body>
</html>
