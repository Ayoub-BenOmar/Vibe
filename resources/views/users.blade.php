<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Community Members') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

{{--            <div class="mb-6">--}}
{{--                <div class="relative flex items-center">--}}
{{--                    <input--}}
{{--                        type="search"--}}
{{--                        name="search"--}}
{{--                        class="w-full rounded-full pl-12 pr-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-800"--}}
{{--                        placeholder="Search members..."--}}
{{--                    >--}}
{{--                    <svg class="w-4 h-4 text-gray-500 left-4 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--            </div>--}}
            <form method="GET" action="{{ route('users') }}" class="mb-4">
                <input type="text" name="members.search" placeholder="Search by Username or Email"
                       value="{{ request('search') }}" class="form-control mb-2">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($users as $user)
                <!-- User Card -->
                <div class="bg-white rounded-md dark:bg-gray-800 overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 rounded-xl">
                    <div class="p-6">
                        <div class="flex flex-col space-y-4">
                            <!-- Profile Picture and Basic Info -->
                            <div class="flex  items-start space-x-4 gap-4">
                                <div class="relative group ">
                                    <img class="h-16 w-16 rounded-md object-cover rounded-xl shadow-md border-2 border-gray-200 dark:border-gray-700 group-hover:border-indigo-500 transition-colors duration-300"
                                         src="{{asset('/storage/' . $user->profile_photo)}}"
                                         alt="Profile Picture">
                                </div>

                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">@ {{ $user->username }}</h3>
                                    <p class="text-gray-500 dark:text-gray-400">{{ $user->name }}</p>
                                </div>
                            </div>

                            <!-- Bio Section -->
                            <div class="mt-4">
                                <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                    {{$user->bio ?? __("There's No Bio Yet")}}
                                </p>
                            </div>

                            <!-- Stats Section with Gradient Backgrounds -->
                            <div class="flex justify-between gap-4 mt-6">
                                <div class="text-center bg-gradient-to-br from-pink-50 to-purple-50 dark:from-pink-900/20 dark:to-purple-900/20 p-3 rounded-lg flex-1">
                                    <span class="block font-bold text-gray-900 dark:text-gray-100">256</span>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">Posts</span>
                                </div>
                                <div class="text-center bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 p-3 rounded-lg flex-1">
                                    <span class="block font-bold text-gray-900 dark:text-gray-100">1.2k</span>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">Followers</span>
                                </div>
                                <div class="text-center bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 p-3 rounded-lg flex-1">
                                    <span class="block font-bold text-gray-900 dark:text-gray-100">420</span>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">Following</span>
                                </div>
                            </div>

                            <!-- Skills Tags with Enhanced Design -->
                            <div class="flex flex-wrap gap-2 mt-4">
                                <span class="px-4 py-1.5 bg-gradient-to-r from-pink-100 to-rose-100 dark:from-pink-900/40 dark:to-rose-900/40 text-pink-800 dark:text-pink-200 rounded-full text-sm font-medium shadow-sm">Laravel</span>
                                <span class="px-4 py-1.5 bg-gradient-to-r from-emerald-100 to-green-100 dark:from-emerald-900/40 dark:to-green-900/40 text-emerald-800 dark:text-emerald-200 rounded-full text-sm font-medium shadow-sm">Vue.js</span>
                                <span class="px-4 py-1.5 bg-gradient-to-r from-blue-100 to-cyan-100 dark:from-blue-900/40 dark:to-cyan-900/40 text-blue-800 dark:text-blue-200 rounded-full text-sm font-medium shadow-sm">Tailwind</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- End User Card -->

                <!-- Repeat the card structure for more users -->
            </div>
        </div>
    </div>
</x-app-layout>
