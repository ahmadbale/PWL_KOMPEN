<style>
     .modal-content {
        border-radius: 30px !important;
    }
</style>
@empty($mahasiswa)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
    <form action="{{ url('/mahasiswa/' . $mahasiswa->id_mahasiswa . '/detail_ajax') }}" method="POST" id="form-show">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered table-striped">
                    <table class="table table-sm table-bordered table-striped">
                        <tr><th class="test-right col-3">Nomor Induk </th><td class="col-9">{{ $mahasiswa->nomor_induk }}</td></tr>
                        <tr><th class="test-right col-3">Nama Lengkap </th><td class="col-9">{{ $mahasiswa->nama }}</td></tr>
                        <tr><th class="test-right col-3">Semester </th><td class="col-9">{{ $mahasiswa->semester }}</td></tr>
                        <tr><th class="test-right col-3">Jam Alpha </th><td class="col-9">{{ $mahasiswa->jam_alpha}}</td></tr>
                        <tr><th class="test-right col-3">Jam Kompen </th><td class="col-9">{{ $mahasiswa->jam_kompen }}</td></tr>
                        <tr><th class="test-right col-3">Jam Kompen Selesai </th><td class="col-9">{{ $mahasiswa->jam_kompen_selesai }}</td></tr>
                        <tr><th class="test-right col-3">Prodi : </th><td class="col-9">{{ $mahasiswa->prodi->nama_prodi }}</td></tr>
                    </table>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
    </form>
    
<script>
    $(document).ready(function() {
        $("#form-show").validate({
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#modal-master').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataMahasiswa.ajax.reload(); // Reload datatable
                        } else {
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
                            text: 'Gagal memproses permintaan.'
                        });
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
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
