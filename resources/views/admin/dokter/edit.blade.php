<form action="{{ route('admin.dokter.update', $dokter->id) }}" method="POST">
  <div class="modal-header">
    <h5 class="modal-title">Edit Dokter</h5>
    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
    @method('PUT')
    @csrf
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" name="nama" class="form-control" id="nama" value="{{ $dokter->user->nama }}">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="text" name="email" class="form-control" id="email" value="{{ $dokter->user->email }}">
    </div>
    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <input type="text" name="deskripsi" class="form-control" id="deskripsi" value="{{ $dokter->deskripsi }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Servis</label>
      @foreach ($services as $service)
        <div class="form-check">
          <input id="service{{ $service->id }}" class="form-check-input" type="checkbox" name="services[]"
            value="{{ $service->id }}" @if (in_array($service->id, $servisDokter)) checked @endif>
          <label class="form-check-label" for="service{{ $service->id }}">
            {{ $service->nama }}
          </label>
        </div>
      @endforeach
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary text-white">Edit</button>
    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
  </div>
</form>
