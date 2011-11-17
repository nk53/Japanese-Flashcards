<!doctype html>
<html>
<head>
<title>Manage</title>
<meta charset='UTF-8' />
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<a href="flashcards.html">Flashcards</a>
<a href="add.php">Add Kanji</a>
<h1>Manage Kanji List</h1>
<table class="list">
<?php

include('kanji.php');

$kanji = new Kanji();

$kanji->query('SELECT * FROM kanji', FALSE);

while ($kanji->row()) { ?>
<tr>
<td><?php echo $kanji->kanji ?></td>
<td><?php echo $kanji->pronunciation ?></td>
<td><?php echo $kanji->english_translation ?></td>
<td><?php echo $kanji->link ?></td>
<td><a href="edit.php?<?php echo $kanji->id() ?>">Edit</a></td>
<td><a href="delete.php?<?php echo $kanji->id() ?>">Delete</a></td>
</tr>
<?php } ?>
