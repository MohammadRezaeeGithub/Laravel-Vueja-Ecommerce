<x-app-layout>
    <!--The login section-->
    <section class="w-full sm:w-[400px] px-5 mx-auto mt-6 h-full flex flex-col justify-center items-center">
        <h2 class="text-2xl font-semibold mb-3">Enter your email to reset your password</h2>
        <p class="mb-3">Or <a href="{{ route('login') }}" class="text-purple-700 hover:text-purple-500">Login with existing account</a></p>
        <form action="{{ route('password.email') }}" method="post" class="w-full">
            @csrf

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <div class="w-full mb-3">
                <x-input name="email" value="{{ old('email') }}"  type="email" placeholder="Your email ..." />
            </div>

            <button class="text-white py-2 px-3 rounded-md shadow-md mt-3 flex items-center w-full justify-center transition-colors hover:bg-emerald-500 bg-emerald-700">
                Submit
            </button>
        </form>
    </section>

    <!--The end of the  login section-->
</x-app-layout>


