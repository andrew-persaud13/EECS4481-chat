console.log('hellojiiii');
jQuery(document).ready(function($) {
  $('body').on('click', '.chat-item', function() {
    $(this)
      .addClass('chat-select')
      .siblings()
      .removeClass('chat-select');
    var c_id = $(this).attr('id');
    $('#create-msg-form')
      .find('#chat-id')
      .val(c_id);

    var el = $(this);

    msg_load(c_id, 10, true, el);
  });

  $('body').on('click', '#create-msg', function() {
    var msg = $('#msg').val();
    var c_id = $('#chat-id').val();
    $.ajax({
      method: 'post',
      url: 'message',
      data: {
        msg: msg,
        c_id: c_id
      }
    }).done(function(resp) {
      try {
        resp = $.parseJSON(resp);
      } catch (e) {
        window.location('/chat/public/login');
      }

      if (resp.status == 1) {
        new_msg_load(c_id, 1, resp.fst);
      } else {
      }
    });
  });
});

var chat_list = function() {
  $.ajax({
    method: 'get',
    url: 'chat-list'
  }).done(function(resp) {
    try {
      resp = $.parseJSON(resp);
    } catch (e) {
      window.location = '/chat/public/login';
    }
    if (resp.status == 1) {
      $('$chat-body')
        .empty()
        .append(resp.txt);
    }
  });
};

var msg_load = function(c_id = null, limit = 10, first = false, el = null) {
  if (c_id != null && c_id != '') {
    $.ajax({
      method: 'post',
      url: 'message-list',
      data: {
        c_id: c_id,
        limit: limit
      }
    }).done(function(resp) {
      try {
        resp = $.parseJSON(resp);
      } catch (e) {
        window.location = '/chat/public/login';
      }
      if (resp.status == 1) {
        $('#msg-body')
          .empty()
          .html(resp.txt);
        var objDiv = document.getElementById('msg-body');

        if (
          Math.ceil(
            $('#msg-body').scrollTop() + $('#msg-body').innerHeight()
          ) >=
            objDiv.scrollHeight - 110 ||
          first == true
        ) {
          objDiv.scrollTop = objDiv.scrollHeight;
        }
        $('#create-msg-form')
          .find('#msg')
          .prop('disabled', false);
        $('#create-msg-form')
          .find('#create-msg')
          .prop('disabled', false);
      }
    });
  }
};

var new_msg_load = function(c_id = null, me = 0, fst = 0) {
  if (c_id != null && c_id != '') {
    $.ajax({
      method: 'post',
      url: 'new-message-list',
      data: {
        c_id: c_id,
        me: me
      }
    }).done(function(resp) {
      try {
        resp = $.parseJSON(resp);
      } catch (e) {
        window.location = '/chat/public/login';
      }
      if (resp.status == 1) {
        if (fst == 0) {
          $('#msg-body').append(resp.txt);
        } else {
          $('msg-body').html(resp.txt);
        }

        var objDiv = document.getElementById('msg-body');

        if (
          Math.ceil(
            $('#msg-body').scrollTop() + $('#msg-body').innerHeight()
          ) >=
            objDiv.scrollHeight - 110 ||
          first == true
        ) {
          objDiv.scrollTop = objDiv.scrollHeight;
        }
        $('#create-msg-form')
          .find('#msg')
          .prop('disabled', false);
        $('#create-msg-form')
          .find('#create-msg')
          .prop('disabled', false);
      }
    });
  }
};
