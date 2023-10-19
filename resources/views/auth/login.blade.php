<x-app-layout>
<section class="w-full sm:w-[400px] px-5 mx-auto mt-6 h-full flex flex-col justify-center items-center">
    <h2 class="text-2xl font-semibold mb-3">Login to your account</h2>
    <p class="mb-3">Or <a href="{{ route('register') }}" class="text-purple-700 hover:text-purple-500">create new account</a></p>
    <form action="{{ route('login') }}" method="post" class="w-full">
        @csrf

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="w-full mb-3">
            <x-input value="{{ old('email') }}" :errors="$errors" type="email"  id="email" name="email" placeholder="Your email ..." />
        </div>
        <div class="w-full mb-3">
            <x-input type="password" :errors="$errors"  name="password" placeholder="Your password ..." />
        </div>

        <div class="mb-3 flex justify-between w-full">
            <div>
                <input type="checkbox" id="rememberMe" name="remember" class="text-purple-700 focus:ring-purple-600">
                <label for="rememberMe" class="ml-3 text-gray-600">Remember Me</label>
            </div>
            <a href="{{ route('password.request') }}" class="text-purple-700 hover:text-purple-500">Reset your password</a>
        </div>

        <button class="text-white py-2 px-3 rounded-md shadow-md mt-3 flex items-center w-full justify-center transition-colors hover:bg-emerald-500 bg-emerald-700">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 h-6 mr-2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"
                />
            </svg>
            Login
        </button>
    </form>
</section>
</x-app-layout>

