<?php

include('kanji.php');
//mb_internal_encoding('UTF-8');

$required = array(
  'kanji',
  'pronunciation',
  'english_translation',
);

if (!empty($_POST)) {
  
  $missing = false;
  
  foreach ($_POST as $key => $value) {
    if (empty($value) && $key != 'link') {
      $missing = true;
    }
  }
  
  if (!$missing) {
    $kanji = new Kanji($_POST);
    $kanji->insert();
    header('Location: manage.php');
  }
}

show_form($required);

function show_form($required) { ?>
<!doctype html>
<html>
<head>
<title>Add Kanji</title>
<meta charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h1>Add Kanji</h1>
  <form action='add.php' method='post'>
    <table>
      <tr>
        <td>Kanji</td>
        <td><input name="kanji" type="text"
               value="<?php echo $_POST['kanji']?>" /></td>
      </tr>
      <tr>
        <td>Pronunciation (in hiragana)</td>
        <td><input name="pronunciation" type="text"
               value="<?php echo $_POST['pronunciation']?>" /></td>
      </tr>
      <tr>
        <td>English translation</td>
        <td><input name="english_translation" type="text"
               value="<?php echo $_POST['english_translation']?>" /></td>
      </tr>
      <tr>
        <td>Link (optional)</td>
        <td><input name="link" type="text" 
               value="<?php echo $_POST['link']?>"/></td>
      </tr>
    </table>
    <input type="submit" value="Submit" />
  </form>
  <span class="error"><?php show_error_text($required); ?></span>
</body>
</html><?php

}

function show_error_text($required) {
  if (!empty($_POST)) {
    echo 'You are missing: <blockquote>';
    foreach ($required as $key) {
      if (empty($_POST[$key])) {
        echo $key.'<br />';
      }
    }
    echo '</blockquote>';
  }
}

?>
