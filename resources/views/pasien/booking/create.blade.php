<div class="modal-header">
    <h5 class="modal-title">Tambah Booking</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

    </button>
</div>
<div class="modal-body">
  @csrf
  <div class="mb-3">
      <label class="from-label">Service</label>
      <select id="selectService" name="service" class="form-select form-control" required>
          <option selected disabled>Pilih service</option>
          @foreach ($services as $service)
              <option value="{{ $service->id }}">{{ $service->nama }}</option>
          @endforeach
      </select>
  </div>
</div>
<div class="modal-footer">
  <button id="btnBooking" class="btn btn-primary text-white">Tambah</button>
  <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
</div>
