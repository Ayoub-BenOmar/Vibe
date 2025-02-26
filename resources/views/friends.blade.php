<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Friends') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Search form -->
{{--            <form method="GET" action="{{ route('friends.search') }}" class="mb-6 max-w-2xl mx-auto">--}}
{{--                <div class="relative flex items-center gap-3">--}}
{{--                    <div class="relative flex-1">--}}
{{--                        <input--}}
{{--                            type="text"--}}
{{--                            name="search"--}}
{{--                            placeholder="Search friends by name or username"--}}
{{--                            value="{{ request('search') }}"--}}
{{--                            class="w-full px-4 py-2.5 pl-11 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-all"--}}
{{--                        >--}}
{{--                        <svg class="w-5 h-5 absolute left-3 top-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                            <circle cx="11" cy="11" r="8"></circle>--}}
{{--                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>--}}
{{--                        </svg>--}}
{{--                    </div>--}}

{{--                    <button--}}
{{--                        type="submit"--}}
{{--                        class="px-6 py-2.5 bg-gray-600 hover:bg-blue-700 text-white font-medium rounded-full shadow-sm hover:shadow transition-all duration-200 flex items-center gap-2"--}}
{{--                    >--}}
{{--                        Search--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </form>--}}

            <!-- If no friends -->
            @if($friends->isEmpty())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-8 text-center">
                    <p class="text-gray-600 dark:text-gray-400">{{ __("You haven't added any friends yet.") }}</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($friends as $friend)
                        <div class="bg-white rounded-md dark:bg-gray-800 overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 rounded-xl">
                            <div class="p-6">
                                <div class="flex flex-col space-y-4">
                                    <!-- Profile Picture -->
                                    <div class="relative group">
                                        <img class="h-16 w-16 rounded-md object-cover rounded-xl shadow-md border-2 border-gray-200 dark:border-gray-700 group-hover:border-indigo-500 transition-colors duration-300"
                                             src="{{asset('/storage/' . $friend->friend_image)}}"
                                             alt="Profile Picture">
                                    </div>

                                    <!-- Username and Name -->
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">@ {{ $friend->friend_username }}</h3>
                                        <p class="text-gray-500 dark:text-gray-400">{{ $friend->friend_name }}</p>
                                    </div>

                                    <!-- Friends Since -->
{{--                                    <div class="text-xs text-gray-500 dark:text-gray-400">--}}
{{--                                        {{ __('Friends since') }}: {{ $friend->pivot->created_at->format('M d, Y') }}--}}
{{--                                    </div>--}}

                                    <!-- Action Buttons -->
{{--                                    <div class="flex gap-2">--}}
{{--                                        <a href="{{ route('profile.view', $friend->username) }}" class="flex-1 flex items-center justify-center gap-2 px-4 py-2 rounded-full font-medium text-sm transition-all duration-300 bg-indigo-500 text-white hover:bg-indigo-600 dark:bg-indigo-600 dark:hover:bg-indigo-700">--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>--}}
{{--                                                <circle cx="12" cy="12" r="3"></circle>--}}
{{--                                            </svg>--}}
{{--                                            {{ __('View Profile') }}--}}
{{--                                        </a>--}}

{{--                                        <form action="{{ route('friends.remove', $friend->id) }}" method="POST" class="flex-1" onsubmit="return confirm('{{ __('Are you sure you want to remove this friend?') }}')">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
{{--                                            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 rounded-full font-medium text-sm transition-all duration-300 bg-gray-200 text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                                                    <path d="M18 6L6 18M6 6l12 12"></path>--}}
{{--                                                </svg>--}}
{{--                                                {{ __('Remove') }}--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}

                                    <!-- Bio Section -->
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                            {{$friend->bio ?? __("There's No Bio Yet")}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
{{--                <div class="mt-6">--}}
{{--                    {{ $friends->links() }}--}}
{{--                </div>--}}
            @endif
        </div>
    </div>
</x-app-layout>
