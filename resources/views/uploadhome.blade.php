@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <h1>Upload a File</h1>
      <hr />

      <form action="{{ route('upload_home') }}" method="post" enctype="multipart/form-data">
         {{ csrf_field() }} 

        <input type="file" name="fileUploaded2" style="margin: 20px 0;" />
        <input type="submit" class="btn btn-primary" value="Upload" />
        <a href="{{ route('home') }}">Login as helper </a>
      </form>
    </div>
  
  </div>
</div>
@endsection