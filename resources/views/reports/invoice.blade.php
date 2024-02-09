<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        h3 {
            color: #4f46e5;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 13px;
            line-height: 1.2;
            margin: 2px 0;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .details-row::after {
            content: "";
            display: table;
            clear: both;
        }

        .details-column {
            width: 50%;
            float: left;
        }

        p {
            font-size: 13px;
            line-height: 1.2;
            margin: 2px 0;
        }

        .invoice-line {
            border-top: 1px solid #4b5563;
            margin-top: 20px;
        }

        .divider {
            margin-top: 30px;
        }
    </style>
</head>
<body>
<h3>{{ __('Invoice #') . $invoice->invoice }}</h3>
<p>{{ __('Invoice date: ') . date('Y-m-d') }}</p>


<div class="details-row">
    <div class="details-column">
        <h5>{{ __('ISP Details:') }}</h5>
        <p>{{ $company->name }}</p>
        <p>{{ __('Address: ') . $company->address }}</p>
        <p>{{ __('Phone: ') . $company->phone }}</p>
        <p>{{ __('Email: ') . $company->email }}</p>
    </div>

    <div class="details-column">
        <h5>{{ __('Invoice Details:') }}</h5>
        <p>{{ __('Customer: ') . $invoice->user->name }}</p>
        <p>{{ __('Address: ') . $invoice->user->detail->address }}</p>
        <p>{{ __('Phone: ') . $invoice->user->detail->phone }}</p>
        <p>{{ __('Email: ') . $invoice->user->email }}</p>
    </div>
</div>

<div class="divider"></div>

<table>
    <tr>
        <th>{{ __('Description') }}</th>
        <th>{{ __('Amount') }}</th>
    </tr>
    <tr>
        <td>
            {{ __('Package name ') . $invoice->billing->package_name }}<br>
            {{ __('(Started on ') . $invoice->billing->package_start . __(')') }}
        </td>
        <td>{{ config('app.currency') . $invoice->package_price }}</td>
    </tr>
    <tr class="invoice-line">
        <td colspan="1" style="text-align: right;">{{ __('Total:') }}</td>
        <td>{{ config('app.currency') . $invoice->package_price }}</td>
    </tr>
</table>

</body>
</html>
