@extends('layouts.admin')

@section('title', 'Jadwal')
@section('content')
  <div class="container-fluid overflow-auto">
    <div
      class="d-none d-md-inline-block d-lg-inline-block d-xl-inline-block d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Jadwal</h1>
    </div>
    <div class="card shadow mb-4">
      <div class="card-body">
        <div id="calendarJadwal"></div>
      </div>
    </div>
  </div>

  <div id="modalJadwal" class="modal fade" tabindex="-1">
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

        <div id="modalJadwalContent"></div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      const jadwals = @json($jadwals);
      const events = jadwals.map((jadwal) => {
        return {
          id: jadwal.id,
          start: `${jadwal.tanggal} ${jadwal.start}`,
          end: `${jadwal.tanggal} ${jadwal.end}`,
          title: jadwal.dokter.user.nama,
          extendedProps: {
            slotKosong: jadwal.slotKosong
          }
        }
      });
      const calendar = new FullCalendar.Calendar($("#calendarJadwal")[0], {
        plugins: [interactionPlugin, timeGridPlugin],
        initialView: 'timeGridWeek',
        selectable: true,
        editable: true,
        allDaySlot: false,
        height: 'auto',
        slotMinTime: '08:30:00',
        slotMaxTime: '24:00:00',
        locale: 'id',
        views: {
          week: {
            titleFormat: {
              year: 'numeric',
              month: 'long',
              day: 'numeric'
            },
            slotLabelInterval: '00:30:00',
            slotLabelFormat: {
              hour: '2-digit',
              minute: '2-digit',
              meridiem: 'short',
              hour12: false
            }
          }
        },
        events,
        select: function(cell) {
          const start = moment(cell.startStr).format('YYYY-MM-DD HH:mm:ss');
          const end = moment(cell.endStr).format('YYYY-MM-DD HH:mm:ss');
          const tanggal = moment(cell.endStr).format('YYYY-MM-DD');

          $('#modalJadwal').modal('show');
          $('#modalJadwalContent').html('');
          $('#modalLoading').show();
          $.get(`jadwal/create?start=${start}&end=${end}&tanggal=${tanggal}`, function(res) {
            $('#modalLoading').hide();
            $('#modalJadwalContent').html(res);
          });
        },
        selectOverlap: function(event) {
          return !event.block;
        },
        selectConstraint: {
          start: moment().format('YYYY-MM-DD'),
        },
        eventDrop: function(cell) {
          $('#loadingOverlay').show('fast');
          const start = moment(cell.event.startStr).format('YYYY-MM-DD HH:mm');
          const end = moment(cell.event.endStr).format('YYYY-MM-DD HH:mm');
          const tanggal = moment(cell.event.endStr).format('YYYY-MM-DD');

          $.ajax({
            url: `jadwal/${cell.event.id}`,
            type: 'PUT',
            data: {
              start,
              end,
              tanggal
            },
            success: function() {
              $('#loadingOverlay').hide('fast');
            }
          });
        },
        eventResize: function(cell) {
          $('#loadingOverlay').show('fast');
          const start = moment(cell.event.startStr).format('YYYY-MM-DD HH:mm');
          const end = moment(cell.event.endStr).format('YYYY-MM-DD HH:mm');
          const tanggal = moment(cell.event.endStr).format('YYYY-MM-DD');

          $.ajax({
            url: `jadwal/${cell.event.id}`,
            type: 'PUT',
            data: {
              start,
              end,
              tanggal
            },
            success: function() {
              $('#loadingOverlay').hide('fast');
            }
          });
        },
        eventClick: function(event) {
          $('#modalJadwal').modal('show');
          $('#modalJadwalContent').html('');
          $('#modalLoading').show();
          $.get(`jadwal/${event.event.id}`, function(res) {
            $('#modalLoading').hide();
            $('#modalJadwalContent').html(res);
          });
          $('#modalJadwal').on('show.bs.modal', function() {
            const modal = $(this);
            modal.find('#btnHapusJadwal').click(function() {
              $.ajax({
                url: `jadwal/${cell.event.id}`,
                type: 'DELETE',
                success: function(res) {
                  if (res === 'ok') {
                    $('.toast').removeClass(
                        'bg-primary bg-danger')
                      .addClass('bg-primary');
                    $('.toast .toast-body').html(
                      'Berhasil menghapus jadwal');
                    $('.toast').toast('show');
                    cell.event.remove();
                  } else {
                    $('.toast').removeClass(
                        'bg-primary bg-danger')
                      .addClass('bg-primary');
                    $('.toast .toast-body').html(
                      'Gagal menghapus jadwal');
                    $('.toast').toast('show');
                  }
                }
              });
            });
          });
        },
        eventContent: function(cell) {
          const event = cell.event;
          return {
            html: `
              <div class="pe-pointer d-flex flex-column justify-content-center">
                <div class="badge bg-primary p-1 text-center">${cell.timeText}</div>
                <p class="fw-bold mt-2">${event.title}</p>
                <p>${event.extendedProps.slotKosong} slot tersisa</p>
              </div>
            `
          }
        }
      });
      calendar.render();
    });
  </script>
@endpush
