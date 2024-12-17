@empty($detailKompen)
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
                    Data yang Anda cari tidak ditemukan
                </div>
                <a href="{{ url('/histori_mahasiswa') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/histori_mahasiswa/' . $detailKompen->id_kompen_detail . '/updateProgres') }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kompen Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Progres 1 <span class="text-danger">*</span></label>
                        <input value="{{ $detailKompen->progres_1 }}" type="text" name="progres_1" id="progres_1" class="form-control" required>
                        <small id="error-progres_1" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Progres 2 <span class="text-danger">*</span></label>
                        <input value="{{ $detailKompen->progres_2 }}" type="text" name="progres_2" id="progres_2" class="form-control" {{ $detailKompen->progres_1 ? '' : 'disabled' }}>
                        <small id="error-progres_2" class="error-text form-text text-danger"></small>
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
            // Tambahkan event listener untuk progres_1
            $('#progres_1').on('input', function() {
                // Aktifkan input progres_2 jika progres_1 memiliki nilai
                if ($(this).val().trim() !== '') {
                    $('#progres_2').prop('disabled', false);
                } else {
                    // Nonaktifkan dan kosongkan progres_2 jika progres_1 kosong
                    $('#progres_2').prop('disabled', true).val('');
                }
            });

            $("#form-edit").validate({
                rules: {
                    progres_1: {
                        required: true,
                        maxlength: 255
                    },
                    progres_2: {
                        maxlength: 255
                    }
                },
                messages: {
                    progres_1: {
                        required: "Progres 1 harus diisi",
                        maxlength: "Progres 1 maksimal 255 karakter"
                    },
                    progres_2: {
                        maxlength: "Progres 2 maksimal 255 karakter"
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
                                dataDetailKompen.ajax.reload(); // Reload data table
                            } else {
                                $('.error-text').text(''); // Clear error texts
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
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: xhr.responseJSON.message || 'Gagal memproses data'
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
@endempty