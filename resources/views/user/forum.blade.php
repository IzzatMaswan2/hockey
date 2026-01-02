<x-guest-layout>

    {{-- HERO --}}
    <section class="relative bg-purple-100">
        <div class="absolute flex inset-0 items-center justify-center">
            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                 class="w-50 h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gray-500/70"></div>
        </div>

        <div class="relative max-w-5xl mx-auto px-4 py-20 text-center">
            <p class="text-sm uppercase tracking-widest text-gray-100">
                Latest News
            </p>

            <h1 class="mt-4 text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight text-white">
                {{ $article->title }}
            </h1>

            <div class="mt-4 flex flex-wrap gap-3 justify-center text-sm text-gray-200">
                <span>{{ $article->created_at->format('F j, Y') }}</span>
                <span>•</span>
                <span>{{ $article->place }}</span>
                <span>•</span>
                <span>{{ $article->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </section>

    {{-- CONTENT --}}
    <main class="bg-purple-50">
        <div class="max-w-6xl mx-auto px-4 py-12 grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- ARTICLE BODY --}}
            <article class="lg:col-span-2 space-y-8">

                {{-- SUMMARY --}}
                <div class="bg-white border-l-4 border-purple-600 rounded-xl p-6 text-lg leading-relaxed text-gray-800 shadow">
                    {{ $article->summary }}
                </div>

                {{-- CONTENT --}}
                <div class="prose max-w-none
                            prose-headings:text-purple-700
                            prose-p:text-gray-800
                            prose-a:text-purple-600 hover:underline bg-white rounded-xl p-10">
                    {!! nl2br(e($article->content)) !!}
                </div>

                {{-- SHARE --}}
                <div class="pt-8 border-t border-purple-200">
                    <p class="text-sm uppercase tracking-widest text-purple-700 mb-4">
                        Follow / Share
                    </p>

                    <div class="flex gap-6 text-2xl text-purple-600">
                        <a href="#" class="hover:text-blue-500 transition">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="hover:text-sky-400 transition">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="#" class="hover:text-red-500 transition">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>

            </article>

            {{-- SIDEBAR --}}
            <aside class="space-y-6">

                <h2 class="text-lg font-bold uppercase tracking-wider text-purple-700">
                    Other Recent News
                </h2>

                <div class="space-y-4">
                    @forelse($recentArticles as $recent)
                        <a href="{{ route('article.show', $recent->id) }}"
                           class="block bg-white border-l-4 border-purple-600 rounded-lg p-4 hover:bg-purple-50 shadow transition">
                            <p class="text-xs text-gray-500 mb-1">
                                {{ $recent->created_at->format('M j, Y') }}
                            </p>
                            <h3 class="font-semibold text-gray-900">
                                {{ $recent->title }}
                            </h3>
                        </a>
                    @empty
                        <p class="text-gray-600 text-sm">
                            No recent articles available.
                        </p>
                    @endforelse
                </div>

            </aside>

        </div>
    </main>

</x-guest-layout>
