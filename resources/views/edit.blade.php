<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Style for dark color scheme -->
    <style>
        :root {
            --primary-color: #6c44fc; /* Rich purple */
            --primary-light: #9172fc; /* Lighter purple */
            --primary-dark: #4526c9; /* Darker purple */
            --primary-contrast: #ffffff; /* White */
            --dark-bg: #121212; /* Very dark background */
            --dark-surface: #1e1e1e; /* Dark surface */
            --dark-card: #262626; /* Dark card background */
            --dark-card-hover: #2d2d2d; /* Hover state */
            --dark-border: #333333; /* Dark borders */
            --dark-text-primary: #e0e0e0; /* Primary text */
            --dark-text-secondary: #aaaaaa; /* Secondary text */
            --dark-text-muted: #777777; /* Muted text */
            --success-color: #42d392; /* Success green */
            --danger-color: #ff6370; /* Danger red */
        }

        body {
            background-color: var(--dark-bg);
            color: var(--dark-text-primary);
        }

        .bg-primary {
            background-color: var(--primary-color) !important;
        }

        .text-primary {
            color: var(--primary-color) !important;
        }

        .border-primary {
            border-color: var(--primary-color) !important;
        }

        .hover\:bg-primary-dark:hover {
            background-color: var(--primary-dark) !important;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: var(--primary-contrast);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(108, 68, 252, 0.3);
        }

        /* Card styling */
        .custom-card {
            background-color: var(--dark-card);
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        }

        /* Button styles */
        .action-button {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .action-button-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .action-button-primary:hover {
            background-color: var(--primary-dark);
            box-shadow: 0 4px 12px rgba(108, 68, 252, 0.3);
            transform: translateY(-2px);
        }

        .action-button-danger {
            background-color: var(--danger-color);
            color: white;
        }

        .action-button-danger:hover {
            background-color: #e53e5c;
            box-shadow: 0 4px 12px rgba(255, 99, 112, 0.3);
            transform: translateY(-2px);
        }

        /* Form controls */
        .custom-input, .custom-textarea {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            color: var(--dark-text-primary);
            padding: 0.75rem;
            transition: all 0.3s ease;
        }

        .custom-input:focus, .custom-textarea:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(108, 68, 252, 0.2);
            background-color: rgba(255, 255, 255, 0.07);
        }

        /* Custom badge/tag */
        .custom-tag {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .custom-tag:hover {
            transform: translateY(-2px);
        }

        /* Gradient accent */
        .gradient-accent {
            background: linear-gradient(135deg, var(--primary-color), #9c44fc);
        }

        /* Icons styling */
        .icon-container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: rgba(108, 68, 252, 0.1);
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .icon-container:hover {
            background-color: var(--primary-color);
            color: white;
            transform: scale(1.1);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--dark-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-dark);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }

        /* Like animation */
        .like-animation {
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .like-animation:hover {
            transform: scale(1.2);
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Page Content -->
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
</body>
</html>