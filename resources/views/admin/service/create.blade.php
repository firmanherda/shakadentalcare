<form action="{{ route('admin.service.store') }}" method="POST">
  <div class="modal-header">
    <h5 class="modal-title">Tambah Service</h5>
    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
    @csrf
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" name="nama" class="form-control" id="nama">
    </div>
    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <textarea name="deskripsi" class="form-control" id="deskripsi"></textarea>
    </div>
  <div class="modal-footer">
    <button class="btn btn-primary text-white" type="submit">Tambah</button>
    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
  </div>
</form>
