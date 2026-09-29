<x-app-layout>

    <div class="bg-slate-900 text-white py-6 border-b border-slate-800">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap items-center justify-between gap-4">
            <div>
                <span class="text-xs font-black uppercase tracking-widest text-amber-400">TinyChamps Admin Control</span>
                <h1 class="text-2xl sm:text-3xl font-black text-white mt-1">Store, Western Union &amp; Worldwide Settings</h1>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="bg-slate-800 hover:bg-slate-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl border border-slate-700 transition">
                <i class="fa-solid fa-arrow-left mr-1"></i> Admin Dashboard
            </a>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10" x-data="{ testAmount: 45 }">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
            @csrf

            <!-- Live QR Code Tester / Preview Box -->
            <div class="bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 text-white rounded-3xl p-6 sm:p-8 border border-slate-800 shadow-2xl space-y-6">
                <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-800 pb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-xl">
                            <i class="fa-solid fa-qrcode"></i>
                        </div>
                        <div>
                            <h2 class="font-black text-white text-lg">Western Union &amp; Bank QR Live Preview</h2>
                            <p class="text-xs text-slate-400">Scan these QR codes to verify with international payment scanners</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <label class="text-xs text-slate-400 font-bold">Test Amount ($ USD):</label>
                        <input type="number" x-model="testAmount" min="5" step="5" class="w-28 text-xs p-2 bg-slate-800 border border-slate-700 text-white font-black rounded-xl text-center focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Western Union Live Preview -->
                    <div class="p-5 rounded-2xl bg-amber-950/40 border border-amber-800/60 flex items-center gap-5">
                        <div class="bg-white p-2.5 rounded-2xl shrink-0 shadow-lg">
                            <img :src="'https://api.qrserver.com/v1/create-qr-code/?size=140x140&margin=2&data=' + encodeURIComponent('PAY TO WESTERN UNION GLOBAL\nReceiver: {{ $settings['wu_receiver_name'] ?? 'TINYCHAMPS KIDSWEAR LLC' }}\nCountry: {{ $settings['wu_country'] ?? 'United States' }}\nCity: {{ $settings['wu_city'] ?? 'New York' }}\nPhone: {{ $settings['wu_phone'] ?? '+1 800 325 6000' }}\nAmount: USD $' + testAmount + ' (LOCKED)')" alt="Western Union Preview" class="w-28 h-28 object-contain">
                        </div>
                        <div class="space-y-1">
                            <span class="bg-amber-500 text-slate-950 text-[10px] font-black px-2 py-0.5 rounded uppercase">Western Union QR</span>
                            <div class="text-sm font-black text-white mt-1">{{ $settings['wu_receiver_name'] ?? 'TINYCHAMPS KIDSWEAR LLC' }}</div>
                            <div class="text-xs text-slate-300">{{ $settings['wu_city'] ?? 'New York' }}, {{ $settings['wu_country'] ?? 'United States' }}</div>
                            <div class="text-xs font-black text-amber-400 mt-1">Locked: $<span x-text="Number(testAmount).toFixed(2)"></span> USD</div>
                        </div>
                    </div>

                    <!-- Bank Wire Live Preview -->
                    <div class="p-5 rounded-2xl bg-blue-950/40 border border-blue-800/60 flex items-center gap-5">
                        <div class="bg-white p-2.5 rounded-2xl shrink-0 shadow-lg">
                            <img :src="'https://api.qrserver.com/v1/create-qr-code/?size=140x140&margin=2&data=' + encodeURIComponent('WIRE TRANSFER\nBank: {{ $settings['bank_name'] ?? 'JP Morgan Chase Bank' }}\nTitle: {{ $settings['bank_account_title'] ?? 'TinyChamps KidsWear LLC' }}\nIBAN/Account: {{ $settings['bank_account_number'] ?? 'CHASEUS33XXX' }}\nSWIFT: {{ $settings['bank_iban'] ?? 'CHASUS33' }}\nAmount: USD $' + testAmount)" alt="Bank Wire Preview" class="w-28 h-28 object-contain">
                        </div>
                        <div class="space-y-1">
                            <span class="bg-blue-600 text-white text-[10px] font-black px-2 py-0.5 rounded uppercase">Bank Wire QR</span>
                            <div class="text-sm font-black text-white mt-1">{{ $settings['bank_name'] ?? 'JP Morgan Chase Bank' }}</div>
                            <div class="text-xs text-slate-300">{{ $settings['bank_account_title'] ?? 'TinyChamps KidsWear LLC' }}</div>
                            <div class="text-xs font-black text-blue-400 mt-1">Amount: $<span x-text="Number(testAmount).toFixed(2)"></span> USD</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 1. Western Union Configuration -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-5">
                <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                    <div class="w-10 h-10 rounded-2xl bg-amber-500 text-slate-950 flex items-center justify-center font-black text-lg shadow-md shadow-amber-500/30">
                        <i class="fa-solid fa-money-bill-transfer"></i>
                    </div>
                    <div>
                        <h2 class="font-black text-slate-900 text-lg">Western Union Global Receiver Details</h2>
                        <p class="text-xs text-slate-500">Receiver name, country, city and MTCN instructions for global customer payments</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Official Receiver Full Name <span class="text-rose-500">*</span></label>
                        <input type="text" name="wu_receiver_name" value="{{ $settings['wu_receiver_name'] ?? 'TINYCHAMPS KIDSWEAR LLC' }}" required placeholder="e.g. TINYCHAMPS KIDSWEAR LLC" class="w-full text-xs p-3.5 bg-slate-50 border border-slate-200 rounded-xl font-bold uppercase focus:ring-2 focus:ring-amber-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Receiver Country <span class="text-rose-500">*</span></label>
                        <input type="text" name="wu_country" value="{{ $settings['wu_country'] ?? 'United States' }}" required placeholder="e.g. United States" class="w-full text-xs p-3.5 bg-slate-50 border border-slate-200 rounded-xl font-bold focus:ring-2 focus:ring-amber-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Receiver City / State <span class="text-rose-500">*</span></label>
                        <input type="text" name="wu_city" value="{{ $settings['wu_city'] ?? 'New York, NY' }}" required placeholder="e.g. New York, NY" class="w-full text-xs p-3.5 bg-slate-50 border border-slate-200 rounded-xl font-bold focus:ring-2 focus:ring-amber-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Official Contact / Support Phone</label>
                        <input type="text" name="wu_phone" value="{{ $settings['wu_phone'] ?? '+1 (800) 325-6000' }}" placeholder="+1 800 325 6000" class="w-full text-xs p-3.5 bg-slate-50 border border-slate-200 rounded-xl font-mono focus:ring-2 focus:ring-amber-500">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Agent / Location Code (Optional)</label>
                        <input type="text" name="wu_agent_code" value="{{ $settings['wu_agent_code'] ?? 'WU-GLOBAL-TINY99' }}" placeholder="e.g. WU-GLOBAL-TINY99" class="w-full text-xs p-3 bg-slate-50 border border-slate-200 rounded-xl font-mono">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Western Union Payment Instructions for Customers</label>
                        <textarea name="wu_instructions" rows="2" placeholder="Instructions shown during checkout..." class="w-full text-xs p-3 bg-slate-50 border border-slate-200 rounded-xl">{{ $settings['wu_instructions'] ?? 'Send funds via any Western Union Agent or Western Union App to the above receiver name. Enter your 10-digit Money Transfer Control Number (MTCN) in checkout.' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- 2. Bank Account Configuration -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-5">
                <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                    <div class="w-10 h-10 rounded-2xl bg-blue-600 text-white flex items-center justify-center font-bold text-lg shadow-md shadow-blue-600/30">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                    <div>
                        <h2 class="font-black text-slate-900 text-lg">International Bank Wire / SWIFT Details</h2>
                        <p class="text-xs text-slate-500">Bank deposit info shown to customers choosing international wire transfer</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Bank Name</label>
                        <input type="text" name="bank_name" value="{{ $settings['bank_name'] ?? 'JP Morgan Chase Bank N.A.' }}" placeholder="e.g. JP Morgan Chase Bank" class="w-full text-xs p-3.5 bg-slate-50 border border-slate-200 rounded-xl font-bold">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Account Beneficiary Title</label>
                        <input type="text" name="bank_account_title" value="{{ $settings['bank_account_title'] ?? 'TinyChamps KidsWear LLC' }}" class="w-full text-xs p-3.5 bg-slate-50 border border-slate-200 rounded-xl font-bold uppercase">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Account / Routing Number</label>
                        <input type="text" name="bank_account_number" value="{{ $settings['bank_account_number'] ?? '894029103948572' }}" class="w-full text-xs p-3.5 bg-slate-50 border border-slate-200 rounded-xl font-mono font-bold">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">SWIFT / BIC / IBAN Code</label>
                        <input type="text" name="bank_iban" value="{{ $settings['bank_iban'] ?? 'CHASUS33XXX' }}" class="w-full text-xs p-3.5 bg-slate-50 border border-slate-200 rounded-xl font-mono font-bold">
                    </div>
                </div>
            </div>

            <!-- 3. Worldwide Shipping & Free Delivery -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-5">
                <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                    <div class="w-10 h-10 rounded-2xl bg-emerald-500 text-white flex items-center justify-center font-bold text-lg shadow-md shadow-emerald-500/30">
                        <i class="fa-solid fa-plane-departure"></i>
                    </div>
                    <div>
                        <h2 class="font-black text-slate-900 text-lg">Worldwide Shipping &amp; Rates ($ USD)</h2>
                        <p class="text-xs text-slate-500">Standard international express courier fee and free delivery threshold</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Flat Global Delivery Fee ($ USD)</label>
                        <input type="number" name="shipping_fee" value="{{ $settings['shipping_fee'] ?? '9.99' }}" step="0.01" min="0" class="w-full text-xs p-3.5 bg-slate-50 border border-slate-200 rounded-xl font-bold">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Free Worldwide Delivery on Orders Above ($ USD)</label>
                        <input type="number" name="free_shipping_threshold" value="{{ $settings['free_shipping_threshold'] ?? '75.00' }}" step="0.01" min="0" class="w-full text-xs p-3.5 bg-slate-50 border border-slate-200 rounded-xl font-bold">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 flex justify-end">
                <button type="submit" class="px-8 py-4 bg-gradient-to-r from-amber-500 via-orange-500 to-rose-500 hover:from-amber-600 hover:to-rose-600 text-white font-black text-sm rounded-2xl shadow-xl shadow-amber-500/30 transition transform active:scale-95">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Save TinyChamps Worldwide Settings
                </button>
            </div>
        </form>
    </div>

</x-app-layout>
