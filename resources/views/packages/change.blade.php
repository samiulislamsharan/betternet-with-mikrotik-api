<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="p-4 sm:p-8">
                    @if(session('error'))
                        <div class="alert alert-danger text-red-600">
                            {{ session('error') }}
                        </div>
                    @endif

                        <h2 class="font-semibold text-xl text-gray-800 dleading-tight border-b-2 border-slate-100 pb-4">
                            {{ __('Change Package') }}
                        </h2>

                    <form method="post" action="{{ route('package-update', $user->id) }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h2 class="text-lg font-medium text-gray-900">{{ __('Change package') }}</h2>
                                <p class="mt-1 text-sm text-gray-600">{{ __("Change package for user ") . $user->name }}</p>
                            </div>

                            <div>
                                <div>
                                    <x-input-label for="package_name" :value="__('Package name')"></x-input-label>
                                    <select name="package_name" id="package_name" class="mt-1 block w-full rounded-md border border-gray-300">
                                        <option value="">{{ $user->detail->package_name }}</option>
                                        @foreach($packages as $package)
                                            <option value="{{ $package->id }}">{{ $package->name }}</option>
                                        @endforeach
                                    </select>
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
