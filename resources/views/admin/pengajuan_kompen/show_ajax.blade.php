@empty($pengajuankompen)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8d7da; color: #721c24; border-bottom: 1px solid #f5c6cb;">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Kesalahan
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #721c24;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #fff3cd; color: #856404;">
                <div class="alert alert-danger" style="background-color: #f8d7da; border-color: #f5c6cb;">
                    <h5><i class="icon fas fa-ban mr-2"></i>Kesalahan!!!</h5>
                    <p style="margin-bottom: 0;">Data pengajuan kompensasi yang Anda cari tidak ditemukan.</p>
                </div>
                <a href="{{ url('/pengajuankompen') }}" class="btn btn-warning mt-3" style="background-color: #ffc107; border-color: #ffc107; color: #212529;">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #e9ecef; border-bottom: 1px solid #dee2e6;">
                <h5 class="modal-title" id="exampleModalLabel" style="color: #495057;">
                    <i class="fas fa-info-circle mr-2"></i>Detail Data Pengajuan Kompen
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #495057;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #f8f9fa;">
                <div class="alert alert-info" style="background-color: #d1ecf1; border-color: #bee5eb; color: #0c5460;">
                    <h5><i class="icon fas fa-info mr-2"></i>Status Pengajuan</h5>
                    <p style="margin-bottom: 0;">Berikut adalah Status Pengajuan</p>
                </div>
                <form id="updateForm" action="{{ url('/pengajuankompen/update-status') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_pengajuan_kompen" value="{{ $pengajuankompen->id_pengajuan_kompen }}">
                    <div class="form-group row mt-4">
                        <label for="status" class="col-sm-3 col-form-label text-right font-weight-bold">Status:</label>
                        <div class="col-sm-9">
                            <select name="status" id="status" class="form-control" style="border: 1px solid #ced4da; border-radius: 0.25rem;">
                                <option value="pending" {{ $pengajuankompen->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="acc" {{ $pengajuankompen->status == 'acc' ? 'selected' : '' }}>Diterima</option>
                                <option value="reject" {{ $pengajuankompen->status == 'reject' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #dee2e6; padding-top: 1rem;">
                        <button type="submit" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff;">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                        <button type="button" data-dismiss="modal" class="btn btn-warning" style="background-color: #ffc107; border-color: #ffc107; color: #212529;">
                            <i class="fas fa-times mr-2"></i>Kembali
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endempty

<style>
    .modal-content {
        border-radius: 0.5rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    .btn {
        border-radius: 0.25rem;
        transition: all 0.2s ease-in-out;
    }
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
    }
    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('updateForm');
    const statusSelect = document.getElementById('status');
    const submitButton = form.querySelector('button[type="submit"]');

    statusSelect.addEventListener('change', function() {
        submitButton.classList.add('btn-pulse');
        setTimeout(() => submitButton.classList.remove('btn-pulse'), 500);
    });

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
        submitButton.disabled = true;
        
        // Simulate form submission (replace with actual AJAX call)
        setTimeout(() => {
            submitButton.innerHTML = '<i class="fas fa-check mr-2"></i>Tersimpan!';
            submitButton.classList.remove('btn-primary');
            submitButton.classList.add('btn-success');
            setTimeout(() => {
                // Reset button state (in real scenario, you might close the modal here)
                submitButton.innerHTML = '<i class="fas fa-save mr-2"></i>Simpan Perubahan';
                submitButton.classList.remove('btn-success');
                submitButton.classList.add('btn-primary');
                submitButton.disabled = false;
            }, 2000);
        }, 1500);
    });
});
</script>

<style>
@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(0, 123, 255, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(0, 123, 255, 0);
    }
}
.btn-pulse {
    animation: pulse 0.5s;
}
</style>