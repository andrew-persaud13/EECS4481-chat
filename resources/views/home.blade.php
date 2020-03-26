@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- chat list section -->
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="panel panel-default"> 
                <div class="panel-heading">Chat list
                   
                    <img class="img-rounded" src="{{ asset('storage/'.$me->uploaded_file) }}" style="max-height: 100px;" />
                
                </div>
                <div id="chat-body" class="panel-body">
                    @include("layouts.chat-list")
                </div>
            </div>
        </div>
        <!-- chat list section end -->

        <!-- message section -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="panel panel-default"> 
                <div class="panel-heading">Messages</div>
                <div id="msg-body" class="panel-body">
                    <!-- <div class="no-chat">No Chat Selected</div> -->
                    @include("layouts.msg-list")
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <form id="create-msg-form">
                         {{ csrf_field() }} 
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                <fieldset class="form-group">
                                    <textarea id="msg" name="msg" class="form-control" placeholder="write your message..."></textarea>
                                    <div id="typing_on"></div>
                                    <input type="hidden" name="chat-id" id="chat-id">
                                </fieldset>
                                <fieldset class="form-group">
                                    <input disabled value="Send" class="btn btn-primary btn-block" type="button" name="sub" id="create-msg" />
                                </fieldset>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- message section end -->

    </div>
</div>
@endsection
