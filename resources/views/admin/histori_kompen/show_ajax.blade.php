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

                <table class="table table-bordered table-hover table-sm mt-4">
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
                                    @if ($item->progres_1)
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
                                {{-- <td class="text-center">
                                    <span class="badge badge-info status-badge-{{ $item->id_kompen_detail }}" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; border-radius: 0.25rem;">{{ $item->status }}</span>
                                </td> --}}
                                <td class="text-center">
                                    <span class="badge badge-info status-badge-{{ $item->id_kompen_detail }} 
                                        {{ $item->status == 'pending' ? 'status-badge-pending' : '' }}" 
                                        style="padding: 0.25rem 0.5rem; font-size: 0.875rem; border-radius: 0.25rem;">
                                        {{ $item->status }}
                                    </span>
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
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

     {{-- Flash Messages --}}
@if(session('success'))
<script>
    Swal.fire({
        title: 'Berhasil',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonText: 'Tutup'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        title: 'Gagal',
        text: '{{ session('error') }}',
        icon: 'error',
        confirmButtonText: 'Tutup'
    });
</script>
@endif

@if(session('warning'))
<script>
    // Get the pending count from the session
    let pendingCount = @json(session('pending_count'));
    
    // Show warning message with the pending count
    Swal.fire({
        title: 'Peringatan',
        text: '{{ session('warning') }}' + ' (Terdapat ' + pendingCount + ' pengajuan pending)',
        icon: 'warning',
        confirmButtonText: 'Tutup'
    });
</script>
@endif

{{-- Footer --}}
<div class="modal-footer">
@if($kompen->is_selesai == 0)
<form action="{{ route('update-kompen-selesai') }}" method="POST" id="form-update-kompen-selesai">
    @csrf
    <input type="hidden" name="id_kompen" value="{{ $kompen->id_kompen }}">
    <button type="submit" class="btn btn-sm btn-success btn-selesaikan-kompen">
        <i class="fas fa-check mr-1"></i> Selesaikan Kompen
    </button>
</form>
@endif
<button type="button" data-dismiss="modal" class="btn btn-sm btn-warning">Kembali</button>
</div>

{{-- Include SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- Modify the existing script section --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formSelesaikanKompen = document.getElementById('form-update-kompen-selesai');
    
        if (formSelesaikanKompen) {
            formSelesaikanKompen.addEventListener('submit', function(e) {
                e.preventDefault();
    
                // Count pending status items
                const pendingItems = document.querySelectorAll('.status-badge-pending').length;
    
                if (pendingItems > 0) {
                    // Show error if there are pending items
                    Swal.fire({
                        title: 'Error',
                        text: `Tidak dapat menyelesaikan kompen. Masih terdapat ${pendingItems} pengajuan dengan status pending.`,
                        icon: 'error',
                        confirmButtonText: 'Tutup'
                    });
                } else {
                    // Proceed with confirmation if no pending items
                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Apakah Anda yakin ingin menyelesaikan kompen ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Selesaikan!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                }
            });
        }
    });
    </script>