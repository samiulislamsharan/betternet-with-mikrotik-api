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
                        {{ __('Create Package') }}
                    </h2>

                    <form method="post" action="{{ route('packages.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h2 class="text-lg font-medium text-gray-900">{{ __('Package') }}</h2>
                                <p class="mt-1 text-sm text-gray-600">{{ __("Add package name and price") }}</p>
                            </div>

                            <div>
                                <div>
                                    <x-input-label for="name" :value="__('Package name')"></x-input-label>
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required></x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('name')"></x-input-error>
                                </div>
                                <div>
                                    <x-input-label for="price" :value="__('Package price')" class="mt-4"></x-input-label>
                                    <x-text-input id="price" name="price" type="text" class="mt-1 block w-full" :value="old('price')" required></x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('price')"></x-input-error>
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
