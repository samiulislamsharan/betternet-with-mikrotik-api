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
                            {{ __('Company Information') }}
                        </h2>

                    <form method="post" action="{{ route('company.update', $company ? $company->id : null) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h2 class="text-lg font-medium text-gray-900">{{ __('ISP') }}</h2>
                                <p class="mt-1 text-sm text-gray-600">{{ __("Update your company information.") }}</p>
                            </div>

                            <div>
                                <div>
                                    <x-input-label for="name" value="{{ __('ISP name') }}" class="mt-4"></x-input-label>
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $company ? $company->name : '') }}" required></x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('name')"></x-input-error>
                                </div>

                                <div>
                                    <x-input-label for="address" value="{{ __('Address') }}" class="mt-4"></x-input-label>
                                    <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" value="{{ old('address', $company ? $company->address : '') }}" required></x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('address')"></x-input-error>
                                </div>

                                <div>
                                    <x-input-label for="email" value="{{ __('Email address') }}" class="mt-4"></x-input-label>
                                    <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" value="{{ old('email', $company ? $company->email : '') }}" required></x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('email')"></x-input-error>
                                </div>

                                <div>
                                    <x-input-label for="phone" value="{{ __('Phone number') }}" class="mt-4"></x-input-label>
                                    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" value="{{ old('phone', $company ? $company->phone : '') }}" required></x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('phone')"></x-input-error>
                                </div>

                                <div class="flex items-center gap-4 mt-4">
                                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
