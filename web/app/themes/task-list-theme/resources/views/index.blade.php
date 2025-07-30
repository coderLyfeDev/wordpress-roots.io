@extends('layouts.app')

@section('title', 'Blog')

@section('content')
  <div class="space-y-6">
    <h2 class="text-3xl font-bold">Welcome to Task List!</h2>
    <p class="text-gray-600">This is your custom Blade-powered homepage using Tailwind and AlpineJS.</p>

    {{-- Flash messages --}}
    @if (session()->has('success'))
      <div x-show="flash" class="relative mb-10 rounded border border-green-400 bg-green-100 px-4 py-3 text-lg text-green-700" role="alert" x-data="{ flash: true }">
        <strong class="font-bold">Success!</strong>
        <div>{{ session('success') }}</div>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke-width="1.5" @click="flash = false"
              stroke="currentColor" class="h-6 w-6 cursor-pointer">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </span>
      </div>
    @endif

    {{-- WordPress loop --}}
    @if (have_posts())
      <ul class="space-y-4">
        @while (have_posts()) @php(the_post())
          <li>
            <a href="{{ get_permalink() }}" class="text-xl font-semibold text-blue-600 hover:underline">
              {{ get_the_title() }}
            </a>
            <p class="text-gray-500">{{ get_the_excerpt() }}</p>
          </li>
        @endwhile
      </ul>
    @else
      <p class="text-gray-500">No posts found.</p>
    @endif
  </div>
@endsection
