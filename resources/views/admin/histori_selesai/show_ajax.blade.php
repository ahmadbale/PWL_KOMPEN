<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        {{-- Header --}}
        <div class="modal-header"
            style="background: linear-gradient(45deg, #6a11cb, #2575fc); color: white; border-bottom: none;">
            <h5 class="modal-title" id="exampleModalLabel">
                <i class="fas fa-info-circle mr-2"></i>Detail Data History Kompen
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        {{-- Body --}}
        <div class="modal-body" style="background: #f4f6f9; color: #495057;">
            <div class="alert alert-info"
                style="background: #d9f7ff; color: #0056b3; border: 1px solid #bee5eb; border-radius: 8px;">
                <h5><i class="icon fas fa-info-circle mr-2"></i>Status Pengajuan</h5>
                <p class="mb-0">Berikut adalah Status Pengajuan Anda</p>
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
                    <h2 class="text-center">Data Mahasiswa</h2>
                    <thead style="background: #6a11cb; color: white; text-align: center;">
                        <tr>
                            <th width="5%">No</th>
                            <th>Mahasiswa</th>
                            <th>Prodi</th>
                            <th>Jam Kompen</th>
                            <th>Progres Pertama (75%)</th>
                            <th>Progres Kedua (100%)</th>
                            @if($kompen->is_selesai != 1)
                                <th>Status</th>
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detailkompen as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->mahasiswa->nama }}</td>
                                <td class="text-center">{{ $item->mahasiswa->prodi->nama_prodi ?? '-' }}</td>
                                <td class="text-center">{{ $item->mahasiswa->jam_kompen }}</td>
                                <td class="text-center">
                                    @if ($item->progres_2)
                                        <a href="{{ $item->progres_1 }}" class="btn btn-primary btn-sm">Lihat</a>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled>Tunggu</button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($item->progres_2)
                                        <a href="{{ $item->progres_2 }}" class="btn btn-primary btn-sm">Lihat</a>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled>Tunggu</button>
                                    @endif
                                </td>
                                @if($kompen->is_selesai != 1)
                                <td class="text-center">
                                    <span class="badge badge-info status-badge-{{ $item->id_kompen_detail }}" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; border-radius: 0.25rem;">{{ $item->status }}</span>
                                </td>
                                <td class="text-center">
                                    <form id="updateForm-{{ $item->id_kompen_detail }}" class="update-form" action="{{ url('/histori_kompen/update-status') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_kompen_detail" value="{{ $item->id_kompen_detail }}">
                                        <select name="status" id="status-{{ $item->id_kompen_detail }}" class="form-control form-control-sm" style="margin-bottom: 0.5rem;">
                                            <option value="acc" {{ $item->status == 'acc' ? 'selected' : '' }}>Diterima</option>
                                            <option value="reject" {{ $item->status == 'reject' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-sm btn-block">Update</button>
                                        <input type="text" name="id_kompen" value="{{$item->id_kompen}}" hidden>
                                        <input type="text" name="id_mahasiswa" value="{{$item->id_mahasiswa}}" hidden>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Footer --}}
        <div class="modal-footer">
            @if($kompen->is_selesai == 0)
            <form 
                action="{{ route('update-kompen-selesai') }}" 
                method="POST" 
                id="form-update-kompen-selesai"
                data-id="{{ $kompen->id_kompen }}">
                @csrf
                <input type="hidden" name="id_kompen" value="{{ $kompen->id_kompen }}">
                <button 
                    type="submit" 
                    class="btn btn-sm btn-success btn-selesaikan-kompen mr-2"
                >
                    <i class="mr-1"></i> Menyelesaikan Kompen
                </button>
            </form>
            @endif
            <button type="button" data-dismiss="modal" class="btn btn-sm btn-warning">Kembali</button>
        </div>
    </div>
</div>

{{-- Styles --}}
@push('styles')
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
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update status forms
    const updateForms = document.querySelectorAll('.update-form');
    
    updateForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const url = this.action;
            const idDetailKompen = this.querySelector('input[name="id_kompen_detail"]').value;
            const statusSelect = this.querySelector(`#status-${idDetailKompen}`);
            const statusBadge = document.querySelector(`.status-badge-${idDetailKompen}`);
            
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

    // Selesaikan Kompen form
    const formSelesaikanKompen = document.getElementById('form-update-kompen-selesai');
    
    if (formSelesaikanKompen) {
        formSelesaikanKompen.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Tampilkan konfirmasi Sweet Alert
            Swal.fire({
                title: 'Konfirmasi Penyelesaian Kompen',
                text: 'Apakah Anda yakin ingin menandai kompen ini sebagai selesai?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Selesaikan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Ambil URL dan data dari form
                    const url = this.action;
                    const formData = new FormData(this);

                    // Kirim request dengan fetch
                    fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        // Pastikan response dapat diproses
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Cek status berdasarkan struktur respons umum Laravel
                        if (data.status || data.success) {
                            Swal.fire(
                                'Berhasil!',
                                data.message || 'Kompen berhasil diselesaikan',
                                'success'
                            ).then(() => {
                                // Reload halaman atau update UI
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Gagal!',
                                data.message || 'Gagal menyelesaikan kompen',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat memproses permintaan.',
                            'error'
                        );
                    });
                }
            });
        });
    }

    // Fungsi untuk membuka link progres
    document.addEventListener('DOMContentLoaded', function() {
    // Tambahkan event listener untuk semua tombol progres
    document.querySelectorAll('.progress-btn').forEach(button => {
        button.addEventListener('click', function() {
            var progressLink = this.getAttribute('data-link');
            
            if (progressLink) {
                // Coba membuka link
                try {
                    window.open(progressLink, '_blank');
                } catch (error) {
                    console.error('Gagal membuka link:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan',
                        text: 'Tidak dapat membuka link progres'
                    });
                }
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Tidak Ada Progres',
                    text: 'Belum ada progres untuk ditampilkan'
                });
            }
        });
    });
});
});
</script>
@endpush