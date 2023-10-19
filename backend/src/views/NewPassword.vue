<template>
            <GuestLayout title="Enter your new password">
            <form action="#" class="space-y-6" method="POST">
                <div>
                    <label class="block text-sm font-medium leading-6 text-gray-900" for="password">New password</label>
                    <div class="mt-2">
                        <input id="password"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" name="email" required=""
                               type="password"/>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium leading-6 text-gray-900" for="confirm_password">Confirm the password</label>
                    <div class="mt-2">
                        <input id="confirm_password"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" name="email" required=""
                               type="password"/>
                    </div>
                </div>

                <div>
                    <button class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                            type="submit">
                        submit
                    </button>
                </div>
            </form>
            </GuestLayout>
</template>

<script setup>
import GuestLayout from "../components/GuestLayout.vue";
</script>
