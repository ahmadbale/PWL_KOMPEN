@empty($kompen)
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
                <a href="{{ url('/cari_kompen') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data Kompen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <h5><i class="icon fas fa-info"></i> Detail Kompen </h5>
                </div>
                <table class="table table-sm table-bordered table-stripped">
                    <tr>
                        <th class="text-right col-3">Nomor Kompen :</th>
                        <td class="col-9">{{ $kompen->nomor_kompen }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Pemberi Tugas :</th>
                        <td class="col-9">{{ $kompen->personil->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Nama Kompen:</th>
                        <td class="col-9">{{ $kompen->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Jenis Kompen:</th>
                        <td class="col-9">{{ $kompen->jeniskompen->nama_jenis }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Deskripsi :</th>
                        <td class="col-9">{{ $kompen->deskripsi }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Tanggal Mulai :</th>
                        <td class="col-9">{{ $kompen->tanggal_mulai}}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Tanggal Selesai :</th>
                        <td class="col-9">{{ $kompen->tanggal_selesai}}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <form action="{{ url('/cari_kompen/ajukan_kompen') }}" method="POST" id="form-pengajuan">
                    @csrf
                    <input type="hidden" name="id_kompen" value="{{ $kompen->id_kompen }}">
                    <button type="submit" class="btn btn-sm btn-primary">Ajukan Kompen</button>
                </form>
                <button type="button" data-dismiss="modal" class="btn btn-warning">Kembali</button>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $("#form-pengajuan").on('submit', function(e) {
            e.preventDefault();
            
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        $('#myModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            // Optional: add a callback to refresh or redirect
                            didClose: function() {
                                // Optionally reload the page or update the view
                                location.reload();
                                // OR
                                // window.location.href = '/your-redirect-url';
                            }
                        });
                    } else {
                        // Show error alert
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: response.message
                        });
                    }
                },
                error: function(xhr) {
                    // Handle validation or server errors
                    let errorMessage = 'Terjadi kesalahan pada server';
                    
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        errorMessage = Object.values(errors).flat().join('\n');
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan',
                        text: errorMessage
                    });
                }
            });
        });
    });
    </script>
@endempty