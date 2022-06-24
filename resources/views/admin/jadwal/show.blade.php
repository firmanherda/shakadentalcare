<div class="modal-header">
  <h5 class="modal-title">Detail Jadwal</h5>
  <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <h5>Jadwal</h5>
    <ul class="list-group list-group-flush mb-3">
        <li class="list-group-item">Dokter: {{ $jadwal->dokter->user->nama }}</li>
        <li class="list-group-item">Waktu Mulai: {{ $jadwal->start }}</li>
        <li class="list-group-item">Waktu Akhir: {{ $jadwal->end }}</li>
        <form class="align-right" action="{{route('admin.jadwal.destroy', $jadwal->id)}}" method="POST">
          {{ method_field("DELETE")}}
          {{ csrf_field() }}
          <button id="btnHapusJadwal" class="btn btn-danger text-white" >Hapus</button>
          <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
        </form>

    </ul>
    <h5>Pasien</h5>
    <ul class="list-group list-group-flush overflow-auto">
        @foreach ($jadwal->slot as $slot)
            @if (isset($slot->booking))
                <li class="list-group-item">Slot {{$slot->nomor}}: {{ $slot->booking->pasien->user->nama }}</li>
            @else
                <li class="list-group-item">Slot {{$slot->nomor}}: Kosong</li>
            @endif
        @endforeach
    </ul>
</div>
<div class="modal-footer">

</div>
