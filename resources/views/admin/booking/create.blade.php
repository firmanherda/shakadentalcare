<form action="{{ route('admin.booking.store') }}" method="POST">
  <div class="modal-header">
    <h5 class="modal-title">Tambah Booking</h5>
    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
    @csrf
    <div class="mb-3">
      <label class="form-label" for="pasien">Pasien</label>
      <select id="selectPasien" name="pasien" class="form-control" data-label="pasien"
        required>
        @foreach ($pasiens as $pasien)
          <option value="{{ $pasien->id }}">{{ $pasien->user->nama }}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label class="from-label">Dokter</label>
      <select id="selectDokter" class="form-control" data-label="dokter" required>
        @foreach ($dokters as $dokter)
          <option value="{{ $dokter->user->id }}">{{ $dokter->user->nama }}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label class="from-label">Service</label>
      <select id="selectService" name="service" class="form-control" data-label="service"
        required>
      </select>
    </div>
    <div class="mb-3">
      <label class="from-label">Jadwal</label>
      <select id="selectJadwal" class="form-control" data-label="jadwal" required>
      </select>
    </div>
    <div class="mb-3">
      <label class="from-label">Slot</label>
      <select id="selectSlot" name="slot" class="form-control" data-label="slot" required>
      </select>
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary text-white">Tambah</button>
    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
  </div>
</form>
