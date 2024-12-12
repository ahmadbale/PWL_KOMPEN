<div id="modal-master" class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content border-primary">
        <div class="modal-header bg-gradient-primary text-white py-3">
            <h5 class="modal-title d-flex align-items-center">
                <i class="fas fa-info-circle mr-3 fa-lg"></i> 
                <span class="font-weight-bold">Detail Data Pengajuan Kompen</span>
            </h5>
            <button type="button" class="close text-white opacity-75" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="h3">&times;</span>
            </button>
        </div>
        <div class="modal-body p-4">
            <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="icon fas fa-info-circle mr-3 fa-2x"></i>
                    <div>
                        <h5 class="alert-heading mb-1">Status Pengajuan</h5>
                        <p class="mb-0">Berikut adalah Detail Status Pengajuan</p>
                    </div>
                </div>
            </div>
            <form id="updateForm" action="{{ url('/kompen/update-status') }}" method="POST">
                @csrf
                <input type="hidden" name="id_kompen" value="{{ $kompen->id_kompen }}">
                <div class="form-group row">
                    <div class="col-12">
                        <table class="table table-striped table-bordered table-hover shadow-sm">
                            <tbody>
                                <tr class="bg-light">
                                    <th class="text-right col-4 align-middle font-weight-bold">Nomor Kompen</th>
                                    <td class="col-8">{{ $kompen->nomor_kompen }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right col-4 align-middle font-weight-bold">Pemberi Tugas</th>
                                    <td class="col-8">{{ $kompen->personil->nama }}</td>
                                </tr>
                                <tr class="bg-light">
                                    <th class="text-right col-4 align-middle font-weight-bold">Nama Kompen</th>
                                    <td class="col-8">{{ $kompen->nama }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right col-4 align-middle font-weight-bold">Jenis Kompen</th>
                                    <td class="col-8">{{ $kompen->jeniskompen->nama_jenis }}</td>
                                </tr>
                                <tr class="bg-light">
                                    <th class="text-right col-4 align-middle font-weight-bold">Deskripsi</th>
                                    <td class="col-8">{{ $kompen->deskripsi }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right col-4 align-middle font-weight-bold">Tanggal Mulai</th>
                                    <td class="col-8">{{ $kompen->tanggal_mulai}}</td>
                                </tr>
                                <tr class="bg-light">
                                    <th class="text-right col-4 align-middle font-weight-bold">Tanggal Selesai</th>
                                    <td class="col-8">{{ $kompen->tanggal_selesai}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="row">
                            <label for="status" class="col-sm-3 col-form-label text-right font-weight-bold">Status:</label>
                            <div class="col-sm-9">
                                <select name="status" id="status" class="form-control custom-select">
                                    <option value="setuju" {{ $kompen->status == 'setuju' ? 'selected' : '' }}>Setuju</option>
                                    <option value="ditolak" {{ $kompen->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <label for="alasan" class="col-sm-3 col-form-label text-right font-weight-bold">Alasan:</label>
                            <div class="col-sm-9">
                                <input type="text" name="alasan" id="alasan" class="form-control" value="{{ $kompen->alasan }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light mt-3 rounded">
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