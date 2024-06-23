<!DOCTYPE html>
<html>
<head>
    <title>Quotation Form</title>
</head>
<body>
    <form method="POST" action="/quotation">
        @csrf
        <label for="age">Age (comma-separated):</label>
        <input type="text" id="age" name="age" required><br>

        <label for="currency_id">Currency (EUR, GBP, USD):</label>
        <input type="text" id="currency_id" name="currency_id" required><br>

        <label for="start_date">Start Date (YYYY-MM-DD):</label>
        <input type="date" id="start_date" name="start_date" required><br>

        <label for="end_date">End Date (YYYY-MM-DD):</label>
        <input type="date" id="end_date" name="end_date" required><br>

        <button type="submit">Get Quotation</button>
    </form>
</body>
</html>
