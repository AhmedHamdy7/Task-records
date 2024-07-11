<x-app-layout>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <div class="container mt-5">
        @include('partials.alerts')
        <div class="d-flex justify-content-between align-items-center">
            <h1>Records</h1>
            <div class="form-group mb-0">
                <a href="exchange-rates" class="btn btn-success">Add New Exchange</a>
            </div>
        </div>
    <h2>Add New Record</h2>
    <form action="{{ route('records.store') }}" method="POST" class="d-flex align-items-center">
        @csrf
        <div class="form-group mx-3 d-flex justify-content-start">
            <select name="currency" id="currency" class="form-control" required>
                @foreach ($exchangeRates as $currency => $rate)
                <option value="{{ $currency }}">{{ $currency }} ({{ $rate }})</option>
                @endforeach
            </select>
        </div>
        <input type="number" name="amount" id="amount" class="form-control mx-3 w-50" step="0.01" placeholder="Amount" required>
        <button type="submit" class="btn btn-success">Add</button>
    </div>

</form>


<div class="container mt-5">
    <table class="table table-hover" id="recordsTable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Currency</th>
                <th scope="col">Amount</th>
                <th scope="col">Exchange Rate</th>
                <th scope="col">Exchange Value</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
            <tr>
                <td>{{ $record->id }}</td>
                <td>{{ $record->currency }}</td>
                <td>{{ $record->amount }}</td>
                <td>{{ $exchangeRates[$record->currency] }}</td>
                <td>{{ $record->exchange_value }}</td>
                <td>
                    <a href="{{ route('records.edit', $record->id) }}" class="btn btn-primary btn-sm">Update</a>

                    <form action="{{ route('records.delete', $record->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm delete-btn" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
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

</x-app-layout>
