<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Compact Profile Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-4 sm:p-6">
                    <div class="flex items-start justify-between">
                        <!-- Left: Profile Photo and Basic Info -->
                        <div class="flex items-start space-x-4 gap-4">
                            <img class="h-16 w-16 object-cover rounded-full ring-2 ring-gray-200 dark:ring-gray-700"
                                 src="{{asset('/storage/' . Auth::user()->profile_photo)}}"
                                 alt="{{ Auth::user()->name }}">

                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{'@' . Auth::user()->username }}</p>

                                <!-- Compact Stats -->
                                <div class="flex space-x-4 mt-1 gap-4">
                                    <span class="text-xs text-gray-500 dark:text-gray-400"><span class="font-semibold text-gray-700 dark:text-gray-300">256</span> Posts</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400"><span class="font-semibold text-gray-700 dark:text-gray-300">1.2k</span> Followers</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400"><span class="font-semibold text-gray-700 dark:text-gray-300">420</span> Following</span>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Edit Button -->
                        <a href="{{route('profile.edit')}}" class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">
                            {{ __('Edit Profile') }}
                        </a>
                    </div>

                    <!-- Bio (shortened) -->
                    <div class="mt-3">
                        <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-2">
                            {{Auth::user()->bio ?? __("No bio yet.")}}
                        </p>
                    </div>

                    <!-- Skills Tags (more compact) -->
                    <div class="flex flex-wrap gap-1 mt-2 gap-4">
                        <span class="px-2 py-0.5 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full text-xs">Laravel</span>
                        <span class="px-2 py-0.5 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-xs">Vue.js</span>
                        <span class="px-2 py-0.5 bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200 rounded-full text-xs">Tailwind</span>
                    </div>
                </div>
            </div>

            <!-- Post Creation Form (Compact) -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-4">
                    <form method="POST" action="{{route('create_post')}}" enctype="multipart/form-data">
                        @csrf

                        <!-- Textarea with placeholder -->
                        <div class="mb-3">
                            <textarea
                                id="content"
                                name="content"
                                rows="2"
                                class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                placeholder="What's on your mind?"
                                required
                            ></textarea>
                            @error('content')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Controls Row -->
                        <div class="flex justify-between items-center">
                            <!-- Image Upload Button -->
                            <label for="image" class="inline-flex items-center text-sm text-black dark:text-gray-400 cursor-pointer hover:text-indigo-600 dark:hover:text-indigo-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ __('Add Photo') }}
                            </label>
                            <input type="file" id="image" name="post_pic" accept="image/*" class="hidden" />

                            <!-- Post Button -->
                            <button
                                type="submit"
                                class="px-4 py-1.5 bg-indigo-600 text-black text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-150"
                            >
                                {{ __('Post') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>  

            @foreach ($posts as $post)
            <!-- Posts Feed (Placeholder - Add your actual posts loop here) -->
            <div class="space-y-4 mt-4">
                <!-- Sample Post (Remove this and replace with your actual posts loop) -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 sm:p-6">
                        <div class="flex items-center space-x-3 mb-3 gap-4">
                            <img class="h-6 w-6 object-cover rounded-full"
                                 src="{{asset('/storage/' . $post->profile_photo)}}"
                                 alt="{{$post->name }}">
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ $post->name }}</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{$post->created_at->diffForHumans()}}</p>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 mb-3">
                            {{$post->content}}                        
                        </p>
                        <!-- Sample post image (optional) -->
                        <img src="{{asset('/storage/' . $post->post_pic)}}" alt="Post image" class="w-auto h-auto rounded-lg mb-3">

                        <!-- Interaction buttons -->
                        <div class="flex gap-4 space-x-4 text-sm text-gray-500 dark:text-gray-400 pt-2 border-t border-gray-200 dark:border-gray-700">
                            <form action="{{ route('posts.like', $post) }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center space-x-1 hover:text-indigo-600 dark:hover:text-indigo-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                    </svg>
                                    <span>Like</span>
                                </button>
                            </form>
                            <p>{{ $post->likes_count }} Likes</p>

                            <button class="flex items-center space-x-1 hover:text-indigo-600 dark:hover:text-indigo-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <span>Comment</span>
                            </button>
                            <button class="flex items-center space-x-1 hover:text-indigo-600 dark:hover:text-indigo-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                                <span>Share</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
                <!-- Add more posts here or implement a loop -->
            </div>
        </div>
    </div>
</x-app-layout>
