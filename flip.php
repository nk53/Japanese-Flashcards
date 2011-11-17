<?php

include('kanji.php');

$kanji = new Kanji();
$query = 'SELECT * FROM kanji WHERE ';

if (strstr($_GET['showing'], 'Kanji')) {
  $query .= 'kanji="'.$_GET['flashcard'].'"';
  $kanji->query($query);
  echo $kanji->english_translation;
} else {
  $query .= 'english_translation="'.$_GET['flashcard'].'"';
  $kanji->query($query);
  echo $kanji->kanji;
}

?>
