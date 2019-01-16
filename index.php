<?php
$pdo = new PDO('sqlite:chinook.db');
$sql = "
  SELECT genres.Name
  FROM genres

";

$statement = $pdo->prepare($sql);
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
<h1>  Genres </h1>
<div id="allgenres">
<?php foreach($genres as $genre) : ?>
<!-- <table> <tr>
<td> -->
<a href="tracks.php?genre=<?php echo urlencode($genre->Name) ?>">
<?php echo $genre->Name ?>
</a>
<!-- </td>
</tr>
</table> -->
<br>
<?php endforeach ?>
</div>
</body>
</html>
