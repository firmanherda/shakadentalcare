<div class="modal-header">
  <h5 class="modal-title">Detail Booking</h5>
  <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
  <div class="mb-3">
    <h5>Jadwal</h5>
    <div class="mx-2 mt-1">
      <div class="row">
        <dt class="col-4">Tanggal</dt>
        <dd class="col-8">{{ $tanggal }}</dd>
      </div>
      <div class="row">
        <dt class="col-4">Jumlah Slot</dt>
        <dd class="col-8">{{ $slot }}</dd>
      </div>
      <div class="row">
        <dt class="col-4">Waktu Mulai</dt>
        <dd class="col-8">{{ $end }}</dd>
      </div>
      <div class="row">
        <dt class="col-4">Waktu Akhir</dt>
        <dd class="col-8">{{ $start }}</dd>
      </div>
    </div>
  </div>
  <div class="mb-3">
    <h5>Dokter</h5>
    <div class="mx-2 mt-1">
      <div class="row">
        <dt class="col-4">Nama</dt>
        <dd class="col-8">{{ $dokter->user->nama }}</dd>
      </div>
      <div class="row">
        <dt class="col-4">Email</dt>
        <dd class="col-8">{{ $dokter->user->email }}</dd>
      </div>
      <div class="row">
        <dt class="col-4">No. HP</dt>
        <dd class="col-8">{{ $dokter->user->no_hp }}</dd>
      </div>
      <div class="row">
        <dt class="col-4">Total</dt>
        <dd class="col-8">{{ $booking->transaksi->total }}</dd>
      </div>
      <div class="row">
        <dt class="col-4">Service</dt>
        <dd class="col-8">
          @foreach ($dokter->service as $service)
            <span class="badge bg-primary">{{ $service->nama }}</span>
          @endforeach
        </dd>
      </div>
    </div>
  </div>
  <div>
    <h5>Pasien</h5>
    <div class="mx-2 mt-1">
      <div class="row">
        <dt class="col-4">Nama</dt>
        <dd class="col-8">{{ $pasien->user->nama }}</dd>
      </div>
      <div class="row">
        <dt class="col-4">Email</dt>
        <dd class="col-8">{{ $pasien->user->email }}</dd>
      </div>
      <div class="row">
        <dt class="col-4">No. HP</dt>
        <dd class="col-8">{{ $pasien->user->no_hp }}</dd>
      </div>
      <div class="row">
        <dt class="col-4">Alamat</dt>
        <dd class="col-8">{{ $pasien->alamat }}</dd>
      </div>
      <div class="row">
        <dt class="col-4">Tanggal Lahir</dt>
        <dd class="col-8">{{ $pasien->tanggal_lahir }}</dd>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
</div>
