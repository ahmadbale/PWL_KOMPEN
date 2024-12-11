@empty($mahasiswa)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/mahasiswa') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/mahasiswa/' . $mahasiswa->id_mahasiswa . '/update_ajax') }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nomo Induk</label>
                        <input value="{{ $mahasiswa->nomor_induk }}" type="number" name="nomor_induk" id="nomor_induk"
                            class="form-control" required>
                        <small id="error-nomor_induk" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input value="{{ $mahasiswa->username }}" type="text" name="username" id="username" class="form-control"
                            required>
                        <small id="error-username" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input value="{{ $mahasiswa->nama }}" type="text" name="nama" id="nama" class="form-control"
                            required>
                        <small id="error-nama" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Periode Tahun</label>
                        <input value="{{ $mahasiswa->periode_tahun }}" type="text" name="periode_tahun" id="periode_tahun" class="form-control"
                            required>
                        <small id="error-periode_tahun" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input value="" type="password" name="password" id="password" class="form-control">
                        <small class="form-text text-muted">Abaikan jika tidak ingin ubah
                            password</small>
                        <small id="error-password" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Jam Alpha</label>
                        <input value="{{ $mahasiswa->jam_alpha }}" type="number" name="jam_alpha" id="jam_alpha" class="form-control"
                            required>
                        <small id="error-jam_alpha" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Jam Kompen</label>
                        <input value="{{ $mahasiswa->jam_kompen }}" type="number" name="jam_kompen" id="jam_kompen" class="form-control"
                            required>
                        <small id="error-jam_kompen" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Jam Kompen Selesai</label>
                        <input value="{{ $mahasiswa->jam_kompen_selesai }}" type="number" name="jam_kompen_selesai" id="jam_kompen_selesai" class="form-control"
                            required>
                        <small id="error-jam_kompen_selesai" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Prodi</label>
                        <select name="id_prodi" id="id_prodi" class="form-control" required>
                            <option value="">- Pilih Prodi -</option>
                            @foreach ($prodi as $p)
                                <option {{ $p->id_prodi == $mahasiswa->id_prodi ? 'selected' : '' }} value="{{ $p->id_prodi }}">
                                    {{ $p->nama_prodi }}</option>
                            @endforeach
                        </select>
                        <small id="error-id_prodi" class="error-text form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            $("#form-edit").validate({
                rules: {
                    nomor_induk: {
                    required: true,
                    number: true,
                    minlength:10,
                    maxlength:10
                },
                username: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                nama: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                periode_tahun: {
                    required: true,
                    number: true
                },
                password: {
                    required: false,
                    minlength: 6,
                    maxlength: 20
                },
                jam_alpha: {
                    required: true,
                    number: true
                },
                jam_kompen: {
                    required: true,
                    number: true
                },
                jam_kompen_selesai: {
                    required: true,
                    number: true
                },
                id_prodi: {
                    required: true,
                    number: true
                },
                id_level: {
                    required: true,
                    number: true
                }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                dataUser.ajax.reload();
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endempty