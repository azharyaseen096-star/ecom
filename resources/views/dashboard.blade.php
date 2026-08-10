<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl">
        Dashboard
    </h2>
</x-slot>

<div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white shadow rounded p-8 text-center">

            <h1 class="text-3xl font-bold mb-4">
                Welcome {{ Auth::user()->name }}
            </h1>

            @if(Auth::user()->is_admin)

                <p class="mb-6">
                    Manage your e-commerce website from the Admin Panel.
                </p>

                <a href="{{ route('admin.dashboard') }}"
                   class="bg-blue-600 text-white px-6 py-3 rounded">
                    Go To Admin Dashboard
                </a>

            @else

                <p class="mb-6">
                    Start shopping now
                </p>

                <a href="{{ route('shop') }}"
                   class="bg-black text-white px-6 py-3 rounded">
                    Go To Shop
                </a>

            @endif

        </div>

    </div>

</div>

</x-app-layout>