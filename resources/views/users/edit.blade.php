<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="p-4 sm:p-8">
                    <x-slot name="header">
                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            {{ $user->name }}
                        </h2>
                    </x-slot>
                    @if(session('error'))
                        <div class="alert alert-danger text-red-600">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight border-b-2 border-slate-100 pb-4">
                        {{ __('Edit user') }}
                    </h2>

                    <form method="post" action="{{ route('users.update', $user->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Account') }}</h2>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ __("Edit user account information") }}</p>
                            </div>

                            <div>
                                <div>
                                    <x-input-label for="name" :value="__('User name')" class="mt-4"></x-input-label>
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ $user->name }}"></x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('name')"></x-input-error>
                                </div>

                                <div>
                                    <x-input-label for="email" :value="__('Email address')" class="mt-4"></x-input-label>
                                    <x-text-input id="email" name="email" type="text" class="mt-1 block w-full bg-gray-100" value="{{ $user->email }}" disabled></x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('email')"></x-input-error>
                                </div>

                                <div>
                                    <x-input-label for="password" :value="__('Password')" class="mt-4"></x-input-label>
                                    <x-text-input name="password" type="password" class="mt-1 block w-full" value=""></x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('password')"></x-input-error>
                                </div>

                                <div>
                                    <x-input-label for="password_confirmation" :value="__('Password confirm')" class="mt-4"></x-input-label>
                                    <x-text-input name="password_confirmation" type="password" class="mt-1 block w-full" value=""></x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')"></x-input-error>
                                </div>

                                <div>
                                    <x-input-label for="address" :value="__('Address')" class="mt-4"></x-input-label>
                                    <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" value="{{ $user->detail->address }}" required></x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('address')"></x-input-error>
                                </div>

                                <div>
                                    <x-input-label for="phone" :value="__('Phone number')" class="mt-4"></x-input-label>
                                    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" value="{{ $user->detail->phone }}" required></x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('phone')"></x-input-error>
                                </div>

                                <div>
                                    <x-input-label for="dob" :value="__('Date of birth')" class="mt-4"></x-input-label>
                                    <x-text-input id="dob" name="dob" type="date" class="mt-1 block w-full" value="{{ $user->detail->dob }}" required></x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('dob')"></x-input-error>
                                </div>

                                <div>
                                    <x-input-label for="pin" :value="__('Personal Identification Number')" class="mt-4"></x-input-label>
                                    <x-text-input id="pin" name="pin" type="text" class="mt-1 block w-full" value="{{ $user->detail->pin }}" required></x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('pin')"></x-input-error>
                                </div>

                                <div class="flex items-center gap-4 mt-4">
                                    <x-primary-button>{{ __('Update') }}</x-primary-button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
