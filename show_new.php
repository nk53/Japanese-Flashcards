<?php

//mb_internal_encoding('UTF-8');
include('kanji.php');

$query = "SELECT * FROM kanji ORDER BY RAND() LIMIT 1";

$kanji = new Kanji();

$kanji->query($query);

$k = $kanji->kanji;
$e = $kanji->english_translation;
$p = $kanji->pronunciation;
$l = $kanji->link;

if (!$l) {
  $l = 'http://jisho.org/kanji/details/'.$k;
}

$response = array(
  'kanji' => $k,
  'english_translation' => $e,
  'pronunciation' => $p,
  'link' => $l,
);

echo json_encode($response);

/*$dom = new DOMDocument('1.0', 'utf-8');
$k = $dom->createElement('kanji', $kanji->kanji);
$e = $dom->createElement(
  'english_translation',
  $kanji->english_translation
);*/



/*$p = $dom->createElement('pronunciation', $kanji->pronunciation);

$dom->appendChild($k);
$dom->appendChild($e);
$dom->appendChild($p);

echo $dom->saveXML();*/

/*
<span id="kanji"><?php echo $k; ?></span>
<span id="english"><?php echo $e; ?></span>
<span id="pronunciation"><?php echo $p; ?></span>
*/
?>
