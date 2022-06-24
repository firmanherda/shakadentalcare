@extends('layouts.admin')

@section('title', 'Service')
@section('content')
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Service</h1>
    <button id="btnTambahService" class="d-sm-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-plus fa-sm text-white-50"></i>
      <span class="ms-1 text-white">Tambah Service</span>
    </button>
  </div>
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive p-1">
        <table id="tableService" class="table" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Deskripsi</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($services as $ser)
            <tr class="listService">
                <td>{{ $ser->nama }}</td>
                <td>{{ $ser->deskripsi }}</td>
                <td class="text-center">
                  {{-- <button data-id="{{ $ser->id }}"
                    class="btn btn-sm btn-primary me-1 text-white btnShowService">Detail</button> --}}
                  <button  data-id="{{ $ser->id }}"
                    class="btn btn-sm btn-secondary text-white btnEditService">Edit</button>
                </td>
              </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div id="modalService" class="modal fade" tabindex="-1">
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
      <div id="modalServiceContent"></div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    $('#btnTambahService').click(function() {
      $('#modalService').modal('show');
      $('#modalServiceContent').html('');
      $('#modalLoading').show();
      $.get(`service/create`, function(res) {
        $('#modalLoading').hide();
        $('#modalServiceContent').html(res);
      });
    });
    $('.listService .btnShowService').click(function() {
        const id = $(this).data('id');
        $('#modalService').modal('show');
        $('#modalServiceContent').html('');
        $('#modalLoading').show();
        $.get(`service/${id}`, function(res) {
          $('#modalLoading').hide();
          $('#modalServiceContent').html(res);
        });
      });

      $('.listService .btnEditService').click(function() {
        const id = $(this).data('id');
        $('#modalService').modal('show');
        $('#modalServiceContent').html('');
        $('#modalLoading').show();
        $.get(`service/${id}/edit`, function(res) {
          $('#modalLoading').hide();
          $('#modalServiceContent').html(res);
        });
      });

    $('#tableService').DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
      },
      columns: [{
          name: 'Nama',
          orderable: true
        },
        {
          name: 'Deskripsi',
          orderable: false
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
