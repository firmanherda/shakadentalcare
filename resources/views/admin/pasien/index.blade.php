@extends('layouts.admin')

@section('title', 'Pasien')
@section('content')
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Pasien</h1>
    <button id="btnTambahPasien" class="d-sm-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-plus fa-sm text-white-50"></i>
      <span class="ms-1 text-white">Tambah Pasien</span>
    </button>
  </div>
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive p-1">
        <table id="tablePasien" class="table" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Email</th>
              <th>No. HP</th>
              <th>Alamat</th>
              <th>Tanggal Lahir</th>
              <th>Tanggal Terdaftar</th>
              <th></th>

            </tr>
          </thead>
          <tbody>
            @foreach ($pasiens as $pasien)
              <tr class="listPasien">
                <td>{{ $pasien->user->nama }}</td>
                <td>{{$pasien->user->email}}</td>
                <td>{{ $pasien->user->no_hp }}</td>
                <td>{{ $pasien->alamat }}</td>
                <td>{{ $pasien->tanggal_lahir->translatedFormat('d F Y') }}</td>
                <td data-order="{{ $pasien->user->created_at }}">
                  {{ $pasien->user->created_at->translatedFormat('d F Y') }}</td>
                <td class="text-center">
                  <button id="btnDetailPasien" class="btn btn-sm btn-primary text-white"
                    data-id="{{ $pasien->id }}">Detail</button>
                    <button id="btnEditPasien" data-id="{{ $pasien->id }}"
                      class="btn btn-sm btn-secondary ms-1 text-white">Edit</button>
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
  <div class="modal-dialog modal-xl">
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
      <div id="modalPasienContent"></div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    $('#btnTambahPasien').click(function() {
      $('#modalPasien').modal('show');
      $('#modalPasienContent').html('');
      $('#modalLoading').show();
      $.get(`pasien/create`, function(res) {
        $('#modalLoading').hide();
        $('#modalPasienContent').html(res);
      });
    });
    $('.listPasien #btnEditPasien').click(function() {
        const id = $(this).data('id');
        $('#modalPasien').modal('show');
        $('#modalPasienContent').html('');
        $('#modalLoading').show();
        $.get(`pasien/${id}/edit`, function(res) {
          $('#modalLoading').hide();
          $('#modalPasienContent').html(res);
        });
      });

    $('.listPasien #btnDetailPasien').click(function() {
      const id = $(this).data('id');
      $('#modalPasien').modal('show');
      $('#modalPasienContent').html('');
      $('#modalLoading').show();
      $.get(`pasien/${id}`, function(res) {
        $('#modalLoading').hide();
        $('#modalPasienContent').html(res);
      });
    });

    $('#tablePasien').DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
      },
      columns: [{
          name: 'Nama',
          orderable: true
        },
        {
          name: 'Email',
          orderable: true
        },
        {
          name: 'No. HP',
          orderable: true
        },
        {
          name: 'Alamat',
          orderable: false
        },
        {
          name: 'Tanggal Lahir',
          orderable: true
        },
        {
          name: 'Tanggal Terdaftar',
          orderable: true
        },
        {
          name: '',
          orderable: false
        }
      ]

    });
  });
</script>
@endpush
