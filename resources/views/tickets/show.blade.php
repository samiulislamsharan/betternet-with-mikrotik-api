<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6 border-b-2 border-slate-100 pb-4">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Ticket ID #') . $ticket->number }}
                        </h2>

                        @if($ticket->status == "Open")
                            <form action="{{ route('close.ticket', $ticket->id) }}" method="post">
                                @csrf
                                <x-text-input name="ticket_id" type="hidden" value="{{ $ticket->id }}"></x-text-input>
                                <x-danger-button>{{ __('Close ticket') }}</x-danger-button>
                            </form>
                        @endif
                        @if($ticket->status == "Close")
                            <form action="{{ route('open.ticket', $ticket->id) }}" method="post">
                                @csrf
                                <x-text-input name="ticket_id" type="hidden" value="{{ $ticket->id }}"></x-text-input>
                                <x-success-button>{{ __('Re-open ticket') }}</x-success-button>
                            </form>
                        @endif
                    </div>

                    <div class="mt-6 font-semibold">
                        {{ __('Subject: ') . $ticket->subject }}
                    </div>

                    <div class="mt-2 text-xs">
                        {{ __('Created by: ') . $ticket->user->name . __(' On: ') . $ticket->created_at }}
                    </div>

                    <div class="mt-6">
                        {{ $ticket->message }}
                    </div>

                    <div class="my-6 border border-gray-100"></div>

                    <div>
                        @foreach($comments as $comment)
                            <p class="mt-6 text-xs">
                                {{ __('Created by: ') . $comment->user->name . __(' On: ') . $comment->created_at}}
                            </p>
                            <p class="mt-2">
                                {{  $comment->comment }}
                            </p>
                        @endforeach

                        @if($ticket->status == "Open")

                            <form action="{{ route('add.comment') }}" method="post">
                                @csrf
                                <div>
                                    <x-input-label for="comment" :value="__('Add comment')" class="mt-4"></x-input-label>
                                    <textarea name="comment" class="px-3 py-3 mt-1 rounded-lg border-gray-300 md:text-sm block w-full" rows="5"></textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('comment')"></x-input-error>
                                </div>
                                <x-text-input name="ticket_id" type="hidden" value="{{ $ticket->id }}"></x-text-input>

                                <div class="flex items-center gap-4 mt-4">
                                    <x-success-button>{{ __('Submit') }}</x-success-button>
                                </div>
                            </form>

                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
