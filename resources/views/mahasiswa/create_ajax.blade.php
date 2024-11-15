<style>
    #text {
        padding-top: 20px;
    }

    #nomor_induk {
        border-radius: 50px;
        width: 15rem;
        background-color: #E1E5F4;
    }

    #username {
        border-radius: 50px;
        width: 15rem;
        background-color: #E1E5F4;
    }

    #nama {
        border-radius: 50px;
        width: 20rem;
        background-color: #E1E5F4;
    }

    #semester {
        border-radius: 50px;
        width: 15rem;
        background-color: #E1E5F4;

    }

    #password {
        border-radius: 50px;
        width: 15rem;
        background-color: #E1E5F4;
    }

    #jam_alpha {
        border-radius: 50px;
        width: 15rem;
        background-color: #E1E5F4;
    }

    #jam_kompen {
        border-radius: 50px;
        width: 15rem;
        background-color: #E1E5F4;
    }

    #jam_kompen_selesai {
        border-radius: 50px;
        width: 15rem;
        background-color: #E1E5F4;
    }

    #id_prodi {
        border-radius: 50px;
        width: 15rem;
        background-color: #E1E5F4;
    }

    .button-batal {
        width: 100px !important;
        height: auto !important;
    }

    .button-success {
        width: 100px !important;
        height: auto !important;
    }

    .modal-content {
        border-radius: 30px !important;
    }
</style>

<form action="{{ url('/mahasiswa/ajax') }}" method="POST" id="form-tambah">
    @csrf <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-12 text-left mb-3" id="text">
                    <h2><b>Tambah Data Mahasiswa</b></h2>
                </div>
            </div>
            <div class="modal-body">

                <div class="form-group"> <label>Nomor Induk</label> <input value="" placeholder="Nomor Induk"
                        type="number" name="nomor_induk" id="nomor_induk" class="form-control" required>
                    <small id="error-nomor_induk" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group"> <label>Username</label> <input value="" placeholder="Username"
                        type="text" name="username" id="username" class="form-control" required> <small
                        id="error-username" class="error-text form-text text-danger"></small> </div>
                <div class="form-group"> <label>Nama</label> <input value="" placeholder="Nama Lengkap"
                        type="text" name="nama" id="nama" class="form-control" required> <small
                        id="error-nama" class="error-text form-text text-danger"></small> </div>
                <div class="form-group"> <label>Semester</label> <input value="" placeholder="Semester"
                        type="number" name="semester" id="semester" class="form-control" required> <small
                        id="error-semester" class="error-text form-text text-danger"></small> </div>
                <div class="form-group">
                    <label>Password</label>
                    <input value="" placeholder="Password" type="password" name="password" id="password"
                        class="form-control" required>
                    <small id="error-password" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group"> <label>Jam Alpha</label> <input value="" placeholder="Jam Alpha"
                        type="number" name="jam_alpha" id="jam_alpha" class="form-control" required> <small
                        id="error-jam_alpha" class="error-text form-text text-danger"></small> </div>
                <div class="form-group"> <label>Jam Kompen</label> <input value="" placeholder="Jam Kompen"
                        type="number" name="jam_kompen" id="jam_kompen" class="form-control" required> <small
                        id="error-jam_kompen" class="error-text form-text text-danger"></small> </div>
                <div class="form-group"> <label>Jam Kompen Selesai</label> <input value=""
                        placeholder="Jam Kompen Selesai" type="number" name="jam_kompen_selesai"
                        id="jam_kompen_selesai" class="form-control" required> <small id="error-jam_kompen_selesai"
                        class="error-text form-text text-danger"></small> </div>

                <div class="form-group"> <label>Prodi</label> <select name="id_prodi" id="id_prodi"
                        class="form-control" required>
                        <option value="">- Pilih Prodi -</option>
                        @foreach ($prodi as $p)
                            <option value="{{ $p->id_prodi }}">{{ $p->nama_prodi }}</option>
                        @endforeach
                    </select> <small id="error-id_level" class="error-text form-text text-danger"></small> </div>
            </div>

            <div class="modal-footer"> <button type="button" data-dismiss="modal"
                    class="btn btn-danger button-batal">Batal</button> <button type="submit"
                    class="btn btn-success button-success">Simpan</button>
            </div>
        </div>
</form>
<script>
    $(document).ready(function() {
        $("#form-tambah").validate({
            rules: {
                nomor_induk: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10,
                },
                username: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                nama: {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                },
                semester: {
                    required: true,
                    number: true,
                    maxlength: 2
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 20
                },
                jam_alpha: {
                    required: true,
                    number: true,
                    maxlength: 3
                },
                jam_kompen: {
                    required: true,
                    number: true,
                    maxlength: 3
                },
                jam_kompen_selesai: {
                    required: true,
                    number: true,
                    maxlength: 3
                },
                id_prodi: {
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
