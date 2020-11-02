@extends('main-layout.template')

@section('content')
<div class="site-section">
    <div class="container bg-light">
        <div class="row">
            <div class="col-md-12">
                <div class="p-3 p-lg-5 border">
                    <div class="col-md-12 mb-5 text-center">
                        <h2 class="h3 mt-3 mb-3 text-black text-center">Customize Product Form</h2>
                        <span>Harap diisi dengan benar sesuai dengan kebutuhan.</span>
                    </div>

                    @if(count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <li class="text-red">{{ $error }}</li>
                        @endforeach
                    @endif

                    <form class="mt-4" action="{{ url('/Customize-Product/Save') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="text-black">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="email" class="text-black">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="contact" class="text-black">No.Handphone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="contact" name="contact">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="kebutuhan" class="text-black">Kebutuhan </label>
                                <input type="text" class="form-control" id="kebutuhan" name="kebutuhan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="referensi" class="text-black text-center">Referensi <span class="text-danger">*</span></label>
                                <input type="file" class="form-control-file" id="referensi" name="referensi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="infotmbh" class="text-black">Info Tambahan</label>
                                <textarea class="form-control" id="infotmbh" name="infotmbh" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-primary btn-lg btn-block" value="SUBMIT">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection