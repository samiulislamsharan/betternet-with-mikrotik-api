<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-8">
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

                        <h2 class="font-semibold text-xl text-gray-800 leading-tight border-b-2 border-slate-100 pb-4">
                            {{ __('Application Settings') }}
                        </h2>

                    <form method="post" action="{{ route('settings.update', $settings ? $settings->id : null) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h2 class="text-lg font-medium text-gray-900">{{ __('Mikrotik') }}</h2>
                                <p class="mt-1 text-sm text-gray-600">{{ __("Update your Mikrotik router information.") }}</p>
                            </div>

                            <div>
                                <div>
                                    <x-input-label for="router_ip" value="{{ __('Mikrotik IP') }}" class="mt-4"></x-input-label>
                                    <x-text-input id="router_ip" name="router_ip" type="text" class="mt-1 block w-full" value="{{ old('router_ip', $settings ? $settings->router_ip : '') }}" required></x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('router_ip')"></x-input-error>
                                </div>

                                <div>
                                    <x-input-label for="router_username" value="{{ __('Mikrotik username') }}" class="mt-4"></x-input-label>
                                    <x-text-input id="router_username" name="router_username" type="text" class="mt-1 block w-full" value="{{ old('router_username', $settings ? $settings->router_username : '') }}" required></x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('router_username')"></x-input-error>
                                </div>

                                <div>
                                    <x-input-label for="router_password" value="{{ __('Mikrotik password') }}" class="mt-4"></x-input-label>
                                    <x-text-input id="router_password" name="router_password" type="password" class="mt-1 block w-full" value="{{ old('router_password', $settings ? $settings->router_password : '') }}" required></x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('router_password')"></x-input-error>
                                </div>

                                <div>
                                    <div class="flex items-center gap-4 mt-4">
                                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
