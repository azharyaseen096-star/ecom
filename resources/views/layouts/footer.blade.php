<footer class="bg-black text-white mt-20">

    <div class="max-w-7xl mx-auto px-8 py-14">

        <div class="grid lg:grid-cols-5 md:grid-cols-3 gap-10">

            <!-- Logo -->

            <div>

                <h2 class="text-3xl font-extrabold text-blue-500">
                    ShopPress
                </h2>

                <p class="text-gray-400 mt-5 leading-8">

                    ShopPress is a modern e-commerce platform where you can
                    discover quality products, secure shopping,
                    AI-powered search and fast delivery.

                </p>

            </div>

            <!-- Quick Links -->

            <div>

                <h3 class="font-bold text-xl mb-5">
                    Quick Links
                </h3>

                <ul class="space-y-3 text-gray-400">

                    <li><a href="{{ route('shop') }}" class="hover:text-blue-500">Home</a></li>

                    <li><a href="{{ route('cart') }}" class="hover:text-blue-500">Cart</a></li>

                    <li><a href="{{ route('wiki.index') }}" class="hover:text-blue-500">Wikipedia Search</a></li>

                    @if(Route::has('ai.index'))
                        <li><a href="{{ route('ai.index') }}" class="hover:text-blue-500">AI Assistant</a></li>
                    @endif

                </ul>

            </div>

            <!-- Categories -->

            <div>

                <h3 class="font-bold text-xl mb-5">
                    Categories
                </h3>

                <ul class="space-y-3 text-gray-400">

                    <li>Electronics</li>
                    <li>Fashion</li>
                    <li>Mobiles</li>
                    <li>Computers</li>
                    <li>Accessories</li>

                </ul>

            </div>

            <!-- Contact -->

            <div>

                <h3 class="font-bold text-xl mb-5">
                    Contact
                </h3>

                <p class="text-gray-400">
                    📍 Lahore, Pakistan
                </p>

                <p class="text-gray-400 mt-3">
                    📞 +92 300 1234567
                </p>

                <p class="text-gray-400 mt-3">
                    📧 support@shoppress.com
                </p>

                <div class="flex gap-4 mt-6">

                    <a href="#" class="bg-gray-800 w-10 h-10 rounded-full flex items-center justify-center hover:bg-blue-600 transition">
                        F
                    </a>

                    <a href="#" class="bg-gray-800 w-10 h-10 rounded-full flex items-center justify-center hover:bg-pink-600 transition">
                        I
                    </a>

                    <a href="#" class="bg-gray-800 w-10 h-10 rounded-full flex items-center justify-center hover:bg-red-600 transition">
                        Y
                    </a>

                    <a href="#" class="bg-gray-800 w-10 h-10 rounded-full flex items-center justify-center hover:bg-sky-500 transition">
                        X
                    </a>

                </div>

            </div>

            <!-- Newsletter -->

            <div>

                <h3 class="font-bold text-xl mb-5">
                    Newsletter
                </h3>

                <p class="text-gray-400 mb-4">

                    Subscribe to receive latest offers and updates.

                </p>

                <input
                    type="email"
                    placeholder="Enter Email"
                    class="w-full rounded-lg bg-gray-900 border border-gray-700 px-4 py-3 text-white">

                <button
                    class="w-full mt-4 bg-blue-600 hover:bg-blue-700 py-3 rounded-lg font-semibold">

                    Subscribe

                </button>

                <div class="mt-6">

                    <p class="text-gray-400 mb-2">

                        Secure Payments

                    </p>

                    <div class="flex gap-2">

                        <div class="bg-white text-black px-3 py-2 rounded font-bold">
                            VISA
                        </div>

                        <div class="bg-white text-black px-3 py-2 rounded font-bold">
                            MC
                        </div>

                        <div class="bg-white text-black px-3 py-2 rounded font-bold">
                            PAYPAL
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <hr class="border-gray-800 my-10">

        <div class="flex flex-col md:flex-row justify-between items-center text-gray-500">

            <div>

                © {{ date('Y') }} ShopPress. All Rights Reserved.

            </div>

            <div class="flex gap-6 mt-4 md:mt-0">

                <a href="#" class="hover:text-white">Privacy Policy</a>

                <a href="#" class="hover:text-white">Terms & Conditions</a>

                <a href="#" class="hover:text-white">Support</a>

            </div>

        </div>

    </div>

    <!-- Back To Top -->

    <button
        onclick="window.scrollTo({top:0,behavior:'smooth'})"
        class="fixed bottom-6 right-6 bg-blue-600 hover:bg-blue-700 w-14 h-14 rounded-full text-white text-xl shadow-lg">

        ↑

    </button>

</footer>