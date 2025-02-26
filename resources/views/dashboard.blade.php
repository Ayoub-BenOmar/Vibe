<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <div class="relative">
                        <!-- Edit Profile Button - Top Right -->
{{--                        <button class="absolute top-0 right-0 px-4 py-2 bg-gray-800 dark:bg-gray-700 text-white rounded-lg hover:bg-gray-700 dark:hover:bg-gray-600 transition">--}}
{{--                          Edit Profile--}}
{{--                        </button>--}}

                        <div class="flex flex-col space-y-6">
                            <!-- Profile Picture in Square Frame - Top Left -->
                            <div class="flex items-start space-x-6">
                                <div class="relative">
                                    <img class="h-16 w-16 object-cover rounded-lg shadow-md border-2 border-gray-200 dark:border-gray-700"
                                         src="{{asset('/storage/' . Auth::user()->profile_photo)}}"
                                         alt="Profile Picture">
                                </div>

                                <!-- User Basic Info -->
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">@ {{ Auth::user()->username }}</h3>
                                    <p class="text-gray-500 dark:text-gray-400">{{ Auth::user()->name }}</p>
                                </div>
                            </div>

                            <!-- Stats Section -->
                            <div class="flex space-x-6 gap-4">
                                <div class="text-center">
                                    <span class="block font-bold text-gray-900 dark:text-gray-100">256</span>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">Posts</span>
                                </div>
                                <div class="text-center">
                                    <span class="block font-bold text-gray-900 dark:text-gray-100">1.2k</span>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">Followers</span>
                                </div>
                                <div class="text-center">
                                    <span class="block font-bold text-gray-900 dark:text-gray-100">420</span>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">Following</span>
                                </div>
                            </div>

                            <!-- Bio Section -->
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">Bio</h4>
                                <p class="text-gray-600 dark:text-gray-300">
                                    {{Auth::user()->bio ?? __("There's No Bio Yet")}}
                                </p>
                            </div>

                            <!-- Skills Tags -->
                            <div class="flex space-x-3">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full text-sm">Laravel</span>
                                <span class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-sm">Vue.js</span>
                                <span class="px-3 py-1 bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200 rounded-full text-sm">Tailwind</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Simple Post Creation Form -->
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                        Create New Post
                    </h3>

                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Post Content -->
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                What's on your mind?
                            </label>
                            <textarea
                                id="content"
                                name="content"
                                rows="4"
                                class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition"
                                placeholder="Share your thoughts..."
                                required
                            ></textarea>
                            @error('content')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Simple Image Upload -->
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Add an image (optional)
                            </label>
                            <input
                                type="file"
                                id="image"
                                name="image"
                                accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900 dark:file:text-indigo-200 dark:text-gray-400"
                            />
                            @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button
                                type="submit"
                                class="px-6 py-2 bg-indigo-500 text-white font-medium rounded-lg shadow hover:bg-indigo-600 transition-all duration-200"
                            >
                                Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
