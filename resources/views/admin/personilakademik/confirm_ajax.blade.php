@empty($personil)
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
                    <h5><i class="icon fas fa-ban"></i>Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/personilakademik') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
<<<<<<< HEAD:resources/views/personilakademik/confirm_ajax.blade.php
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data Personil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <h5><i class="icon fas fa-info"></i> Data Personil Akademik </h5>
                    Berikut adalah detail dari data personil akademik
                </div>
                <table class="table table-sm table-bordered table-stripped">
                    <tr>
                        <th class="text-right col-3">Nomor Induk :</th>
                        <td class="col-9">{{ $personil->nomor_induk }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Username :</th>
                        <td class="col-9">{{ $personil->username }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Nama :</th>
                        <td class="col-9">{{ $personil->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Nomor Telepon :</th>
                        <td class="col-9">{{ $personil->nomor_telp }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">ID Level :</th>
                        <td class="col-9">{{ $personil->level->nama_level}}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Kembali</button>
            </div>
        </div>
    </div>
=======
    <form action="{{ url('/personilakademik/' . $personil->id_personil . '/delete_ajax') }}" method="POST" id="form-delete">
        @csrf
        @method('DELETE')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Level</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <h5><i class="icon fas fa-ban"></i> Konfirmasi !!! </h5>
                        Apakah Anda ingin menghapus data seperti dibawah ini?
                    </div>
                    <table class="table table-sm table-bordered table-stripped">
                        <tr>
                            <th class="text-right col-3">Nomor Induk :</th>
                            <td class="col-9">{{ $personil->nomor_induk }}</td>
                        </tr>
                        <tr>
                            <th class="text-right col-3">Username :</th>
                            <td class="col-9">{{ $personil->username }}</td>
                        </tr>
                        <tr>
                            <th class="text-right col-3">Nama :</th>
                            <td class="col-9">{{ $personil->nama }}</td>
                        </tr>
                        <tr>
                            <th class="text-right col-3">Nomor Telepon :</th>
                            <td class="col-9">{{ $personil->nomor_telp }}</td>
                        </tr>
                        <tr>
                            <th class="text-right col-3">ID Level :</th>
                            <td class="col-9">{{ $personil->level->nama_level}}</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function(){
            $("#form-delete").validate({
                rules:{},
                submitHandler: function(form){
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response){
                            if(response.status){
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.massage
                                });
                                dataPersonil.ajax.reload();
                            } else{
                                $('.error-text').text('')
                                $.each(response.msgField, function(prefix, val){
                                    $('#error-'+prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.massage
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function (error, element){
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
>>>>>>> db834c6445b3c379aa6770a0a5e2e0bb89c848d8:resources/views/admin/personilakademik/confirm_ajax.blade.php
@endempty