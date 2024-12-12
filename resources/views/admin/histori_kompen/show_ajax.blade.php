<!-- Modal Content -->
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <!-- Header -->
        <div class="modal-header" style="background: linear-gradient(45deg, #6a11cb, #2575fc); color: white; border-bottom: none;">
            <h5 class="modal-title" id="exampleModalLabel">
                <i class="fas fa-info-circle mr-2"></i>Detail Data history Kompen
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!-- Body -->
        <div class="modal-body" style="background: #f4f6f9; color: #495057;">
            <div class="alert alert-info" style="background: #d9f7ff; color: #0056b3; border: 1px solid #bee5eb; border-radius: 8px;">
                <h5><i class="icon fas fa-info-circle mr-2"></i>Status Pengajuan</h5>
                <p style="margin-bottom: 0;">Berikut adalah Status Pengajuan Anda</p>
            </div>

            <div class="form-group row mt-4">
                <div class="modal-body">
                    <table class="table table-sm table-bordered table-striped">
                        <tr>
                            <th class="text-right col-3" style="background-color: #f1f1f1;">Nomor Kompen :</th>
                            <td class="col-9">{{ $kompen->nomor_kompen }}</td>
                        </tr>
                        <tr>
                            <th class="text-right col-3" style="background-color: #f1f1f1;">Nama Kompen:</th>
                            <td class="col-9">{{ $kompen->nama }}</td>
                        </tr>
                        <tr>
                            <th class="text-right col-3" style="background-color: #f1f1f1;">Jenis Kompen:</th>
                            <td class="col-9">{{ $kompen->jeniskompen->nama_jenis }}</td>
                        </tr>
                        <tr>
                            <th class="text-right col-3" style="background-color: #f1f1f1;">Deskripsi :</th>
                            <td class="col-9">{{ $kompen->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th class="text-right col-3" style="background-color: #f1f1f1;">Tanggal Mulai :</th>
                            <td class="col-9">{{ $kompen->tanggal_mulai }}</td>
                        </tr>
                        <tr>
                            <th class="text-right col-3" style="background-color: #f1f1f1;">Tanggal Selesai :</th>
                            <td class="col-9">{{ $kompen->tanggal_selesai }}</td>
                        </tr>
                    </table>
                </div>

                <table class="table table-bordered table-hover table-sm mt-4">
                    <thead style="background: #6a11cb; color: white; text-align: center;">
                        <tr>
                            <th width="5%">No</th>  
                            <th>Mahasiswa</th>
                            <th>Prodi</th>
                            <th>Jam Kompen</th>
                            <th>Progres Pertama (75%)</th>
                            <th>Progres Kedua (100%)</th>
                            <th>Status</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detailkompen as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $item->mahasiswa->nama }}</td>
                            <td class="text-center">{{ $item->mahasiswa->prodi->nama_prodi ?? '-' }}</td>\
                            <td class="text-center">{{ $item->mahasiswa->jam_kompen}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer -->
        <div class="modal-footer" style="background: #f9f9f9; border-top: none;">
            <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    .modal-content {
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .btn {
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .table thead th {
        border: none;
    }

    .table tbody tr:hover {
        background: rgba(106, 17, 203, 0.05);
    }

    .alert {
        border-radius: 8px;
    }
</style>

<!-- Include SweetAlert2 from CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const updateForms = document.querySelectorAll('.update-form');
    
    updateForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const url = this.action;
            const idPengajuanKompen = this.querySelector('input[name="id_pengajuan_kompen"]').value;
            const statusSelect = this.querySelector(`#status-${idPengajuanKompen}`);
            const statusBadge = document.querySelector(`.status-badge-${idPengajuanKompen}`);
            
            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update status badge
                    statusBadge.textContent = statusSelect.value === 'acc' ? 'Diterima' : 
                                              (statusSelect.value === 'reject' ? 'Ditolak' : 'Pending');
                    
                    // Show success Sweet Alert
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Status pengajuan kompen berhasil diperbarui',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    // Show error Sweet Alert
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: data.message || 'Terjadi kesalahan saat memperbarui status'
                    });
                }
            })
            .catch(error => {
                // Show error Sweet Alert for network or other errors
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan',
                    text: 'Terjadi kesalahan dalam memproses permintaan'
                });
                console.error('Error:', error);
            });
        });
    });
});
</script>