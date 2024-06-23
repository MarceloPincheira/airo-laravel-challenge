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
            <div class="col-md-6">
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
        </div>
    </div>
</body>
</html>
