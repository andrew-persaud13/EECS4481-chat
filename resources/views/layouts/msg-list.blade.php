
@if( count($msgs) > 0) 

  @if( count($msgs) == 1)
    @foreach($msgs as $msg)
    <div id="{{ $msg->id }}" class="msg-item <?php echo($msg->user_id == $me->id) ? 'me' : '';?>">
      <img class="img-circle img-responsive msg-item-img" src="{{ asset('img/defaultpic.png') }}">
      <div class="msg-item-txt">
        {{ $msg->msg }}
        <div class="msg-item-data">
          @if( $msg->created_at->diffInHours(\Carbon\Carbon::now(), false) > 24)
            {{ $msg->created_at->format('d F Y h:i A') }}
          @else
            {{$msg->created_at->diffForHumans()}}
          @endif
        </div>
      </div>
    </div>
    @endforeach
  @else
    @foreach($msgs->reverse() as $msg)
    <div id="{{ $msg->id }}" class="msg-item <?php echo($msg->user_id == $me->id) ? 'me' : '';?>">
      <img class="img-circle img-responsive msg-item-img" src="{{ asset('img/defaultpic.png') }}">
      <div class="msg-item-txt">
        {{ $msg->msg }}
        <div class="msg-item-data">
          @if( $msg->created_at->diffInHours(\Carbon\Carbon::now(), false) > 24)
            {{ $msg->created_at->format('d F Y h:i A') }}
          @else
            {{$msg->created_at->diffForHumans()}}
          @endif
        </div>
      </div>
    </div>
    @endforeach
  @endif

@else
  <div class="no-record text-center">No Message Exist</div>
@endif 