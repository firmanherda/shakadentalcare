@extends('layouts.dokter')

@section('title', 'Home')
@section('content')
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Home</h1>
    </div>
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive p-1">
          <table id="tableTransaksi" class="table" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Pasien</th>
                <th>Service</th>
                <th>Biaya</th>
                <th>Catatan</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transaksis as $transaksi)
                <tr class="listTransaksi">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $transaksi->booking->tanggal->translatedFormat('d F Y H:i:s') }}</td>
                  <td>{{ $transaksi->pasien->user->nama }}</td>
                  <td>{{ $transaksi->service->nama }}</td>
                  <td>{{ 'Rp ' . number_format($transaksi->total, 0, ',', '.') }}</td>
                  <td>{{ $transaksi->catatan }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  {{-- <div id="modalTransaksi" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div id="modalLoading" class="row h-100 align-items-center">
          <div class="col align-self-center">
            <div class="d-flex my-5 justify-content-center">
              <div class="spinner-border" role="status">
                <span class="sr-only">Memuat...</span>
              </div>
            </div>
          </div>
        </div>
        <div id="modalTransaksiContent"></div>
      </div>
    </div>
  </div> --}}
@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      $('#tableTransaksi').DataTable({
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
        },
        columns: [{
            name: 'No.',
            orderable: true
          },
          {
            name: 'Tanggal',
            orderable: true
          },
          {
            name: 'Pasien',
            orderable: true
          },
          {
            name: 'Service',
            orderable: true
          },
          {
            name: 'Biaya',
            orderable: true
          },
          {
            name: 'Catatan',
            orderable: false
          },
        ]
      });
    });
  </script>
@endpush
