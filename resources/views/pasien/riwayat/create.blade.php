@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="mb-4">Tambah Booking</h1>

        <form action="{{ route('booking.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="service" class="form-label">Service</label>
                        <select class="form-select" name="service">
                            <option selected disabled>Pilih service</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="waktu" class="form-label">Tanggal</label>
                        <input class="form-control" type="date" name="tanggal" />
                    </div>
                    <button type="submit" class="btn btn-primary">Booking</button>
                </div>
            </div>
        </form>

        <div id="calendarBulan"></div>
        <div id="calendarMinggu"></div>
        <div id="modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const calendarBulan = new FullCalendar.Calendar($('#calendarBulan')[0], {
                plugins: [ dayGridPlugin, interaction ],
                initialView: 'dayGridMonth',
                dateClick: function(e) {
                    $('#modal').modal('show');
                },
                showNonCurrentDates: false,
                dayCellDidMount: function(date, el) {
                    console.log(date);
                }
            });
            const calendarMinggu = new FullCalendar.Calendar($('#calendarMinggu')[0], {
                plugins: [ dayGridPlugin, interaction ],
                initialView: 'dayGridWeek',
                dateClick: function(el) {
                    console.log(el.dateStr);
                    $('#modal').modal('show');
                },
            });
            calendarBulan.render();
            calendarMinggu.render();
        });
    </script>
@endpush
