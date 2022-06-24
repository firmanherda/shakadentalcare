<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">ID Booking #{{ $booking->id }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col">Service:</div>
            <div class="col">{{ $booking->service->nama }}</div>
        </div>
        <div class="row">
            <div class="col">Waktu:</div>
            <div class="col">{{ $booking->waktu }}</div>
        </div>
        <div class="row">
            <div class="col">Total:</div>
            <div class="col">@rupiah($booking->transaksi->total)</div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
    </div>
</div>
