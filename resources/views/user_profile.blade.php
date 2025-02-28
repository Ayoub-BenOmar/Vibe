<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold">{{ $user->name }}'s Profile</h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <!-- User Information -->
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 mb-6">
            <div class="flex items-center space-x-4">
                <!-- Profile Photo -->
                <img src="{{ asset($user->profile_photo ? 'storage/' . $user->profile_photo : 'images/default-profile.png') }}" alt="{{ $user->name }}" class="w-20 h-20 rounded-full">

                <!-- User Details -->
                <div>
                    <h1 class="text-xl font-bold">{{ $user->name }}</h1>
                    <p class="text-gray-600 dark:text-gray-400">{{ $user->username }}</p>
                    <p class="text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                    <p class="text-gray-600 dark:text-gray-400">{{ $user->bio }}</p>
                </div>
            </div>
        </div>

        <!-- User's Posts -->
        <div class="space-y-4">
            @foreach ($posts as $post)
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <!-- Post Content -->
                    <p class="text-gray-800 dark:text-gray-200">{{ $post->content }}</p>

                    <!-- Post Image -->
                    @if ($post->post_pic)
                        <img src="{{ asset('storage/' . $post->post_pic) }}" alt="Post Image" class="w-auto h-auto rounded-lg mt-4">
                    @endif

                    <!-- Post Metadata -->
                    <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                        <p>Posted {{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>