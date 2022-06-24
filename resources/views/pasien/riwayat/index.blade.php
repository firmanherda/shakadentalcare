@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="row mb-4">
            <div class="col">
                <h1 class="float-start">Riwayat Booking</h1>
            </div>
            <div class="col my-auto">
                <a href="booking/create" class="btn btn-primary float-end">Tambah Booking</a>
            </div>
        </div>
        @foreach ($bookings as $booking)
            <div class="card my-4 shadow">
                <div class="card-body">
                    <h5 class="card-title">ID #{{ $booking->id }}</h5>
                    <p class="card-text">{{ $booking->waktu }}</p>
                    <button id="modalBooking" data-id="{{ $booking->id }}" class="btn btn-primary">Detail</button>
                </div>
            </div>
        @endforeach

        {{ $bookings->links() }}
    </div>

    <div id="modalDetail" class="modal fade" tabindex="-1">
        <div id="modalDetailContent" class="modal-dialog"></div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#modalBooking').click(function() {
                const id = $(this).data('id');

                $.get(`booking/${id}`, function (res) {
                    $('#modalDetailContent').html(res);
                    $('#modalDetail').modal('show');
                });
            });
        });
    </script>
@endpush
