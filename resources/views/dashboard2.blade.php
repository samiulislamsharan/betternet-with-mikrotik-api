<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('error'))
                        <div class="alert alert-danger text-red-600">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="border-b-2 border-slate-100 pb-4">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Dashboard') }}
                        </h2>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-6">
                        <div class="border-l-2 bg-blue-50 border-blue-500 p-4">
                            <h2 class="text-l font-bold">{{ __('Current Package') }}</h2>
                            <p class="text-xl mt-2 font-bold">{{ $user->detail->package_name }}</p>
                        </div>
                        <div class="border-l-2 bg-blue-50 border-blue-500 p-4">
                            <h2 class="text-l font-bold">{{ __('Package Start') }}</h2>
                            <p class="text-xl mt-2 font-bold">{{ $user->detail->package_start }}</p>
                        </div>
                        <div class="border-l-2 bg-blue-50 border-blue-500 p-4">
                            <h2 class="text-l font-bold">{{ __('Current Due') }}</h2>
                            <p class="text-xl mt-2 font-bold">{{ $user->due_amount($user->id) }}</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        @if ($user->due_amount($user->id) > 0)
                            <form action="{{ route('payment.process') }}" method="POST" id="payment-form">
                                @csrf
                                <input type="hidden" name="amount" value="200">
                                <input type="hidden" name="payment_method" id="payment_method" value="">
                                <div id="card-element"></div>
                                <div id="card-errors" role="alert"></div>
                                <button type="submit" class="btn btn-primary">Confirm Payment</button>
                            </form>
                        @endif
                    </div>
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
