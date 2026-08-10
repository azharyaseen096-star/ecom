<x-app-layout>

    @php
        $data = session('result', []);
    @endphp

    <div class="max-w-7xl mx-auto py-8 px-4">

        {{-- ============================= --}}
        {{-- Header --}}
        {{-- ============================= --}}

        <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-700 rounded-2xl shadow-xl text-white p-8">

            <h1 class="text-4xl font-bold">
                🌍 Universal Smart Search
            </h1>

            <p class="mt-3 text-blue-100 text-lg">
                Search Wikipedia, LinkedIn, GitHub and any public website from one place.
            </p>

        </div>

        {{-- ============================= --}}
        {{-- Search Box --}}
        {{-- ============================= --}}

        <div class="bg-white rounded-2xl shadow-lg mt-8 p-6">

            <form action="{{ route('search.search') }}" method="POST">

                @csrf

                <div class="flex flex-col lg:flex-row gap-4">

                    <input
                        type="text"
                        name="search"
                        value="{{ old('search') }}"
                        placeholder="Search anything or paste a URL..."
                        class="flex-1 border rounded-xl px-5 py-4 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required>

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 rounded-xl">

                        🔍 Search

                    </button>

                </div>

            </form>

        </div>

        {{-- ============================= --}}
        {{-- Error --}}
        {{-- ============================= --}}

        @if(session('error'))

            <div class="mt-6 bg-red-100 border border-red-300 rounded-xl p-5 text-red-700">

                {!! session('error') !!}

            </div>

        @endif

        {{-- ============================= --}}
        {{-- Result --}}
        {{-- ============================= --}}

        @if(!empty($data))

        <div class="bg-white rounded-2xl shadow-xl mt-8 p-8">

            <div class="flex flex-col lg:flex-row gap-8">

                <div class="lg:w-1/4">

                    @if(!empty($data['image']))

                        <img
                            src="{{ $data['image'] }}"
                            alt="{{ $data['title'] ?? '' }}"
                            loading="lazy"
                            class="rounded-xl shadow w-full">

                    @else

                        <div class="h-72 rounded-xl bg-gray-200 flex items-center justify-center">

                            No Image

                        </div>

                    @endif

                </div>

                <div class="flex-1">

                    <h2 class="text-3xl font-bold">

                        {{ $data['title'] ?? 'Unknown' }}

                    </h2>

                    @if(!empty($data['description']))

                        <p class="mt-4 text-gray-600 leading-7">

                            {{ $data['description'] }}

                        </p>

                    @endif

                    @if(!empty($data['url']))

                        <div class="mt-6">

                            <a
                                href="{{ $data['url'] }}"
                                target="_blank"
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl">

                                🌐 Visit Website

                            </a>

                        </div>

                    @endif

                </div>

            </div>

        </div>

        {{-- ============================= --}}
        {{-- Basic Information --}}
        {{-- ============================= --}}

        <div class="bg-white rounded-2xl shadow-xl mt-8 overflow-x-auto">

            <div class="bg-blue-600 text-white px-6 py-4 text-xl font-bold">

                📋 Basic Information

            </div>

            <table class="min-w-full table-auto">

                <tbody>

                    <tr class="border-b">

                        <td class="font-bold p-4 w-60">

                            Title

                        </td>

                        <td class="p-4">

                            {{ $data['title'] ?? '' }}

                        </td>

                    </tr>

                    <tr class="border-b">

                        <td class="font-bold p-4">

                            URL

                        </td>

                        <td class="p-4 break-all">

                            {{ $data['url'] ?? '' }}

                        </td>

                    </tr>

                    <tr>

                        <td class="font-bold p-4">

                            Description

                        </td>

                        <td class="p-4">

                            {{ $data['description'] ?? '' }}

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

        @endif
                {{-- ============================= --}}
        {{-- Emails --}}
        {{-- ============================= --}}

        @if(!empty($data['emails'] ?? []))

        <div class="bg-white rounded-2xl shadow-xl mt-8 overflow-x-auto">

            <div class="bg-green-600 text-white px-6 py-4 text-xl font-bold">

                📧 Email Addresses

            </div>

            <table class="min-w-full table-auto">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-left p-4">#</th>

                        <th class="text-left p-4">

                            Email Address

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($data['emails'] as $index => $email)

                        <tr class="border-b">

                            <td class="p-4">

                                {{ $index + 1 }}

                            </td>

                            <td class="p-4 break-all">

                                <a
                                    href="mailto:{{ $email }}"
                                    class="text-blue-600 hover:underline">

                                    {{ $email }}

                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        @endif


        {{-- ============================= --}}
        {{-- Phone Numbers --}}
        {{-- ============================= --}}

        @if(!empty($data['phones'] ?? []))

        <div class="bg-white rounded-2xl shadow-xl mt-8 overflow-x-auto">

            <div class="bg-purple-600 text-white px-6 py-4 text-xl font-bold">

                ☎ Phone Numbers

            </div>

            <table class="min-w-full table-auto">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-left p-4">#</th>

                        <th class="text-left p-4">

                            Phone Number

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($data['phones'] as $index => $phone)

                        <tr class="border-b">

                            <td class="p-4">

                                {{ $index + 1 }}

                            </td>

                            <td class="p-4">

                                {{ $phone }}

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        @endif


        {{-- ============================= --}}
        {{-- Social Links --}}
        {{-- ============================= --}}

        @if(!empty($data['social_links'] ?? []))

        <div class="bg-white rounded-2xl shadow-xl mt-8 overflow-x-auto">

            <div class="bg-indigo-600 text-white px-6 py-4 text-xl font-bold">

                🌐 Social Links

            </div>

            <table class="min-w-full table-auto">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-left p-4">

                            #

                        </th>

                        <th class="text-left p-4">

                            URL

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($data['social_links'] as $index => $link)

                        <tr class="border-b">

                            <td class="p-4">

                                {{ $index + 1 }}

                            </td>

                            <td class="p-4 break-all">

                                <a
                                    href="{{ $link }}"
                                    target="_blank"
                                    class="text-blue-600 hover:underline">

                                    {{ $link }}

                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        @endif


        {{-- ============================= --}}
        {{-- Images Gallery --}}
        {{-- ============================= --}}

        @if(!empty($data['images'] ?? []))

        <div class="bg-white rounded-2xl shadow-xl mt-8 p-6">

            <h2 class="text-2xl font-bold mb-6">

                🖼 Images Gallery

            </h2>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-5">

                @foreach(array_slice($data['images'],0,20) as $image)

                    <a
                        href="{{ $image }}"
                        target="_blank">

                        <img
                            src="{{ $image }}"
                            loading="lazy"
                            class="rounded-xl shadow hover:scale-105 transition duration-300">

                    </a>

                @endforeach

            </div>

        </div>

        @endif


        {{-- ============================= --}}
        {{-- Website Links --}}
        {{-- ============================= --}}

        @if(!empty($data['links'] ?? []))

        <div class="bg-white rounded-2xl shadow-xl mt-8 p-6">

            <h2 class="text-2xl font-bold mb-6">

                🔗 Website Links

            </h2>

            <div class="space-y-3">

                @foreach(array_slice($data['links'],0,25) as $link)

                    <div class="border rounded-xl p-4">

                        <div class="font-semibold">

                            {{ $link['text'] ?? 'No Text Available' }}

                        </div>

                        <div class="text-blue-600 break-all mt-2">

                            <a
                                href="{{ $link['href'] ?? '#' }}"
                                target="_blank">

                                {{ $link['href'] ?? '' }}

                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

        @endif
                {{-- ============================= --}}
        {{-- Page Headings --}}
        {{-- ============================= --}}

        @if(!empty($data['headings'] ?? []))

        <div class="bg-white rounded-2xl shadow-xl mt-8 p-6">

            <h2 class="text-2xl font-bold mb-6">
                📰 Page Headings
            </h2>

            @foreach($data['headings'] as $tag => $items)

                @if(!empty($items))

                    <div class="mb-8">

                        <h3 class="text-lg font-bold text-blue-700 uppercase mb-3">

                            {{ strtoupper($tag) }}

                        </h3>

                        <ul class="list-disc ml-6 space-y-2">

                            @foreach($items as $heading)

                                <li>

                                    {{ $heading }}

                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif

            @endforeach

        </div>

        @endif


        {{-- ============================= --}}
        {{-- Paragraphs --}}
        {{-- ============================= --}}

        @if(!empty($data['paragraphs'] ?? []))

        <div class="bg-white rounded-2xl shadow-xl mt-8 p-6">

            <h2 class="text-2xl font-bold mb-6">

                📄 Paragraphs

            </h2>

            @foreach(array_slice($data['paragraphs'],0,10) as $paragraph)

                <div class="bg-gray-50 rounded-xl p-5 mb-4 border">

                    {{ $paragraph }}

                </div>

            @endforeach

        </div>

        @endif


        {{-- ============================= --}}
        {{-- Buttons --}}
        {{-- ============================= --}}

        @if(!empty($data['buttons'] ?? []))

        <div class="bg-white rounded-2xl shadow-xl mt-8 p-6">

            <h2 class="text-2xl font-bold mb-6">

                🔘 Buttons

            </h2>

            <div class="flex flex-wrap gap-3">

                @foreach($data['buttons'] as $button)

                    <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full">

                        {{ $button }}

                    </span>

                @endforeach

            </div>

        </div>

        @endif


        {{-- ============================= --}}
        {{-- Forms --}}
        {{-- ============================= --}}

        @if(!empty($data['forms'] ?? []))

        <div class="bg-white rounded-2xl shadow-xl mt-8 overflow-x-auto">

            <div class="bg-blue-700 text-white px-6 py-4 text-xl font-bold">

                📝 Forms

            </div>

            <table class="min-w-full table-auto">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-4 text-left">

                            Action

                        </th>

                        <th class="p-4 text-left">

                            Method

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($data['forms'] as $form)

                        <tr class="border-b">

                            <td class="p-4 break-all">

                                {{ $form['action'] ?? '' }}

                            </td>

                            <td class="p-4">

                                {{ strtoupper($form['method'] ?? '') }}

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        @endif


        {{-- ============================= --}}
        {{-- Meta Tags --}}
        {{-- ============================= --}}

        @if(!empty($data['metaTags'] ?? []))

        <div class="bg-white rounded-2xl shadow-xl mt-8 overflow-x-auto">

            <div class="bg-gray-800 text-white px-6 py-4 text-xl font-bold">

                🏷 Meta Tags

            </div>

            <table class="min-w-full table-auto">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-4 text-left">

                            Name

                        </th>

                        <th class="p-4 text-left">

                            Property

                        </th>

                        <th class="p-4 text-left">

                            Content

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach(array_slice($data['metaTags'],0,40) as $meta)

                        <tr class="border-b">

                            <td class="p-4">

                                {{ $meta['name'] ?? '' }}

                            </td>

                            <td class="p-4">

                                {{ $meta['property'] ?? '' }}

                            </td>

                            <td class="p-4 break-all">

                                {{ \Illuminate\Support\Str::limit($meta['content'] ?? '',150) }}

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        @endif


        {{-- ============================= --}}
        {{-- Summary Cards --}}
        {{-- ============================= --}}

        @if(!empty($data))

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-8">

            <div class="bg-blue-600 text-white rounded-2xl p-6 text-center">

                <div class="text-3xl font-bold">

                    {{ count($data['images'] ?? []) }}

                </div>

                <div>

                    Images

                </div>

            </div>

            <div class="bg-green-600 text-white rounded-2xl p-6 text-center">

                <div class="text-3xl font-bold">

                    {{ count($data['links'] ?? []) }}

                </div>

                <div>

                    Links

                </div>

            </div>

            <div class="bg-purple-600 text-white rounded-2xl p-6 text-center">

                <div class="text-3xl font-bold">

                    {{ count($data['emails'] ?? []) }}

                </div>

                <div>

                    Emails

                </div>

            </div>

            <div class="bg-orange-600 text-white rounded-2xl p-6 text-center">

                <div class="text-3xl font-bold">

                    {{ count($data['phones'] ?? []) }}

                </div>

                <div>

                    Phones

                </div>

            </div>

        </div>

        @endif


        {{-- ============================= --}}
        {{-- Footer --}}
        {{-- ============================= --}}

        <div class="mt-12 text-center text-gray-500">

            <hr class="mb-6">

            <p class="font-semibold">

                🚀 Universal Search Dashboard

            </p>

            <p class="text-sm mt-2">

                Laravel 10 • Puppeteer • Node.js • AI Ready

            </p>

        </div>

    </div>

</x-app-layout>