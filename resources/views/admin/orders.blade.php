<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Orders
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-8">

        <a href="{{ route('admin.dashboard') }}"
           class="bg-gray-700 text-white px-4 py-2 rounded">
            ← Back
        </a>

        <h1 class="text-3xl font-bold my-6">
            All Orders
        </h1>

        <table class="w-full border">

            <tr class="bg-gray-100">
                <th class="p-3">Order ID</th>
                <th>User</th>
                <th>Total</th>
                <th>Status</th>
                <th>Date</th>
            </tr>

            @forelse($orders as $order)

            <tr class="border-t">

                <td class="p-3">
                    #{{ $order->id }}
                </td>

                <td>
                    {{ $order->user->name ?? 'User Deleted' }}
                    <br>
                    <small>{{ $order->user->email ?? '' }}</small>
                </td>

                <td>
                    Rs {{ $order->total }}
                </td>

                <td>
                    {{ $order->status }}
                </td>

                <td>
                    {{ $order->created_at->format('d-m-Y h:i A') }}
                </td>

            </tr>

            @empty

            <tr>
                <td colspan="5" class="text-center p-5">
                    No Orders Found
                </td>
            </tr>

            @endforelse

        </table>

    </div>

</x-app-layout>