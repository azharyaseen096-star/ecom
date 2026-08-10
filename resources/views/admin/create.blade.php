<x-app-layout>

<div class="max-w-3xl mx-auto p-8">

<h1 class="text-3xl mb-6 font-bold">
Add Product
</h1>

<form
action="{{ route('admin.products.store') }}"
method="POST"
enctype="multipart/form-data"
>

@csrf

<div class="mb-4">

<label>Name</label>

<input
type="text"
name="name"
class="w-full border rounded p-2"
>

</div>

<div class="mb-4">

<label>Price</label>

<input
type="number"
name="price"
class="w-full border rounded p-2"
>

</div>

<div class="mb-4">

<label>Description</label>

<textarea
name="description"
class="w-full border rounded p-2"
rows="5"
></textarea>

</div>

<div class="mb-4">

<label>Image</label>

<input
type="file"
name="image"
class="w-full border rounded p-2"
>

</div>

<button
class="bg-green-600 text-white px-6 py-2 rounded"
>

Save Product

</button>

</form>

</div>

</x-app-layout>