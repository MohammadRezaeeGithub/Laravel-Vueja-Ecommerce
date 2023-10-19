<x-app-layout>
    <!--The signup section-->
    <section class="w-full sm:w-[400px] px-5 mx-auto mt-6 h-full flex flex-col justify-center items-center">
        <h2 class="text-2xl font-semibold mb-3">Create to your account</h2>
        <p class="mb-3">Or <a href="{{ route('login') }}" class="text-purple-700 hover:text-purple-500">Login with an existing
                account</a></p>

        <form action="{{ route('register') }}" method="post" class="w-full">
            @csrf
            <div class="w-full mb-3">
                <x-input type="text" name="name" value="{{ old('name') }}" placeholder="Your name ..." />
            </div>
            <div class="w-full mb-3">
                <x-input type="email" name="email" value="{{ old('email') }}" placeholder="Your email ..." />
            </div>
            <div class="w-full mb-3">
                <x-input type="password" name="password" placeholder="Your password ..." />
            </div>
            <div class="w-full">
                <x-input type="password" name="password_confirmation" placeholder="Your password confirmation ..." />
            </div>
            <button
                class="text-white py-2 px-3 rounded-md shadow-md mt-3 flex items-center w-full justify-center transition-colors hover:bg-emerald-500 bg-emerald-700"
                type="submit">
                SignUp
            </button>
            </form>
    </section>
    <!--The end of the signup section-->
</x-app-layout>


{{--<x-guest-layout>--}}
{{--    <x-auth-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <a href="/">--}}
{{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--            </a>--}}
{{--        </x-slot>--}}

{{--        <!-- Validation Errors -->--}}
{{--        <x-auth-validation-errors class="mb-4" :errors="$errors" />--}}

{{--        <form method="POST" action="{{ route('register') }}">--}}
{{--            @csrf--}}

{{--            <!-- Name -->--}}
{{--            <div>--}}
{{--                <x-label for="name" :value="__('Name')" />--}}

{{--                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />--}}
{{--            </div>--}}

{{--            <!-- Email Address -->--}}
{{--            <div class="mt-4">--}}
{{--                <x-label for="email" :value="__('Email')" />--}}

{{--                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />--}}
{{--            </div>--}}

{{--            <!-- Password -->--}}
{{--            <div class="mt-4">--}}
{{--                <x-label for="password" :value="__('Password')" />--}}

{{--                <x-input id="password" class="block mt-1 w-full"--}}
{{--                                type="password"--}}
{{--                                name="password"--}}
{{--                                required autocomplete="new-password" />--}}
{{--            </div>--}}

{{--            <!-- Confirm Password -->--}}
{{--            <div class="mt-4">--}}
{{--                <x-label for="password_confirmation" :value="__('Confirm Password')" />--}}

{{--                <x-input id="password_confirmation" class="block mt-1 w-full"--}}
{{--                                type="password"--}}
{{--                                name="password_confirmation" required />--}}
{{--            </div>--}}

{{--            <div class="flex items-center justify-end mt-4">--}}
{{--                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">--}}
{{--                    {{ __('Already registered?') }}--}}
{{--                </a>--}}

{{--                <x-button class="ml-4">--}}
{{--                    {{ __('Register') }}--}}
{{--                </x-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-auth-card>--}}
{{--</x-guest-layout>--}}
