<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Community Members') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="GET" action="{{ route('members.search') }}" class="mb-6 max-w-2xl mx-auto">
                <div class="relative flex items-center gap-3">
                    <!-- Search Input -->
                    <div class="relative flex-1">
                        <input
                            type="text"
                            name="search"
                            placeholder="Rechercher par pseudo ou email"
                            value="{{ request('search') }}"
                            class="w-full px-4 py-2.5 pl-11 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-all"
                        >
                    </div>

                    <!-- Search Button -->
                    <button
                        type="submit"
                        class="px-6 py-2.5 bg-gray-600 hover:bg-blue-700 text-white font-medium rounded-full shadow-sm hover:shadow transition-all duration-200 flex items-center gap-2"
                    >
                        Rechercher
                    </button>
                </div>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- User Card -->
                @foreach($users as $user)
                    <div class="bg-white rounded-md dark:bg-gray-800 overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 rounded-xl">
                        <div class="p-6">
                            <div class="flex flex-col space-y-4">
                                <!-- Profile Picture -->
                                <div class="relative group">
                                    <img class="h-16 w-16 rounded-md object-cover rounded-xl shadow-md border-2 border-gray-200 dark:border-gray-700 group-hover:border-indigo-500 transition-colors duration-300"
                                         src="{{asset('/storage/' . $user->profile_photo)}}"
                                         alt="Profile Picture">
                                </div>

                                <!-- Username and Name -->
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">@ {{ $user->username }}</h3>
                                    <p class="text-gray-500 dark:text-gray-400">{{ $user->name }}</p>
                                </div>

                                <!-- Follow Button -->

                                <form action="/users/send_request/{{$user->id}}" method="POST" class="inline">
                                    @csrf <!-- CSRF token for security -->
                                    <button type="submit" class="flex items-center justify-right gap-2 px-4 py-2 rounded-full font-medium text-sm transition-all duration-300 bg-indigo-500 text-black hover:bg-indigo-600 dark:bg-indigo-600 dark:hover:bg-indigo-700 w-full sm:w-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 5v14M5 12h14"/>
                                        </svg>
                                        Add Friend
                                    </button>
                                </form>

                                <!-- Bio Section -->
                                <div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                        {{$user->bio ?? __("There's No Bio Yet")}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- End User Card -->
            </div>
        </div>
    </div>
</x-app-layout>
