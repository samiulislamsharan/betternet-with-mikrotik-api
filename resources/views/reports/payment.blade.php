<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <style>
        body {
            font-family: 'Roboto', Helvetica, Arial, sans-serif;
            color: #4d5155;
            font-size: 14px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        .header {
            height: 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #4f46e5;
        }
        .header h1 {
            font-size: 44px;
            color: #333332;
        }
        .section {
            width: 100%;
            margin-top: 50px;
        }
        .section.no-margin {
            margin-top: 10px;
            margin-bottom: 20px;
        }
        .label {
            white-space: nowrap;
            color: #8c8d8e;
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>{{ __('Payment history') }}</h1>
</div>

<div class="section no-margin">
    <span class="label">{{ __('Report generated by ') . config('app.name') . __(' ') . date('Y-m-d h:i A') }}</span>
</div>

<table>
    <thead>
    <tr>
        <th>{{ __('Invoice') }}</th>
        <th>{{ __('User') }}</th>
        <th>{{ __('Package') }}</th>
        <th>{{ __('Price') }}</th>
        <th>{{ __('Method') }}</th>
        <th>{{ __('Date') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($payments as $payment)
        <tr>
            <td>{{ $payment->invoice }}</td>
            <td>{{ $payment->user->name }}</td>
            <td>{{ $payment->billing->package_name }}</td>
            <td>{{ config('app.currency') . $payment->billing->package_price }}</td>
            <td>{{ $payment->payment_method }}</td>
            <td>{{ date('Y-m-d', strtotime($payment->created_at)) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
