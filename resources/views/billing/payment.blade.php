
<form method="post" action="{{ route('payment.store') }}">
    @csrf
    <input type="hidden" name="invoice" value="{{ $row->invoice }}" />
    <input type="hidden" name="payment_method" value="{{ __('Cash') }}" />
    <x-success-button>{{ __('Mark Paid') }}</x-success-button>
</form>
