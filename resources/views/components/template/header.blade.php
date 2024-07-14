
<div class="bg-gray-800 text-white p-6">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="font-bold text-xl">EazyBuy</a>

        <!-- Responsive Toggle Button -->
        <button id="menu-toggle" class="md:hidden focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="h-6 w-6 text-white">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>

        <!-- Navigation Links -->
        <nav id="navigation-menu" class="hidden md:flex space-x-4">
            <ul class="flex space-x-4">
                <li><a href="/shop" class="hover:text-gray-300">Shop</a></li>
                <li><a href="/about" class="hover:text-gray-300">About Us</a></li>
                <li><a href="/contact" class="hover:text-gray-300">Contact</a></li>
            </ul>
        </nav>

        <!-- Shopping Cart Icon -->
        <div class="relative group">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="h-6 w-6 cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l9 9H21v2H5v-2L3 15zm12 6l9-9-9-9v18h2v-2z" />
            </svg>
            <span class="absolute right-0 top-0 mt-2 mr-2 bg-red-500 rounded-full text-xs px-2 py-1 text-white">3</span>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('menu-toggle');
    const navigationMenu = document.getElementById('navigation-menu');

    toggleButton.addEventListener('click', function() {
        navigationMenu.classList.toggle('hidden');
    });
});
</script>