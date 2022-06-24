<form action="{{ route('admin.pasien.store') }}" method="POST">
  <div class="modal-header">
    <h5 class="modal-title">Tambah Pasien</h5>
    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
    @csrf
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" name="nama" class="form-control" id="nama">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" class="form-control" id="email">
    </div>
    <div class="mb-3">
      <label for="no_hp" class="form-label">No. HP</label>
      <input type="tel" name="no_hp" class="form-control" id="hp">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="password">
    </div>
    <div class="mb-3">
      <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
      <input type="date" name="tanggal_lahir" max="{{ date('Y-m-d') }}" class="form-control" id="tglLahir">
    </div>
    <div class="mb-3">
      <label for="alamat" class="form-label">Alamat</label>
      <input type="text" name="alamat" class="form-control" id="alamat">
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary text-white" type="submit">Tambah</button>
    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
  </div>
</form>
