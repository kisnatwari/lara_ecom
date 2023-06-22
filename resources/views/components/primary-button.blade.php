<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 bg-indigo-600 border border-transparent rounded-md font-bold text-xs text-white text-slate-100 uppercase tracking-widest hover:bg-indigo-600/90 dark:focus:bg-indigo-600/80 active:bg-indigo-600/80 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
