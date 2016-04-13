$( function() {

  $("#tweet").on('submit', function(event) {

    event.preventDefault();

    var tweet = $('#message').val(),
        errorBox = $('#errors'),
        tweets = $('#tweets'),
        successful = $('#successful'),
        rejected = $('#rejected');

    errorBox.html('');

    if ( tweet.length < 5 ) {
      errorBox.append('Your tweet needs to be at least 5 characters long.<br/>');
      rejected.append('<div>' + tweet + '</div>');
    }

    if ( tweet.length > 140 ) {
      errorBox.append('Your tweet is too long.  Please limit your tweet to 140 characters or less.<br/>');
      rejected.append('<div>' + tweet + '</div>');
    }

    if ( tweet.toLowerCase().indexOf("microsoft") >= 0 || tweet.toLowerCase().indexOf('windows') >= 0 ) {
      if ( tweet.toLowerCase().indexOf('aws') === -1 ) {
        errorBox.append('Gross, please do not mention Microsoft or Windows in your tweet!<br/>');
        rejected.append('<div>' + tweet + '</div>');
      }
    }

    if ( errorBox.is(':empty') ) {

      $.ajax({
        url: 'tweet.php',
        type: 'post',
        data: $(this).serializeArray(),
        success: function(data, status) {
          successful.append('<div><span>' + data.id_str + ':</span> ' + data.text + '</div>');
        },
        error: function(xhr, desc, err) {
          rejected.append('<div>' + tweet + '</div>');
        }
      }); 

    }

  });

});