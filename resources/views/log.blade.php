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
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Mikrotik Log') }}
                    </h2>
                    <div class="mt-6">
                        <table class="border-collapse border border-slate-400 w-full">
                            <thead>
                            <tr>
                                <th class="border border-slate-300">{{ __('Time') }}</th>
                                <th class="border border-slate-300">{{ __('Topics') }}</th>
                                <th class="border border-slate-300">{{ __('Message') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($logs as $log)
                                <tr>
                                    <td class="border border-slate-300 p-2">{{ $log['time'] }}</td>
                                    <td class="border border-slate-300 p-2">{{ $log['topics'] }}</td>
                                    <td class="border border-slate-300 p-2">{{ $log['message'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
