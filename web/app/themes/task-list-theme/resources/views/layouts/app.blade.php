<!doctype html>
<html @php(language_attributes())>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php(do_action('get_header'))
    @php(wp_head())

    {{-- Load Tailwind and Alpine via CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>

    {{-- Custom Tailwind components --}}
    <style type="text/tailwindcss">
      .btn {
        @apply rounded-md px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-700/10 text-slate-700 hover:bg-slate-50;
      }
      .link {
        @apply font-medium text-gray-700 underline decoration-pink-500;
      }
      label {
        @apply block uppercase text-slate-700 mb-2;
      }
      input, textarea {
        @apply shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none;
      }
      .error {
        @apply text-red-500 text-sm;
      }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('styles')
  </head>

  <body @php(body_class()) class="container mx-auto mt-10 mb-10 max-w-lg">
    @php(wp_body_open())

    <div id="app" x-data="{ flash: true }">
      <a class="sr-only focus:not-sr-only" href="#main">
        {{ __('Skip to content', 'sage') }}
      </a>

      @include('sections.header')

      <main id="main" class="main">
        <h1 class="text-2xl mb-4">@yield('title')</h1>

        {{-- Flash messages --}}
        @if (session()->has('success'))
          <div x-show="flash" class="relative mb-10 rounded border border-green-400 bg-green-100 px-4 py-3 text-lg text-green-700" role="alert">
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

        @yield('content')
      </main>

      @hasSection('sidebar')
        <aside class="sidebar">
          @yield('sidebar')
        </aside>
      @endif

      @include('sections.footer')
    </div>

    @php(do_action('get_footer'))
    @php(wp_footer())
  </body>
</html>
