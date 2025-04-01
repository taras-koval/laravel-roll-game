@extends('_layouts.app')

@section('content')
    <div class="container my-auto pb-20">

        @if(session('link'))
            <section class="mt-12 text-center">
                <header class="flex flex-col items-center text-center gap-8">
                    <h1 class="text-2xl font-extrabold">{{ __('Welcome!') }}</h1>
                    <a href="{{ session('link') }}" class="underline-link-component">{{ session('link') }}</a>
                </header>
            </section>
        @else
            <section class="flex flex-col max-w-[340px] mx-auto gap-6">
                <header class="flex flex-col items-center text-center gap-4">
                    <h1 class="text-2xl font-extrabold">{{ __('Registration') }}</h1>
                </header>

                <form action="{{ route('register') }}" method="post">
                    @csrf

                    <div class="mb-4">
                        <label for="username" class="label-component">{{ __('Username') }}</label>
                        <input type="text" name="username" id="username" required autofocus
                               placeholder="user-name"
                               value="{{ old('username') }}"
                               class="input-component w-full @error('username') border-red-500 @enderror">
                        @error('username')
                            <p class="error-component">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <label for="phonenumber" class="label-component">{{ __('Phone number') }}</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                                    <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z"/>
                                </svg>
                            </div>

                            <input type="text" name="phonenumber" id="phonenumber" pattern="[0-9]{10}" required
                                   placeholder="1234567890"
                                   value="{{ old('phonenumber') }}"
                                   class="input-component w-full ps-10 @error('phonenumber') border-red-500 @enderror">
                        </div>
                        @error('phonenumber')
                            <p class="error-component">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="button-primary-component w-full">
                        {{ __('Register') }}
                    </button>
                </form>
            </section>
        @endif

    </div>
@endsection
