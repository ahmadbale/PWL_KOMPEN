@extends('layouts.template')
@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                    <img src="{{ auth()->user()->image ? asset('storage/photos/' . auth()->user()->image) : asset('image.png ') }}"

                 class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px;" alt="Avatar">
                    </div>
                    <h3 class="profile-username text-center">{{ auth()->user()->nama }}</h3>
                    <p class="text-muted text-center">{{ auth()->user()->level->level_nama }}</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <form action="{{ url('/profile-mhs/update_picture/' . Auth::id()) }}" method="POST" enctype="multipart/form-data">
                         @csrf
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="file" name="image" id="image" class="form-control" required>
                                    <div class="input-group-append">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Ganti Foto Profil</button>
                        </form>
                        
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#editdatadiri" data-toggle="tab">Edit Data Diri</a></li>
                        <li class="nav-item"><a class="nav-link" href="#editpw" data-toggle="tab">Edit Password</a></li>
                    </ul>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="editdatadiri">
                            <form action="{{ url('/profile-mhs/update_profile/' . Auth::id()) }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="username" id="username" class="form-control" value="{{ Auth::user()->username }}" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama" id="nama" class="form-control" value="{{ Auth::user()->nama }}" readonly>
                                        <small id="error-nama" class="error-text form-text text-danger"></small>
                                    </div>
                                </div>
                        
                                <div class="form-group row">
                                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nim" id="nim" class="form-control" value="{{ Auth::user()->nomor_induk }}" disabled>
                                        <small id="error-nim" class="error-text form-text text-danger"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="prodi" class="col-sm-2 col-form-label">Prodi</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="prodi" id="prodi" class="form-control" value="{{ Auth::user()->prodi->nama_prodi }}" disabled>
                                        <small id="error-prodi" class="error-text form-text text-danger"></small>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-primary">Update Profil</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="editpw">
                            <form action="{{ url('/profile-mhs/update_password/' . Auth::id()) }}" method="POST"  class="form-horizontal">
                                @csrf
                                <div class="form-group row">
                                    <label for="oldPassword" class="col-sm-2 col-form-label">Password Lama</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="old_password" class="form-control" id="oldPassword" placeholder="Masukkan password lama" required>
                                        @if($errors->has('old_password'))
                                            <small class="text-danger">{{ $errors->first('old_password') }}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="newPassword" class="col-sm-2 col-form-label">Password Baru</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="new_password" class="form-control" id="newPassword" placeholder="Masukkan password baru" required>
                                        @if($errors->has('new_password'))
                                            <small class="text-danger">{{ $errors->first('new_password') }}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="confirmPassword" class="col-sm-2 col-form-label">Ulangi Password Baru</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="new_password_confirmation" class="form-control" id="confirmPassword" placeholder="Ulangi password baru" required>
                                        @if($errors->has('new_password_confirmation'))
                                            <small class="text-danger">{{ $errors->first('new_password_confirmation') }}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Update Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
@section('scripts')
<!-- Add any page-specific scripts here -->
<script>
</script>
@endsection