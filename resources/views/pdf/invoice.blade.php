<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body {
    font-family: 'Helvetica Neue', 'Helvetica', sans-serif;
    color: #333;
    background-color: #f8f8f8;
    padding: 20px;
}

h1 {
    color: #444;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
    padding: 8px;
}

th {
    background-color: #4CAF50;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

    </style>
</head>
<body>
    <h1>Invoice</h1>
    <p>Bank Details: {{ $userBank->details }}</p>
    <p>Amount Paid: {{ $lastOrder->total_amount }}</p>
    <p>Amount Remaining: {{ $userBank->amount }}</p>
</body>
</html>
