<?php

// A class to access the Kanji table with
class Kanji {
  
  private $columns;
  private $id;
  private $query;
  private $result;
  private $values;
  
  public $kanji;
  public $pronunciation;
  public $english_translation;
  public $link;
  
  function __construct($values=array()) {
    $this->id = null;
    $this->result = null;
    $this->values = array();
    
    if (!empty($values)) {
      $this->setVals($values);
    } else {
      $this->kanji = null;
      $this->pronunciation = null;
      $this->english_translation = null;
      $this->link = null;
    }
  }
  
  private function setVals($kanji) {
    $this->kanji = $kanji['kanji'];
    $this->pronunciation = $kanji['pronunciation'];
    $this->english_translation = $kanji['english_translation'];
    $this->link = $kanji['link'];

    $this->values = array(
      $this->kanji,
      $this->pronunciation,
      $this->english_translation,
      $this->link,
    );
  }
  
  public function id() {
    if (isset($this->id)) {
      return $this->id;
    } else {
      return 0;
    }
  }
  
  public function query($query, $fetch=TRUE) {
    $link = mysql_connect('localhost', 'nakern', 'nakern')
        or die('Could not connect: ' . mysql_error());
    mysql_query('SET NAMES utf8') or die('Could not set charset');
    //mysql_set_charset('UTF-8', $link);
    
    mysql_select_db('nakern') or die('Could not select database');
    
    $this->result = mysql_query($query)
        or die('Query failed: ' . mysql_error());
    
    if ($fetch) {
      $res = $this->result;
      $kanji = mysql_fetch_assoc($res);
      $this->setVals($kanji);
    }
  }
  
  // Select kanji based on this object's values
  // or select all if this object has no values
  public function get() {
    $query = 'SELECT * FROM kanji';
    $where = ' WHERE ';
    $count = 0;
    
    foreach ($this->values as $key => $value) {
      if ($value) {
        if (!$count) {
          $where .= "$key='$value'";
          $count++;
        } else {
          $where .= " AND $key='$value'";
          $count++;
        }
      }
    }
    
    if ($count) {
      $query .= $where;
    }
    
    $this->query($query);
  }
  
  // Fetch the next row
  public function row() {
    if($kanji = mysql_fetch_assoc($this->result)) {
      $this->setVals($kanji);
      return true;
    } else {
      return false;
    }
  }
  
  public function insert() {
    $k = $this->kanji;
    $p = $this->pronunciation;
    $e = $this->english_translation;
    $l = $this->link;
    
    //echo iconv_get_encoding($k);
    
    
    if (empty($l)) {
      $l = 'NULL';
    } else {
      $l = "'$l'";
    }

    $query = 'INSERT INTO kanji '.
             '(kanji, pronunciation, english_translation, link) '.
             "VALUES ('$k', '$p', '$e', $l);";

    $this->query($query, FALSE);
  }

}

?>
