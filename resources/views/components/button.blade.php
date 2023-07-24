<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-2 py-2 w-12 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white bg-blue-600 uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
