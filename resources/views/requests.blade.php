<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Friend Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- If no friend requests -->
            @if($requests->isEmpty())
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-8 text-center">
                <p class="text-gray-600 dark:text-gray-400">{{ __("You don't have any friend requests at the moment.") }}</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($requests as $request)
                <div class="bg-white rounded-md dark:bg-gray-800 overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 rounded-xl">
                    <div class="p-6">
                        <div class="flex flex-col space-y-4">
                            <!-- Profile Picture -->
                            <div class="relative group">
                                <img class="h-16 w-16 rounded-md object-cover rounded-xl shadow-md border-2 border-gray-200 dark:border-gray-700 group-hover:border-indigo-500 transition-colors duration-300"
                                     src="{{asset('/storage/' . $request->sender->profile_photo)}}"
                                     alt="Profile Picture">
                            </div>

                            <!-- Username and Name -->
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">@ {{ $request->sender->username }}</h3>
                                <p class="text-gray-500 dark:text-gray-400">{{ $request->sender->name }}</p>
                            </div>

                            <!-- Request Time -->
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                {{ __('Requested') }}: {{ $request->created_at->diffForHumans() }}
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2">
                                <form action="{{ route('friends.accept', $request->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 rounded-full font-medium text-sm transition-all duration-300 bg-green-500 text-white hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                        {{ __('Accept') }}
                                    </button>
                                </form>

                                <form action="{{ route('friends.reject', $request->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 rounded-full font-medium text-sm transition-all duration-300 bg-red-500 text-white hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                        {{ __('Reject') }}
                                    </button>
                                </form>
                            </div>

                            <!-- Bio Section -->
                            <div>
                                <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                    {{$request->sender->bio ?? __("There's No Bio Yet")}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
