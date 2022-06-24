@extends('layouts.dokter')

@section('content')
  <div class="px-4 py-2">
    <div class="mb-4 d-flex justify-content-between">
      <h2>Jadwal</h2>
    </div>
    <div class="card shadow mb-4">
      <div class="card-body">
        <div id="calendarJadwal"></div>
      </div>
    </div>
  </div>

  <div id="modalJadwal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div id="modalLoading" class="row h-100 align-items-center">
          <div class="col align-self-center">
            <div class="d-flex my-5 justify-content-center">
              <div class="spinner-border" role="status">
                <span class="visually-hidden">Memuat...</span>
              </div>
            </div>
          </div>
        </div>
        <div id="modalJadwalContent"></div>
      </div>
    </div>
  </div>

  <div class="toast position-absolute m-4 bottom-0 end-0 align-items-center text-white border-0" role="alert"
    aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body"></div>
      <button type="button" class="close close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
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
          title: `${jadwal.dokter.user.nama} (${jadwal.jumlah_slot} slot)`,
        }
      });
      const calendar = new FullCalendar.Calendar($("#calendarJadwal")[0], {
        plugins: [interactionPlugin, timeGridPlugin],
        initialView: 'timeGridWeek',
        allDaySlot: false,
        views: {
          week: {
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
        eventClick: function(event) {
          $('#modalJadwal').modal('show');
          $('#modalJadwalContent').html('');
          $('#modalLoading').show();
          $.get(`jadwal/${event.event.id}`, function(res) {
            $('#modalLoading').hide();
            $('#modalJadwalContent').html(res);
          });
        }
      });
      calendar.render();
    });
  </script>
@endpush
