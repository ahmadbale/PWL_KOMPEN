<form action="{{ url('/personilakademik/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Personil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Bagian Kiri -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nomor Induk</label>
                            <input type="text" name="nomor_induk" id="nomor_induk" class="form-control">
                            <small id="error-nomor_induk" class="error-text form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control">
                            <small id="error-nama" class="error-text form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input type="text" name="nomor_telp" id="nomor_telp" class="form-control">
                            <small id="error-nomor_telp" class="error-text form-text text-danger"></small>
                        </div>
                    </div>
                    <!-- Bagian Kanan -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" id="username" class="form-control">
                            <small id="error-username" class="error-text form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                            <small id="error-password" class="error-text form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Level Pengguna</label>
                            <select name="id_level" id="id_level" class="form-control">
                                <option value="">- Pilih Level -</option>
                                @foreach ($level as $l)
                                    <option value="{{ $l->id_level }}">{{ $l->nama_level }}</option>
                                @endforeach
                            </select>
                            <small id="error-id_level" class="error-text form-text text-danger"></small>
                        </div>
                    </div>
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
        $("#form-tambah").validate({
            rules: {
                nomor_induk: {
                    maxlength: 18
                },
                username: {
                    maxlength: 20
                },
                nama: {
                    maxlength: 255
                },
                password: {
                    maxlength: 255
                },
                nomor_telp: {
                    maxlength: 15
                },
                id_level: {
                    number: true
                }
            },
            messages: {
                nomor_induk: {
                    maxlength: "Maksimal 18 karakter"
                },
                username: {
                    maxlength: "Maksimal 20 karakter"
                },
                nama: {
                    maxlength: "Maksimal 255 karakter"
                },
                password: {
                    maxlength: "Maksimal 255 karakter"
                },
                nomor_telp: {
                    maxlength: "Maksimal 15 karakter"
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
                            dataPersonil.ajax.reload();
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
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Gagal menyimpan data. Silakan coba lagi.'
                        });
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