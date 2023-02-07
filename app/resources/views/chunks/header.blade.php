@if (Route::has('login'))
    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block w-100">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    @auth
                        <a href="{{ url('/') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                        &nbsp;
                        @if (auth()->user()->isAdmin())
                            &nbsp;
                            <a href="{{ url('/users') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">All
                                Users</a>
                        @endif
                    @endauth
                </div>
                <div class="d-flex align-items-center">
                    @auth
                        <a href="{{ url('/users/profile') }}"
                            class="text-sm text-gray-700 dark:text-gray-500 underline d-flex align-items-center">
                            <img src="" class="d-none avatar me-3"
                                style="width: 40px; height: 40px; border-radius: 50%;" />
                            @if (auth()->user()->info && (auth()->user()->info->first_name || auth()->user()->info->last_name))
                                {{ trim(implode(' ', [auth()->user()->info->first_name, auth()->user()->info->last_name])) }}
                            @else
                                {{ auth()->user()->email }}
                            @endif
                        </a>&nbsp;&nbsp;
                        <a href="{{ url('/logout') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log
                            Out</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endif
