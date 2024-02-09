<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('error'))
                        <div class="alert alert-danger text-red-600">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="flex justify-between items-center mb-6 border-b-2 border-slate-100 pb-4">
                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            {{ $user->name }}
                        </h2>
                        <div class="flex items-center">
                            <a href="{{ route('single.download', $user->id) }}" class="ml-2 inline-flex items-center px-4 py-2 bg-orange-400 text-white dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs rounded uppercase">
                                {{ __('Download') }}
                            </a>

                            <a href="{{ route('package-change', $user->id) }}" class="ml-2 inline-flex items-center px-4 py-2 bg-sky-500 text-white dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs rounded uppercase">
                                {{ __('Change package') }}
                            </a>

                            <a href="{{ route('users.edit', $user->id) }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white rounded uppercase">
                                {{ __('Edit') }}
                            </a>

                            @if($user->detail->status == 'active')
                                <form method="post" action="{{ route('user.disable', $user->id) }}">
                                    @csrf
                                    @method('patch')
                                    <div class="flex items-center gap-4 ml-2">
                                        <x-danger-button>{{ __('Disable') }}</x-danger-button>
                                    </div>
                                </form>
                            @endif
                            @if($user->detail->status == 'inactive')
                                <form method="post" action="{{ route('user.enable', $user->id) }}">
                                    @csrf
                                    @method('patch')
                                    <div class="flex items-center gap-4 ml-2">
                                        <x-success-button>{{ __('Enable') }}</x-success-button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div>
                        <livewire:user-show user="{{ $user->id }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
