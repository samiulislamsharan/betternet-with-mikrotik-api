<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="alert alert-success text-gray-400">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger text-red-600">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-6 border-b-2 border-slate-100 pb-4">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Payments') }}
                        </h2>
                        <div class="flex items-center">
                            @if (auth()->user()->isAdmin())
                                <a href="{{ route('payment.download') }}" class="inline-flex items-center px-4 py-2 bg-orange-400 text-white border border-transparent rounded-md font-semibold text-xs rounded uppercase">
                                    {{ __('Download') }}
                                </a>
                            @endif
                        </div>
                    </div>
                    <div>
                        @if (auth()->user()->isAdmin())
                            <livewire:payment-table/>
                        @endif
                        @if (auth()->user()->isUser())
                            <livewire:user-payment-table/>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
