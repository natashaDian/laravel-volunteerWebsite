<footer class="bg-white dark:bg-gray-800 border-t mt-12">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">

        {{-- Logo + Description --}}
        <div>
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-3">
                Give2Grow
            </h3>
            <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed max-w-sm mx-auto">
                Empowering communities through volunteering.  
                Join Give2Grow and help create meaningful change.
            </p>
        </div>

        {{-- Quick Links --}}
        <div>
            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">Quick Links</h4>
            <ul class="space-y-2 text-gray-600 dark:text-gray-400 text-sm">
                <li><a href="/activities" class="hover:text-indigo-600">Find Activities</a></li>
                <li><a href="/organizations" class="hover:text-indigo-600">Organizations</a></li>
                <li><a href="#" class="hover:text-indigo-600">Donation</a></li>
                <li><a href="#" class="hover:text-indigo-600">About Us</a></li>
            </ul>
        </div>

        {{-- Social Media --}}
        <div>
            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">Follow Us</h4>

            <div class="flex justify-center space-x-6 text-gray-600 dark:text-gray-400">

                <a href="#" class="hover:text-indigo-600 transition">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22 5.75a8.62 8.62 0 01-2.36.65A4.15 4.15 0 0021.4 4a8.34 8.34 0 01-2.64 1A4.18 4.18 0 0015.5 4a4.21 4.21 0 00-4.2 4.23c0 .33.03.65.1.95A11.93 11.93 0 013 4.9a4.27 4.27 0 00-.57 2.1 4.22 4.22 0 001.86 3.52 4.12 4.12 0 01-1.9-.53v.05A4.23 4.23 0 004.2 14a4.22 4.22 0 01-1.89.07 4.24 4.24 0 003.93 2.94A8.42 8.42 0 012 18.39 11.88 11.88 0 008.29 20c7.55 0 11.68-6.38 11.68-11.92 0-.18 0-.36-.01-.54A8.56 8.56 0 0022 5.75z"/>
                    </svg>
                </a>

                <a href="#" class="hover:text-indigo-600 transition">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.04c-5.5 0-10 4.48-10 10.02a10 10 0 008.25 9.87v-6.99h-2.5V12h2.5V9.8c0-2.48 1.48-3.85 3.75-3.85 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.78-1.63 1.57V12h2.78l-.44 2.94h-2.34v6.99A10 10 0 0022 12.06c0-5.54-4.5-10.02-10-10.02z"/>
                    </svg>
                </a>

                <a href="#" class="hover:text-indigo-600 transition">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2a10 10 0 100 20 10 10 0 000-20zM9.5 7.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm5 0a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm.48 8.87a4.85 4.85 0 01-2.36.63 4.85 4.85 0 01-2.36-.63.75.75 0 01.76-1.29 3.39 3.39 0 003.2 0 .75.75 0 01.76 1.29z"/>
                </svg>
                </a>

            </div>
        </div>
    </div>

    <div class="border-t py-4 text-center text-sm text-gray-600 dark:text-gray-400">
        © {{ date('Y') }} Give2Grow. All rights reserved.
    </div>
</footer>
