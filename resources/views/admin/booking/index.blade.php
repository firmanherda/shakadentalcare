@extends('layouts.admin')

@section('title', 'Booking')
@section('content')
<div class="container-fluid">
  {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Booking</h1>
    <button id="btnTambahBooking" class="d-sm-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-plus fa-sm text-white-50"></i>
      <span class="ms-1 text-white">Tambah Booking</span>
    </button>
  </div> --}}

  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive p-1">
        <table id="tableBooking" class="table" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Pasien</th>
              <th>Dokter</th>
              <th>Servis</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($bookings as $booking)
              <tr class="listBooking">
                <td>{{ $booking->pasien->user->nama }}</td>
                <td>{{ $booking->slot->jadwal->dokter->user->nama }}</td>
                <td>
                  <span class="badge bg-primary">{{ $booking->service->nama }}</span>
                </td>
                <td> {{ $booking->status}}</td>
                <td class="text-center">
                  <button class="btnShowBooking btn btn-sm btn-primary text-white"
                    data-id="{{ $booking->id }}">Detail</button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div id="modalBooking" class="modal fade">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
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

      <div id="modalBookingContent"></div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    $('.toast').toast();
    $('#tableBooking').DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
      },
      columns: [{
          name: 'Pasien',
          orderable: true
        },
        {
          name: 'Dokter',
          orderable: true
        },
        {
          name: 'Service',
          orderable: true
        },
        {
          name: 'Status',
          orderable: true
        },
        {
          name: '',
          orderable: false
        }
      ]
    });

    $('#btnTambahBooking').click(function() {
      $('#modalBooking').modal('show');
      $('#modalBookingContent').html('');
      $('#modalLoading').show();
      $.get(`booking/create`, function(res) {
        $('#modalLoading').hide();
        $('#modalBookingContent').html(res);
        loadServiceJadwal($('#selectDokter').val());

        $("select").select2({
          theme: "bootstrap-5",
        });
      });
    });

    $('.btnShowBooking').click(function() {
      const id = $(this).data('id');
      $('#modalBooking').modal('show');
      $('#modalBookingContent').html('');
      $('#modalLoading').show();
      $.get(`booking/${id}`, function(res) {
        $('#modalLoading').hide();
        $('#modalBookingContent').html(res);
      });
    });

    $('#modalBookingContent').on('change', '#selectDokter', function() {
      loadServiceJadwal($(this).val());
    });

    $('#modalBookingContent').on('change', '#selectJadwal', function() {
      loadSlotJadwal($(this).val());
    });
  });

  function loadServiceJadwal(id) {
    $('#selectService').html('');
    $('#selectJadwal').html('');
    $.get(`booking/dokter-service/${id}`, function(res) {
      const dokter = JSON.parse(res);
      dokter.service.forEach(service => {
        $('#selectService').append(`<option value="${service.id}">${service.nama}</option>`);
      });

      dokter.jadwal.forEach(jadwal => {
        $('#selectJadwal').append(
          `<option value="${jadwal.id}">${jadwal.tanggal}: ${jadwal.start} - ${jadwal.end}</option>`
        );
      });

      if ($('#selectJadwal').val()) {
        loadSlotJadwal($('#selectJadwal').val());
      } else {
        $('#selectSlot').html('');
      }
    });
  }

  function loadSlotJadwal(id) {
    $('#selectSlot').html('');
    $.get(`booking/slot-jadwal/${id}`, function(res) {
      const jadwal = JSON.parse(res);
      jadwal.slot.forEach(slot => {
        $('#selectSlot').append(`<option value="${slot.id}">${slot.nomor}</option>`)
      });
    });
  }
</script>
@endpush
