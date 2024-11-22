@empty($personil)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-lg shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Kesalahan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-danger border-0 rounded-lg shadow-sm">
                    <h5 class="d-flex align-items-center">
                        <i class="icon fas fa-ban mr-2"></i>
                        <span>Kesalahan!!!</span>
                    </h5>
                    <p class="mb-0">Data yang anda cari tidak ditemukan</p>
                </div>
                <a href="{{ url('/personilakademik') }}" class="btn btn-warning btn-lg rounded-lg">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/personilakademik/' . $personil->id_personil . '/update_ajax') }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content rounded-lg shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <i class="fas fa-user-edit mr-2"></i>Edit Data Personil Akademik
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label class="font-weight-bold">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <input value="{{ $personil->username }}" type="text" name="username" id="username" 
                                class="form-control form-control-lg" required>
                        </div>
                        <small id="error-username" class="error-text form-text text-danger"></small>
                    </div>
                    
                    <div class="form-group">
                        <label class="font-weight-bold">Nama</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-id-card"></i>
                                </span>
                            </div>
                            <input value="{{ $personil->nama }}" type="text" name="nama" id="nama" 
                                class="form-control form-control-lg" required>
                        </div>
                        <small id="error-nama" class="error-text form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            <input type="password" name="password" id="password" 
                                class="form-control form-control-lg">
                        </div>
                        <small id="error-password" class="error-text form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Nomor Telepon</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-phone"></i>
                                </span>
                            </div>
                            <input value="{{ $personil->nomor_telp }}" type="text" name="nomor_telp" id="nomor_telp" 
                                class="form-control form-control-lg" required>
                        </div>
                        <small id="error-nomor_telp" class="error-text form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Level Pengguna</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-layer-group"></i>
                                </span>
                            </div>
                            <select name="id_level" id="id_level" class="form-control form-control-lg">
                                <option value="">- Pilih Level -</option>
                                @foreach ($level as $l)
                                    <option value="{{ $l->id_level }}">{{ $l->nama_level }}</option>
                                @endforeach
                            </select>
                        </div>
                        <small id="error-id_level" class="error-text form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" data-dismiss="modal" class="btn btn-warning btn-lg px-4">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            // Set selected level
            $('#id_level').val('{{ $personil->id_level }}');
            
            $("#form-edit").validate({
                rules: {
                    username: { required: true, minlength: 3, maxlength: 20 },
                    nama: { required: true, minlength: 3, maxlength: 255 },
                    password: { minlength: 6, maxlength: 255 },
                    nomor_telp: { required: true, minlength: 10, maxlength: 15 },
                    id_level: { required: true, number: true }
                },
                messages: {
                    username: {
                        required: "Username harus diisi",
                        minlength: "Username minimal 3 karakter",
                        maxlength: "Username maksimal 20 karakter"
                    },
                    nama: {
                        required: "Nama harus diisi",
                        minlength: "Nama minimal 3 karakter",
                        maxlength: "Nama maksimal 255 karakter"
                    },
                    password: {
                        minlength: "Password minimal 6 karakter",
                        maxlength: "Password maksimal 255 karakter"
                    },
                    nomor_telp: {
                        required: "Nomor telepon harus diisi",
                        minlength: "Nomor telepon minimal 10 digit",
                        maxlength: "Nomor telepon maksimal 15 digit"
                    },
                    id_level: {
                        required: "Level pengguna harus dipilih"
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
                                    text: response.message,
                                    confirmButtonClass: 'btn btn-primary btn-lg'
                                });
                                dataPersonil.ajax.reload();
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message,
                                    confirmButtonClass: 'btn btn-primary btn-lg'
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