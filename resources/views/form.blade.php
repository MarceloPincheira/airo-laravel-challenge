<!DOCTYPE html>
<html>
<head>
    <title>Quotation Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quotation Form</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/quotation">
                            @csrf

                            <div class="form-group">
                                <label for="age">Age (comma-separated):</label>
                                <input type="text" class="form-control" id="age" name="age" required>
                            </div>

                            <div class="form-group">
                                <label for="currency_id">Currency (EUR, GBP, USD):</label>
                                <input type="text" class="form-control" id="currency_id" name="currency_id" required>
                            </div>

                            <div class="form-group">
                                <label for="start_date">Start Date:</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" min="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="end_date">End Date:</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" min="{{ date('Y-m-d') }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Get Quotation</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <h1 class="mt-5 mb-4">Quotations List</h1>
                @if ($quotations->isEmpty())
                    <div class="alert alert-info" role="alert">
                        There are no quotations.
                    </div>
                @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">Quotation ID</th>
                        <th scope="col">Currency ID</th>
                        <th scope="col">Dates</th>
                        <th scope="col">Ages</th>
                        <th scope="col">Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($quotations as $quotation)
                        <tr>
                            <th scope="row">{{ $quotation->id }}</th>
                            <td>{{ $quotation->currency_id }}</td>
                            <td>{{ date('Y-m-d', strtotime($quotation->start_date)) }} to {{ date('Y-m-d', strtotime($quotation->end_date)) }}</td>
                            <td>{{ $quotation->age }}</td>
                            <td>{{ $quotation->total }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
