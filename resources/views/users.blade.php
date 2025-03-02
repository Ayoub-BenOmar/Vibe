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

            <form method="GET" action="{{ route('members.search') }}" class="mb-8 max-w-2xl mx-auto">
                <div class="relative flex items-center gap-3">
                    <!-- Search Input -->
                    <div class="relative flex-1">
                        <input
                            type="text"
                            name="search"
                            placeholder="Rechercher par pseudo ou email"
                            value="{{ request('search') }}"
                            class="w-full px-4 py-3 pl-11 bg-dark-card border border-dark-border rounded-full focus:ring-2 focus:ring-primary focus:border-primary transition-all text-dark-text-primary"
                            style="background-color: #262626; border-color: #333333; color: #e0e0e0;"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-dark-text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #aaaaaa;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <!-- Search Button -->
                    <button
                        type="submit"
                        class="px-6 py-3 text-white font-medium rounded-full shadow-md transition-all duration-200 flex items-center gap-2"
                        style="background-color: #6c44fc; box-shadow: 0 4px 12px rgba(108, 68, 252, 0.2);"
                        onmouseover="this.style.backgroundColor='#4526c9'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(108, 68, 252, 0.3)';"
                        onmouseout="this.style.backgroundColor='#6c44fc'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(108, 68, 252, 0.2)';"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Rechercher
                    </button>
                </div>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- User Card -->
                @foreach($users as $user)
                    <div class="overflow-hidden shadow-lg transition-all duration-300 rounded-xl" 
                         style="background-color: #262626; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);"
                         onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 24px rgba(0, 0, 0, 0.3)';"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 16px rgba(0, 0, 0, 0.2)';">
                        <div class="p-6">
                            <div class="flex flex-col space-y-4">
                                <!-- Profile Picture -->
                                <div class="relative group">
                                    <div class="overflow-hidden rounded-xl" style="width: fit-content;">
                                        <img class="h-20 w-20 object-cover rounded-xl transition-all duration-300"
                                             src="{{asset('/storage/' . $user->profile_photo)}}"
                                             alt="Profile Picture"
                                             style="border: 2px solid #333333; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);"
                                             onmouseover="this.style.borderColor='#6c44fc'; this.style.transform='scale(1.05)';"
                                             onmouseout="this.style.borderColor='#333333'; this.style.transform='scale(1)';">
                                    </div>
                                    <div class="absolute -bottom-1 -right-1 h-5 w-5 rounded-full border-2" 
                                         style="background-color: #42d392; border-color: #262626;"></div>
                                </div>

                                <!-- Username and Name -->
                                <div>
                                    <h3 class="text-xl font-bold" style="color: #ffffff;">{{'@' . $user->username }}</h3>
                                    <p style="color: #aaaaaa;">{{ $user->name }}</p>
                                </div>

                                <!-- Add Friend Button -->
                                <form action="/users/send_request/{{$user->id}}" method="POST" class="inline">
                                    @csrf <!-- CSRF token for security -->
                                    <button type="submit" 
                                            class="flex items-center justify-center gap-2 px-5 py-2.5 rounded-full font-medium text-sm transition-all duration-300 w-full text-white"
                                            style="background-color: #6c44fc; box-shadow: 0 4px 12px rgba(108, 68, 252, 0.2);"
                                            onmouseover="this.style.backgroundColor='#4526c9'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(108, 68, 252, 0.3)';"
                                            onmouseout="this.style.backgroundColor='#6c44fc'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(108, 68, 252, 0.2)';">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 5v14M5 12h14"/>
                                        </svg>
                                        Add Friend
                                    </button>
                                </form>

                                <!-- Bio Section -->
                                <div class="bg-opacity-20 rounded-lg p-3" style="background-color: rgba(255, 255, 255, 0.05);">
                                    <p class="text-sm leading-relaxed" style="color: #e0e0e0;">
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
</body>
</html>