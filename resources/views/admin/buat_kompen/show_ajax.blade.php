<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-light">
            <h5 class="modal-title">
                <i class="fas fa-info-circle mr-2"></i> Detail Data Pengajuan Kompen
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="alert alert-info">
                <h5><i class="icon fas fa-info mr-2"></i>Status Pengajuan</h5>
                <p>Berikut adalah Status Pengajuan</p>
            </div>
            <form id="updateForm" action="{{ url('/kompen/update-status') }}" method="POST">
                @csrf
                <input type="hidden" name="id_kompen" value="{{ $kompen->id_kompen }}">
                <div class="form-group row mt-4">
                    <label for="status" class="col-sm-3 col-form-label text-right font-weight-bold">Status:</label>
                    <div class="col-sm-9">
                        <select name="status" id="status" class="form-control">
                            <option value="setuju" {{ $kompen->status == 'setuju' ? 'selected' : '' }}>Setuju</option>
                            <option value="ditolak" {{ $kompen->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="alasan" class="col-sm-3 col-form-label text-right font-weight-bold">Alasan:</label>
                    <div class="col-sm-9">
                        <input type="text" name="alasan" id="alasan" class="form-control" value="{{ $kompen->alasan }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>Kembali
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
