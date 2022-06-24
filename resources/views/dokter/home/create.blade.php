<div class="modal-header">
  <h5 class="modal-title">Buat Transaksi</h5>
  <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">

  </button>
</div>
<div class="modal-body">
  <h6>Detail</h6>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Nama: {{ $booking->pasien->user->nama }}</li>
    <li class="list-group-item">No. HP: {{ $booking->pasien->user->no_hp }}</li>
    <li class="list-group-item">Service: {{ $booking->service->nama }}</li>
  </ul>

  <div class="form-inline mx-1 my-4">
    <div class="input-group w-100">
      <div class="input-group-prepend">
        <div class="input-group-text">Rp</div>
      </div>
      <input name="total" type="text" id="totalTransaksi" class="form-control" placeholder="Total">
    </div>
  </div>

  <div class="form-group">
    <label class="form-label" for="catatan">Catatan</label>
    <textarea name="catatan" id="catatanTransaksi" rows="2" class="form-control"></textarea>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-primary text-white" id="btnBuat">Selesai</button>
</div>
