<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title">Detail Pasien</h5>
    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">

    </button>
  </div>
  <div class="modal-body">
    <div>
      <h5>Riwayat Booking</h5>

      <table class="table w-100">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Service</th>
            <th>Catatan</th>
            <th>Biaya</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($transaksis as $transaksi)
            <tr>
              <td>{{ $transaksi->booking->tanggal->translatedFormat('d F Y H:i:s') }}</td>
              <td>{{ $transaksi->booking->service->nama }}</td>
              <td>{{ $transaksi->booking->transaksi->catatan }}</td>
              <td>{{ 'Rp ' . number_format($transaksi->total, 0, ',', '.') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
  </div>
</div>
