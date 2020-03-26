
@if ( count($chats) > 0 )
  @foreach($chats as $chat)
<div id="{{ $chat->id }}" class="chat-item">
  <!-- @if (count($chat->users) > 2)
    <img class="img-circle img-responsive chat-item-img" src="{{ asset('img/defaultpic.png') }}">
  @else
     <img class="img-circle img-responsive chat-item-img" src="{{ asset('img/defaultpic.png') }}">
  @endif -->
  <div class="chat-item-users">
    <?php
      $un = [];
      foreach ($chat->users as $u) {
        if ($me->id !== $u->id) {
          $un[] = $u->name;
          $pic = $u->uploaded_file;
        }
      }
      $un = implode(", ", $un);
      $file_source= '/chat/public/storage/'.$pic;
      echo  "
        <img class='img-circle img-responsive chat-item-img' src='$file_source'>
      ";
      
      echo ( strlen($un) > 17 ) ? substr($un, 0, 17)."..." : $un;
      echo (($u->id) > 3 && ($me->id <= 3)) ? "<span><button id='transfer-anon'  class='btn btn-link '>Transfer</button><span>" : "";
      echo (($u->id) > 3 && ($me->id <= 3)) ? "
        <input type='hidden' id='anon_id' value='$u->id'>
        <input type='hidden' id='user_id' value='$me->id'>
        " : "";
    ?>
  </div>
</div>
  @endforeach
  <div id="test"></div>
@else
  <div class="no-record text-center">No Chats Exist</div>
@endif





