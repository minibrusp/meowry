<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ request()->routeIs('meows.index') ? __(Auth::user()->name . '\'s' . ' Meows') : __(Auth::user()->name . '\'s' . ' Trash') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <x-alert-success>
          {{ session('success') }}
        </x-alert-success>

        @if(request()->routeIs('meows.index'))
          <a href="{{ route('meows.create') }}" class="btn-link btn-lg mb-2">+ Meow</a>
        @endif
        
        @forelse ($meows as $meow)
          <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
            <h2 class="font-bold text-2xl">
                
              <a
                @if(request()->routeIs('meows.index')) 
                  href="{{ route('meows.show', $meow) }}"
                @else 
                  href="{{ route('trashed.show', $meow) }}"
                @endif
              >{{ $meow->title }}</a>
            
            </h2>
            <p class="mt-2">
              {{ Str::limit($meow->text, 200) }}
            </p>
            <span class="block mt-4 text-sm opacity-70">{{ $meow->updated_at->diffForHumans() }}</span>
          </div>
        @empty
          @if(request()->routeIs('meows.index'))
            <p>You have no meows yet.</p>
          @else
            <p>No items in the Trash.</p>
          @endif
        @endforelse

        {{ $meows->links() }}


      </div>
  </div>
</x-app-layout>


