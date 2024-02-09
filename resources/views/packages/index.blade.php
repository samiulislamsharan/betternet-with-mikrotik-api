<x-app-layout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        @if(session('success'))
                            <div class="alert alert-success text-green-600">
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
                                {{ __('Packages') }}
                            </h2>
                            @if (auth()->user()->isAdmin())
                                <x-create-button url="{{ route('packages.create') }}"></x-create-button>
                            @endif
                        </div>
                        <div>
                            @if (auth()->user()->isAdmin())
                                <livewire:package-table/>
                            @endif
                            @if (auth()->user()->isUser())
                                <livewire:user-package-table/>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
