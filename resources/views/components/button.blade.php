<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-white py-2 px-3 rounded-md shadow-md mt-3 flex items-center w-full justify-center transition-colors hover:bg-emerald-500 bg-emerald-700']) }}>
    {{ $slot }}
</button>
