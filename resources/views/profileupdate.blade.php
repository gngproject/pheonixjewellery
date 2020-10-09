@extends('main-layout.template')

@section('content')

  @if(session("error"))
    <div class="alert alert-danger">
        {{ session("error") }}
    </div>
  @endif

  @if(session("success"))
    <div class="alert alert-primary">
        {{ session("success") }}
    </div>
  @endif

<div class="container bootstrap snippets bootdeys">
    <div class="row">
      <div class="col-xs-12 col-sm-12" style="background-color: white">
        <form class="form-horizontal" action="/Profile-Update/Data/{{$visitor->id}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="panel panel-default">
            <div class="panel-body text-center">
              <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="img-circle profile-avatar" alt="User avatar">
            </div>
          </div>
          <div class="card panel-default mt-5 mb-5">
            <div class="card-heading mt-4 ml-4">
                <h4 class="panel-title">User info Update</h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ $visitor->name }}">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Phone</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="telp" name="telp" value="{{ $visitor->telp }}">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" name="email" value="{{ $visitor->email }}">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="alamat" name="alamat" value="{{ $visitor->alamat }}"></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                <label for="gender" class="text-black text-center">Gender</label>
                  <div class="mb-1 d-flex">
                    <label for="option-sm" class="d-flex mr-3 mb-3">
                      <span class="d-inline-block mr-2" style="top:-2px; position: relative;">
                          <input type="radio" name="gender" id="Male" value="1">
                      </span>
                      <span class="d-inline-block text-black">Pria</span>
                    </label>
                    <label for="option-md" class="d-flex mr-3 mb-3">
                      <span class="d-inline-block mr-2" style="top:-2px; position: relative;">
                          <input type="radio" name="gender" id="Female" value="2">
                      </span>
                      <span class="d-inline-block text-black">Wanita</span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Photo KTP</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="photoktp" name="photoktp">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Photo Profile</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="photo" name="photo">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-default">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
</div>
@endsection