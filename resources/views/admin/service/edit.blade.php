<form action="{{ route('admin.service.update', $service->id) }}" method="POST">
  <div class="modal-header">
    <h5 class="modal-title">Edit Service</h5>
    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
    @method('PUT')
    @csrf
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" name="nama" class="form-control" id="nama" value="{{ $service->nama }}">
    </div>
    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <textarea name="deskripsi" class="form-control" id="deskripsi" >{{$service->deskripsi}}</textarea>
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary text-white">Edit</button>
    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
  </div>
</form>
