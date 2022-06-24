<form action="{{ route('admin.pasien.update', $pasien->id) }}" method="POST">
  <div class="modal-header">
    <h5 class="modal-title">Edit Pasien</h5>
    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
    @method('PUT')
    @csrf
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" name="nama" class="form-control" id="nama" value="{{ $pasien->user->nama }}">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="text" name="email" class="form-control" id="email" value="{{ $pasien->user->email }}">
</div>
<div class="mb-3">
  <label for="nohp" class="form-label">No Hp</label>
  <input type="text" name="nohp" class="form-control" id="nohp" value="{{ $pasien->user->no_hp }}">
</div>
<div class="mb-3">
  <label for="alamat" class="form-label">Alamat</label>
  <input type="text" name="alamat" class="form-control" id="alamat" value="{{ $pasien->alamat }}">
</div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary text-white">Edit</button>
    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
  </div>
</form>
