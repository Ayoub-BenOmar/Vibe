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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Compact Profile Card -->
            <div class="custom-card mb-6">
                <div class="p-5 sm:p-6">
                    <div class="flex items-start justify-between">
                        <!-- Left: Profile Photo and Basic Info -->
                        <div class="flex items-start space-x-4 gap-4">
                            <div class="relative">
                                <img class="h-16 w-16 object-cover rounded-full ring-2 ring-primary-light"
                                     src="{{ asset('/storage/' . Auth::user()->profile_photo) }}"
                                     alt="{{ Auth::user()->name }}">
                                <div class="absolute -bottom-1 -right-1 h-5 w-5 bg-success-color rounded-full border-2 border-dark-card"></div>
                            </div>

                            <div>
                                <h3 class="text-xl font-bold text-white">{{ Auth::user()->name }}</h3>
                                <p class="text-sm text-dark-text-secondary">{{ '@' . Auth::user()->username }}</p>

                                <!-- Compact Stats -->
                                <div class="flex space-x-6 mt-2">
                                    <span class="text-xs text-dark-text-secondary"><span class="font-semibold text-dark-text-primary">256</span> Posts</span>
                                    <span class="text-xs text-dark-text-secondary"><span class="font-semibold text-dark-text-primary">1.2k</span> Followers</span>
                                    <span class="text-xs text-dark-text-secondary"><span class="font-semibold text-dark-text-primary">420</span> Following</span>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Edit Button -->
                        <a href="{{ route('profile.edit') }}" class="action-button action-button-primary text-xs">
                            {{ __('Edit Profile') }}
                        </a>
                    </div>

                    <!-- Bio (shortened) -->
                    <div class="mt-3">
                        <p class="text-sm text-dark-text-secondary line-clamp-2">
                            {{ Auth::user()->bio ?? __("No bio yet.") }}
                        </p>
                    </div>

                    <!-- Skills Tags (more compact) -->
                    <div class="flex flex-wrap gap-2 mt-3">
                        <span class="custom-tag" style="background-color: rgba(56, 139, 253, 0.15); color: #58a6ff;">Laravel</span>
                        <span class="custom-tag" style="background-color: rgba(52, 199, 89, 0.15); color: #3cce64;">Vue.js</span>
                        <span class="custom-tag" style="background-color: rgba(175, 82, 222, 0.15); color: #bf68ee;">Tailwind</span>
                    </div>
                </div>
            </div>

            <!-- Post Creation Form -->
            <div class="custom-card mb-6">
                <div class="p-5">
                    <form method="POST" action="{{ route('create_post') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Textarea with placeholder -->
                        <div class="mb-4">
                            <textarea
                                id="content"
                                name="content"
                                rows="2"
                                class="custom-textarea w-full focus:outline-none"
                                placeholder="What's on your mind?"
                                required
                            ></textarea>
                            @error('content')
                            <p class="text-danger-color text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Controls Row -->
                        <div class="flex justify-between items-center">
                            <!-- Image Upload Button -->
                            <label for="image" class="flex items-center text-sm text-dark-text-secondary cursor-pointer hover:text-primary-light transition-colors">
                                <div class="icon-container mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                {{ __('Add Photo') }}
                            </label>
                            <input type="file" id="image" name="post_pic" accept="image/*" class="hidden" />

                            <!-- Post Button -->
                            <button
                                type="submit"
                                class="action-button action-button-primary"
                            >
                                {{ __('Post') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Posts Feed -->
            <div class="space-y-6 mt-6">
                @foreach ($posts as $post)
                <div class="custom-card">
                    <div class="p-5 sm:p-6">
                        <!-- User info and timestamp -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-3 mb-4">
                                <a href="{{ route('users.show', $post->user_id) }}" class="block">
                                    <div class="relative">
                                        <img class="h-12 w-12 object-cover rounded-full border-2 border-primary transition-colors duration-200"
                                            src="{{ asset('/storage/' . $post->profile_photo) }}"
                                            alt="{{ $post->name }}">
                                    </div>
                                </a>
                                <div>
                                    <h4 class="font-medium text-white">{{ $post->name }}</h4>
                                    <p class="text-xs text-dark-text-secondary">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            @if ($post->user_id === auth()->id())
                                <div class="flex space-x-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('posts.edit', $post) }}" 
                                       class="action-button action-button-primary">
                                       Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="action-button action-button-danger"
                                                onclick="return confirm('Are you sure you want to delete this post?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>

                        <!-- Post content -->
                        <p class="text-dark-text-primary mb-4 leading-relaxed">
                            {{ $post->content }}
                        </p>

                        <!-- Post image (if any) -->
                        @if ($post->post_pic)
                            <div class="rounded-lg overflow-hidden mb-4 shadow-lg flex justify-center">
                                <img src="{{ asset('/storage/' . $post->post_pic) }}" alt="Post image" class="w-fit h-fit">
                            </div>
                        @endif

                        <!-- Interaction section -->
                        <div class="pt-4 border-t border-dark-border">
                            <!-- Likes and Share buttons -->
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center gap-6">
                                    <form action="{{ route('posts.like', $post) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-2 text-dark-text-secondary hover:text-primary transition like-animation">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                            </svg>
                                            <span>Like</span>
                                        </button>
                                    </form>
                                    <span class="text-sm text-dark-text-secondary">{{ $post->likes_count }} Likes</span>
                                </div>

                                <button class="flex items-center gap-2 text-dark-text-secondary hover:text-primary transition like-animation">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                    <span>Share</span>
                                </button>
                            </div>

                            <!-- Comments section -->
                            <div class="mt-4">
                                <!-- Display existing comments -->
                                @if ($post->comments->count() > 0)
                                    <div class="bg-dark-surface rounded-lg p-4 mb-4">
                                        @foreach ($post->comments as $comment)
                                            <div class="comment mb-3 p-2 {{ !$loop->last ? 'border-b border-dark-border pb-3' : '' }}">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <img src="{{ asset('/storage/' . $comment->user->profile_photo) }}" alt="{{ $comment->user->name }}" class="w-6 h-6 rounded-full ring-1 ring-primary-light">
                                                    <p class="font-medium text-sm text-white">{{ $comment->user->name }}</p>
                                                    <span class="text-xs text-dark-text-secondary">{{ $comment->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="text-sm text-dark-text-primary pl-8">{{ $comment->content }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Add comment form -->
                                <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-3">
                                    @csrf
                                    <div class="flex gap-2">
                                        <textarea name="content" rows="1" class="custom-textarea w-full text-sm" placeholder="Write a comment..."></textarea>
                                        <button type="submit" class="action-button action-button-primary">Comment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>