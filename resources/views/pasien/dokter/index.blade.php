@extends('layouts.app')

@section('title', 'Dokter')
@section('content')
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Dokter</h1>
    </div>
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive p-1">
          <table id="tableDokter" class="table" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Servis</th>
                {{-- <th>Tanggal Terdaftar</th> --}}
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($dokters as $dokter)
                <tr class="listDokter">
                  <td>{{ $dokter->user->nama }}</td>
                  <td>
                    @foreach ($dokter->service as $service)
                      <span class="badge bg-primary">{{ $service->nama }}</span>
                    @endforeach
                  </td>
                  {{-- <td data-order="{{ $dokter->created_at }}">
                    {{ $dokter->created_at->translatedFormat('d F Y') }}</td> --}}
                  <td class="text-center">
                    <button id="btnShowDokter" data-id="{{ $dokter->id }}"
                      class="btn btn-sm btn-primary text-white">Detail</button>
                  </td>
               </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div id="modalDokter" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">

        {{-- Loading --}}
        <div id="modalLoading" class="row h-100 align-items-center">
          <div class="col align-self-center">
            <div class="d-flex my-5 justify-content-center">
              <div class="spinner-border" role="status">
                <span class="sr-only">Memuat...</span>
              </div>
            </div>
          </div>
        </div>

        {{-- Content --}}
        <div id="modalDokterContent"></div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      $('#btnTambahDokter').click(function() {
        $('#modalDokter').modal('show');
        $('#modalDokterContent').html('');
        $('#modalLoading').show();
        $.get(`dokter/create`, function(res) {
          $('#modalLoading').hide();
          $('#modalDokterContent').html(res);
        });
      });

      $('.listDokter #btnShowDokter').click(function() {
        const id = $(this).data('id');
        $('#modalDokter').modal('show');
        $('#modalDokterContent').html('');
        $('#modalLoading').show();
        $.get(`dokter/${id}`, function(res) {
          $('#modalLoading').hide();
          $('#modalDokterContent').html(res);
        });
      });

      $('.listDokter #btnEditDokter').click(function() {
        const id = $(this).data('id');
        $('#modalDokter').modal('show');
        $('#modalDokterContent').html('');
        $('#modalLoading').show();
        $.get(`dokter/${id}/edit`, function(res) {
          $('#modalLoading').hide();
          $('#modalDokterContent').html(res);
        });
      });

      $('#tableDokter').DataTable({
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
        },
        columns: [{
            name: 'Nama',
            orderable: true
          },
          {
            name: 'Service',
            orderable: false
          },
          // {
          //   name: 'Tanggal Terdaftar',
          //   orderable: true
          // },
          {
            name: '',
            orderable: false
          }
        ]
      });
    });
  </script>
@endpush
