@extends('layouts.dokter')

@section('title', 'Jadwal Hari Ini')
@section('content')
  <div class="px-4 py-2">
    <div class="mb-4 d-flex justify-content-between">
      <h2>Booking</h2>
    </div>

    @if (!$jadwals)
      tidak ada jadwal hari ini 😁
    @else
      @foreach ($jadwals as $jadwal)
        <h4>Jadwal: {{ "$jadwal->tanggal $jadwal->start - $jadwal->end" }}</h4>
        <h5 id="antrian" class="mb-4">No Antrian: <span
            class="fw-bold">{{ $jadwal->antrian['nomor'] != '-' ? "Slot {$jadwal->antrian['nomor']}" : 'Kosong' }}</span>
        </h5>
        <div class="row row-cols-1 row-cols-md-5 mb-4">
          @foreach ($jadwal->slot as $slot)
            <div class="col">
              <div class="card my-2 my-md-0 card-booking shadow-sm">
                @if ($slot->booking)
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-primary">Slot {{ $loop->iteration }}</h6>
                    <div class="badge" data-id="{{ $slot->booking->id }}">{{ $slot->booking->status }}</div>
                  </div>
                  <div class="card-body">
                    <p class="card-title fw-bold">{{ $slot->booking->pasien->user->nama }}</p>
                    <p class="card-subtitle">{{ $slot->booking->service->nama }}</p>
                  </div>
                  <div class="card-footer bg-white">
                    @if ($slot->booking->status == 'Diproses')
                      <button class="btn btn-success btn-aksi text-white" data-id="{{ $slot->booking->id }}"
                        data-tipe="selesai">
                        <span class="fa fa-check me-1"></span>
                        Selesai
                      </button>
                      <button class="btn btn-secondary btn-aksi text-white" data-id="{{ $slot->booking->id }}"
                        data-tipe="lewati" disabled>Lewati</button>
                    @elseif ($slot->booking->status == 'Dilewati')
                      <button class="btn btn-primary btn-aksi text-white" data-id="{{ $slot->booking->id }}"
                        data-tipe="proses">Proses</button>
                      <button class="btn btn-secondary btn-aksi text-white" data-id="{{ $slot->booking->id }}"
                        data-tipe="lewati">Lewati</button>
                    @elseif ($slot->booking->status == 'Selesai')
                      <button class="btn btn-success btn-aksi text-white" data-tipe="selesai" disabled>
                        <span class="fa fa-check me-1"></span>
                        Selesai
                      </button>
                    @else
                      @if ($slot->nomor == $jadwal->antrian['nomor'])
                        <button class="btn btn-primary btn-aksi text-white" data-id="{{ $slot->booking->id }}"
                          data-tipe="proses">Proses</button>
                        @if ($slot->nomor == $jadwal->antrian['terakhir'])
                          <button class="btn btn-secondary btn-aksi text-white" data-id="{{ $slot->booking->id }}"
                            data-tipe="lewati" disabled>Lewati</button>
                        @else
                          <button class="btn btn-secondary btn-aksi text-white" data-id="{{ $slot->booking->id }}"
                            data-tipe="lewati">Lewati</button>
                        @endif
                      @else
                        <button class="btn btn-primary btn-aksi text-white" data-id="{{ $slot->booking->id }}"
                          data-tipe="proses" disabled>Proses</button>
                        <button class="btn btn-secondary btn-aksi text-white" data-id="{{ $slot->booking->id }}"
                          data-tipe="lewati" disabled>Lewati</button>
                      @endif
                    @endif
                  </div>
                @else
                  <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary">Slot {{ $loop->iteration }}</h6>
                  </div>
                  <div class="card-body">
                    <p class="card-title fw-bold">Kosong</p>
                    <p class="card-subtitle"> - </p>
                  </div>
                  <div class="card-footer bg-white">
                    <p class="text-center"> - </p>
                  </div>
                @endif
              </div>
            </div>
          @endforeach

          <form id="formHandleBooking" method="POST" hidden>
            @method('PATCH')
            @csrf
            <input type="text" name="tipe" id="tipe" hidden>
            <input type="text" name="total" id="total" hidden>
            <input type="text" name="catatan" id="catatan" hidden>
          </form>
        </div>
      @endforeach
    @endif
  </div>

  <div id="modalTransaksi" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable overflow-auto">
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

        <div id="modalTransaksiContent"></div>
      </div>
    </div>
  </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(function() {
      cekStatus();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('.card-booking .card-footer .btn-aksi').click(function() {
        const tipe = $(this).data('tipe');
        const id = $(this).data('id');

        if (tipe == 'selesai') {
          openModalTransaksi(id);
        } else {
          handleBooking(id, tipe);
        }
      });
    });

    function cekStatus() {
      const booking = $('.badge');
      booking.each(function(i, el) {
        switch ($(el).text()) {
          case "Menunggu Antrian":
            $(el).addClass('bg-warning');
            break;
          case "Diproses":
            $(el).addClass('bg-primary');
            break;
          case "Dilewati":
            $(el).addClass('bg-secondary');
            break;
          case "Selesai":
            $(el).addClass('bg-success');
            break;
          default:
            break;
        }
      });
    }

    function openModalTransaksi(id) {
      $('#modalTransaksi').modal('show');
      $('#modalTransaksiContent').html('');
      $('#modalLoading').show();
      $.get(route('dokter.home.createTransaksi', id), function(res) {
        $('#modalLoading').hide();
        $('#modalTransaksiContent').html(res);
        $('#btnBuat').click(function() {
          const total = $('#totalTransaksi').val();
          const catatan = $('#catatanTransaksi').val();
          handleBooking(id, 'selesai', total, catatan);
        });
      });
    }

    /* function lewatiBooking(id, booking) {
      $(`.btn-aksi[data-id='${id}'][data-tipe='proses']`).prop('disabled', true);
      $(`.btn-aksi[data-id='${id}'][data-tipe='lewati']`).prop('disabled', true);
      $(`.badge[data-id='${id}']`).removeClass('bg-warning').addClass('bg-secondary');
      $(`.badge[data-id='${id}']`).text('Dilewati');
      if (booking != 'kosong') {
        $(`.btn-aksi[data-id='${booking.id}'][data-tipe='proses']`).prop('disabled', false);
        $(`.btn-aksi[data-id='${booking.id}'][data-tipe='lewati']`).prop('disabled', false);
        $('#antrian').html(`No Antrian: <span class="fw-bold">Slot ${booking.slot.nomor}</span>`);
      } else {
        $('#antrian').html(`No Antrian: <span class="fw-bold text-success">Selesai</span>`);
      }
    }

    function prosesBooking(id) {
      $(`.btn-aksi[data-id='${id}'][data-tipe='proses']`).removeClass('btn-primary').addClass('btn-success');
      $(`.btn-aksi[data-id='${id}'][data-tipe='proses']`).html('<span class="fa fa-check me-1"></span> Selesai ');
      $(`.btn-aksi[data-id='${id}'][data-tipe='proses']`).attr('data-tipe', 'selesai');
      $(`.btn-aksi[data-id='${id}'][data-tipe='selesai']`).data('tipe', 'selesai');
      $(`.btn-aksi[data-id='${id}'][data-tipe='lewati']`).prop('disabled', true);
      $(`.badge[data-id='${id}']`).removeClass('bg-warning').addClass('bg-primary');
      $(`.badge[data-id='${id}']`).text('Diproses');
    }

    function selesaiBooking(id, booking) {
      $(`.btn-aksi[data-id='${id}'][data-tipe='selesai']`).prop('disabled', true);
      $(`.btn-aksi[data-id='${id}'][data-tipe='lewati']`).remove();
      $(`.badge[data-id='${id}']`).removeClass('bg-primary').addClass('bg-success');
      $(`.badge[data-id='${id}']`).text('Selesai');
      if (booking != 'kosong') {
        $(`.btn-aksi[data-id='${booking.id}'][data-tipe='proses']`).prop('disabled', false);
        $(`.btn-aksi[data-id='${booking.id}'][data-tipe='lewati']`).prop('disabled', false);
        $('#antrian').html(`No Antrian: <span class="fw-bold">Slot ${booking.slot.nomor}</span>`);
      } else {
        $('#antrian').html(`No Antrian: <span class="fw-bold text-success">Selesai</span>`);
      }
      $('#modalTransaksi').modal('hide');
    } */

    function handleBooking(id, tipe, total = 0, catatan = '') {
      $('#formHandleBooking').prop('action', route('dokter.home.handleBooking', id));
      $('#total').prop('value', total);
      $('#tipe').prop('value', tipe);
      $('#catatan').prop('value', catatan);
      $('#formHandleBooking').submit();
      /* $.ajax({
        url: route('dokter.home.handleBooking', id),
        type: 'PATCH',
        data: {
          tipe,
          total
        },
        success: function(res) {
          let bookingBaru;
          switch (tipe) {
            case 'proses':
              prosesBooking(id);
              break;
            case 'lewati':
              bookingBaru = res.booking;
              lewatiBooking(id, bookingBaru);
              break;
            case 'selesai':
              bookingBaru = res.booking;
              selesaiBooking(id, bookingBaru);
              break;
            default:
              break;
          }
        },
        error: function(err) {
          console.log('err ', err);
        }
      }); */
    }
  </script>
@endpush
