<x-app-layout>

    <div class="max-w-6xl mx-auto py-8">

        <div class="bg-white shadow-xl rounded-xl p-8">

            <h1 class="text-4xl font-bold text-center mb-2">
                📚 Wikipedia Smart Search
            </h1>

            <p class="text-center text-gray-500 mb-8">
                Search anything like Google and instantly get Wikipedia information.
            </p>

            <form action="{{ route('wiki.search') }}" method="POST">

                @csrf

                <div class="flex gap-3">

                    <input
                        type="text"
                        name="search"
                        class="w-full border rounded-lg px-5 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Ask Anything... e.g. Who is Elon Musk, Laravel, Pakistan History"
                        value="{{ old('search') }}"
                        required>

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 rounded-lg">

                        🔍 Search

                    </button>

                </div>

            </form>

            {{-- Matching Results --}}
            @if(session('results'))

                <div class="mt-8">

                    <h2 class="text-xl font-bold mb-4">
                        🔍 Related Results
                    </h2>

                    <div class="space-y-3">

                        @foreach(session('results') as $item)

                            <a href="{{ route('wiki.show', ['title' => urlencode($item)]) }}">

                                <div class="bg-blue-50 hover:bg-blue-100 border rounded-lg px-5 py-4 transition duration-200 cursor-pointer">

                                    📄 {{ $item }}

                                </div>

                            </a>

                        @endforeach

                    </div>

                </div>

            @endif

            {{-- Article --}}
            @if(session('result'))

                <div class="mt-10 bg-gray-50 border rounded-xl p-6">

                    <h2 class="text-3xl font-bold mb-5">

                        {{ session('result')['title'] }}

                    </h2>

                    @if(!empty(session('result')['image']))

                        <img
                            src="{{ session('result')['image'] }}"
                            class="w-72 rounded-lg shadow mb-6">

                    @endif

                    <p class="text-gray-700 leading-8 text-justify">

                        {{ session('result')['extract'] }}

                    </p>

                    @if(!empty(session('result')['url']))

                        <div class="mt-8">

                            <a
                                href="{{ session('result')['url'] }}"
                                target="_blank"
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg">

                                📖 Read Full Article

                            </a>

                        </div>

                    @endif

                </div>

            @endif

            {{-- Error --}}
            @if(session('error'))

                <div class="mt-8 bg-red-100 text-red-700 p-4 rounded-lg">

                    {{ session('error') }}

                </div>

            @endif

        </div>

    </div>

</x-app-layout>