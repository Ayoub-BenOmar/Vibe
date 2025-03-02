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
                                     src="{{asset('/storage/' . $request->sender_image)}}"
                                     alt="Profile Picture">
                            </div>
    
                            <!-- Username and Name -->
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">@ {{ $request->sender_username }}</h3>
                                <p class="text-gray-500 dark:text-gray-400">{{ $request->sender_name }}</p>
                            </div>
    
                            <!-- Action Buttons -->
                            <div class="flex gap-2">
                                <form action="{{ route('accept_request', $request->sender_id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 rounded-full font-medium text-sm transition-all duration-300 bg-green-500 text-black hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                        {{ __('Accept') }}
                                    </button>
                                </form>
    
                                <form action="{{ route('reject_request', $request->sender_id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 rounded-full font-medium text-sm transition-all duration-300 bg-red-500 text-black hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                        {{ __('Reject') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</body>
</html>
