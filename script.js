// Wait for body to load, set event handlers
$(document).ready(function() {
  
  // Prevent IE from treating ajax requests as regular web requests
  $.ajaxSetup({ cache: false });
  
  // Show the other side of the flashcard (kanji or translation).
  $('#flip').click(function(e) {
    if ($('#showing').html().indexOf('Kanji') != -1) {
      $('#english').show();
      $('#kanji').hide();
      $('#showing').html('Currently showing English translation');
    } else {
      $('#english').hide();
      $('#kanji').show();
      $('#showing').html('Currently showing Kanji');
    }
  });
  
  // Show the pronunciation in katakana/hiragana
  $('#show_pronunciation').click(function(e) {
    if ($('#show_pronunciation').val().indexOf('Show') != -1) {
      $('#pronunciation').show();
      $('#show_pronunciation').val('Hide pronunciation');
    } else {
      $('#pronunciation').hide();
      $('#show_pronunciation').val('Show pronunciation');
    }
  });
  
  // Show a new flashcard.
  $('#new').click(function(e) {
    $.getJSON('show_new.php', function(data) {
        $('#kanji').html(data['kanji']);
        $('#english').html(data['english_translation']);
        $('#pronunciation').html(data['pronunciation']);
        $('#link').attr('href', data['link']);
    });
  });
});
