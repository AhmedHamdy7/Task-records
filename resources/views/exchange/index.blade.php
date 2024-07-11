<x-app-layout>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <div class="container my-5">
        @include('partials.alerts')
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-4">Exchange Rates</h1>
            <div class="form-group mb-0">
                    <a href="records" class="btn btn-success">Add New Records</a>
                </div>
            </div>
            <h3>Add New Exchange Rate</h3>
            <form action="{{ route('exchange-rates.add') }}" method="POST" class="d-flex align-items-center">
                @csrf
                <div class="form-group mx-3 d-flex justify-content-start">
                    <input type="text" name="currency" id="currency" class="form-control mx-1" placeholder="Currency Code" required>
                    <input type="number" name="rate" id="rate" class="form-control mx-1" step="0.01" placeholder="Rate" required>
                    <button type="submit" class="btn btn-success mx-1">Add</button>
                </div>
            </form>
            <div class="row">
                <table class="table table-hover" id="exchangeRatesTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Rate</th>
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exchangeRates as $currency => $rate)
                        <tr>
                            <th>#</th>
                            <td>{{ $currency }}</td>
                            <td>{{ $rate }}</td>
                            <td>
                                <form action="{{ route('exchange-rates.update', $currency) }}" method="POST">
                                    @csrf
                                    <input type="number" name="rate" value="{{ $rate }}" class="form-control" step="0.01" required>
                                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('exchange-rates.delete', $currency) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.table').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    pageLength: 5,
                    lengthChange: false,
                    language: {
                        search: "Filter records:",
                        lengthMenu: "Show _MENU_ entries",
                        info: "Showing page _PAGE_ of _PAGES_",
                        infoEmpty: "No records available",
                        infoFiltered: "(filtered from _MAX_ total records)",
                        paginate: {
                            next: "Next",
                            previous: "Previous"
                        }
                    }
                });
            });
        </script>

<script>
    document.querySelectorAll('.update-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const currency = this.dataset.currency;
            const rate = this.dataset.rate;

            // Make the AJAX request to update the exchange rate
            fetch('/update-exchange-rate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ currency, rate })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Exchange rate updated successfully!');
                } else {
                alert('Failed to update exchange rate.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the exchange rate.');
        });
    });
});
</script>

</x-app-layout>
