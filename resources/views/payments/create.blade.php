<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-8">
                    @if(session('error'))
                        <div class="alert alert-danger text-red-600">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h2 class="font-semibold text-xl text-gray-800 leading-tight border-b-2 border-slate-100 pb-4">
                        {{ __('Create Payment') }}
                    </h2>

                    <form action="{{ route('payment.process') }}" method="POST" id="payment-form">
                        @csrf

                        <div class="grid grid-cols-2 gap-4 mt-6">
                            <div>
                                <h2 class="text-lg font-medium text-gray-900">{{ __('Payment') }}</h2>
                                <p class="mt-1 text-sm text-gray-600">{{ __("Pay with Stripe") }}</p>
                            </div>
                            <div>
                                <input type="hidden" name="bill" value="{{ $bill->id }}">
                                <input type="hidden" name="amount" value="{{ $bill->package_price }}">
                                <input type="hidden" name="payment_method" id="payment_method" value="">
                                <div id="card-element"></div>
                                <div id="card-errors" role="alert"></div>
                                <div class="flex items-center gap-4 mt-6">
                                    <x-primary-button>{{ __('Pay') }}</x-primary-button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            const stripe = Stripe('{{ config('services.stripe.key') }}');
            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');

            cardElement.on('change', function(event) {
                const displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            const paymentForm = document.getElementById('payment-form');
            paymentForm.addEventListener('submit', function(event) {
                event.preventDefault();
                stripe.createPaymentMethod('card', cardElement)
                    .then(function(result) {
                        if (result.error) {
                            const errorElement = document.getElementById('card-errors');
                            errorElement.textContent = result.error.message;
                        } else {
                            const paymentMethodInput = document.getElementById('payment_method');
                            paymentMethodInput.value = result.paymentMethod.id;
                            paymentForm.submit();
                        }
                    });
            });
        </script>
    @endpush

</x-app-layout>
