<x-app-layout>

    <!DOCTYPE html>
    <html>
        <head>
            <title>Edit Record</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        </head>
        <body>
            <div class="container mt-5">
                <h2>Edit Record</h2>
                <form action="{{ route('records.update', $record->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="currency">Currency Code</label>
                        <select name="currency" id="currency" class="form-control" required>
                            @foreach ($exchangeRates as $currency => $rate)
                            <option value="{{ $currency }}" {{ $currency == $record->currency ? 'selected' : '' }}>
                        {{ $currency }} ({{ $rate }})
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" name="amount" id="amount" class="form-control"  value="{{ $record->amount }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Save changes</button>
            <a href="{{ route('records.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

</x-app-layout>
