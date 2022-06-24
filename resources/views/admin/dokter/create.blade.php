<form action="{{ route('admin.dokter.store') }}" method="POST" enctype="multipart/form-data">
  <div class="modal-header">
    <h5 class="modal-title">Tambah Dokter</h5>
    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
    @csrf
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" name="nama" class="form-control" id="nama">
    </div>
    <div class="mb-3">
      <label for="nama" class="form-label">Email</label>
      <input type="email" name="email" class="form-control" id="email">
    </div>
    <div class="mb-3">
      <label for="nama" class="form-label">No. HP</label>
      <input type="tel" name="hp" class="form-control" id="hp">
    </div>
    <div class="mb-3">
      <label for="text" class="form-label">Deskripsi Dokter</label>
      <input type="des" name="deskripsi" class="form-control" id="deskripsi">
    </div>
    <div class="mb-3">
      <label for="text" class="form-label">Foto Dokter (JPG/JPEG)</label>
      <input type="file" name="foto" class="form-control" id="file" accept="image/*">
    </div>
    <div class="mb-3">
      <label for="nama" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="password">
    </div>
    <div class="mb-3">
      <label class="from-label">Servis</label>
      @foreach ($services as $service)
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="services[]" value="{{ $service->id }}"
            id="service{{ $service->id }}">
          <label class="form-check-label" for="service{{ $service->id }}">
            {{ $service->nama }}
          </label>
        </div>
      @endforeach
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary text-white">Tambah</button>
    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
  </div>
</form>
