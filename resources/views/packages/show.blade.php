<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6 border-b-2 border-slate-100 pb-4">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ $package->name . __(' Package Detail') }}
                    </h2>
                    </div>
                    <livewire:package-show package="{{ $package->name }}" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
