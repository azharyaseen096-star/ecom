<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Edit Product
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-8">

        <form
            action="{{ route('admin.products.update', $product->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Product Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ $product->name }}"
                    class="w-full border rounded p-3"
                >

            </div>

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Price
                </label>

                <input
                    type="number"
                    name="price"
                    value="{{ $product->price }}"
                    class="w-full border rounded p-3"
                >

            </div>

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="5"
                    class="w-full border rounded p-3"
                >{{ $product->description }}</textarea>

            </div>

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Current Image
                </label>

                @if($product->image)

                    <img
                        src="{{ asset('storage/'.$product->image) }}"
                        width="120"
                        class="mb-3 rounded border"
                    >

                @endif

                <input
                    type="file"
                    name="image"
                    class="w-full border rounded p-3"
                >

            </div>

            <button
                class="bg-blue-600 text-white px-6 py-3 rounded"
            >
                Update Product
            </button>

        </form>

    </div>

</x-app-layout>