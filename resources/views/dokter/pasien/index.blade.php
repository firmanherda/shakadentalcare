@extends('layouts.dokter')

@section('title', 'pasien')
@section('content')
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Pasien</h1>
    </div>
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive p-1">
          <table id="tablePasien" class="table" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>Pasien</th>
                <th>Alamat</th>
                <th>Tgl. Lahir</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pasiens as $pasien)
                <tr class="listPasien">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $pasien->user->nama }}</td>
                  <td>{{ $pasien->alamat }}</td>
                  <td>{{ $pasien->tanggal_lahir->translatedFormat('d F Y') }}</td>
                  <td class="text-center">
                    <button data-id="{{ $pasien->id }}"
                      class="btnShowPasien btn btn-sm btn-primary me-1 text-white">Detail</button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div id="modalPasien" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
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

        <div id="modalPasienContent"></div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      $('#tablePasien').DataTable({
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
        },
        columns: [{
            name: 'No.',
            orderable: true
          },
          {
            name: 'Nama',
            orderable: true
          },
          {
            name: 'Alamat',
            orderable: false
          },
          {
            name: 'Tgl. Lahir',
            orderable: true
          },
          {
            name: '',
            orderable: false
          },
        ]
      });

      $('.btnShowPasien').click(function() {
        const id = $(this).data('id');

        $('#modalPasien').modal('show');
        $('#modalPasienContent').html('');
        $('#modalLoading').show();
        $.get(route('dokter.pasien.show', id), function(res) {
          $('#modalLoading').hide();
          $('#modalPasienContent').html(res);
        });
      });
    });
  </script>
@endpush
