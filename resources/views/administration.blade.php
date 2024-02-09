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
                            {{ __('Administration') }}
                        </h2>
                    </div>
                    <div>
                        <form action="{{ route('log') }}" class="mt-6" method="get">
                            @csrf
                            <x-success-button>{{ __('View Mikrotik Log') }}</x-success-button>
                        </form>
                    </div>
                    <div>
                        <form action="{{ route('due.user.disable') }}" class="mt-6" method="post">
                            @csrf
                            <x-danger-button>{{ __('Disable all users with due') }}</x-danger-button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
