<x-app-layout>
    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Content Field -->
                        <div class="mb-6">
                            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                What's on your mind?
                            </label>
                            <textarea 
                                id="content" 
                                name="content" 
                                rows="5" 
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white transition duration-150 ease-in-out"
                                placeholder="Share your thoughts..."
                            >{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Image Field -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Add a photo
                            </label>
                            
                            <!-- Current Image Preview -->
                            @if ($post->post_pic)
                            <div class="mb-4 p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div class="flex items-center justify-between mb-2">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Current image:</p>
                                    <span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        JPEG/PNG
                                    </span>
                                </div>
                                <div class="relative group">
                                    <img 
                                        src="{{ asset('/storage/' . $post->post_pic) }}" 
                                        alt="Current Post Image" 
                                        class="w-full h-auto object-cover rounded-lg shadow-md"
                                    >
                                    <div class="absolute inset-0 bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition duration-200"></div>
                                </div>
                            </div>
                            @endif
                            
                            <!-- File Upload -->
                            <div class="mt-2">
                                <label for="post_pic" class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">
                                    Replace with a new image (optional)
                                </label>
                                <div class="flex items-center justify-center w-full">
                                    <label for="post_pic" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 transition duration-150 ease-in-out">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-3 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                            </svg>
                                            <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                                                <span class="font-semibold">Click to upload</span> or drag and drop
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                JPEG, PNG or GIF
                                            </p>
                                        </div>
                                        <input id="post_pic" name="post_pic" type="file" class="hidden" />
                                    </label>
                                </div>
                                @error('post_pic')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                            <a 
                                href="{{ route('dashboard') }}" 
                                class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Cancel
                            </a>
                            <button 
                                type="submit" 
                                class="inline-flex items-center px-5 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 border border-transparent rounded-md font-semibold text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out"
                            >
                                Update Post
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>