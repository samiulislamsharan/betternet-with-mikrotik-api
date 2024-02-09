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

                    <div class="flex justify-between items-center mb-6 border-b-2 border-slate-100 pb-4">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Generate monthly bill') }}
                        </h2>

                    </div>
                    <div>
                        <form method="post" action="{{ route('billing.store') }}" class="mt-6 space-y-6">
                            @csrf
                            <table class="border-separate border border-spacing-2 border-slate-400 w-full">
                                <thead class="bg-gray-100">
                                <tr>
                                    <th class="border border-slate-300 text-left">{{ __('Check') }}</th>
                                    <th class="border border-slate-300 text-left">{{ __('User') }}</th>
                                    <th class="border border-slate-300 text-left">{{ __('Package') }}</th>
                                    <th class="border border-slate-300 text-left">{{ __('Price') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td class="border border-slate-300 p-2">
                                        <input type="checkbox" class="rounded" name="checked[]" value="{{ $user->id }}">
                                    </td>
                                    <td class="border border-slate-300 p-2">{{ $user->name }}</td>
                                    <td class="border border-slate-300 p-2">{{ $user->detail->package_name }}</td>
                                    <td class="border border-slate-300 p-2">{{ $user->detail->package_price }}</td>
                                    <input type="hidden" name="user_id[]" value="{{ $user->id }}">
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="flex items-center gap-4 mt-4">
                                <x-primary-button>{{ __('Generate') }}</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
