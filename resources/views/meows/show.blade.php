<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ !$meow->trashed() ? __('Shruti\'s meow: ' . $meow->title) : __('Trashed meow: ' . $meow->title) }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <x-alert-success>
            {{ session('success') }}
          </x-alert-success>
          <div class="flex">
            @if(!$meow->trashed())
              <p class="opacity-70">
                <strong>Created: </strong> {{ $meow->created_at->diffForHumans() }}
              </p>
              <p class="opacity-70 ml-8">
                <strong>Updated: </strong> {{ $meow->updated_at->diffForHumans() }}
              </p>
              <a href="{{ route('meows.edit', $meow) }}" class="btn-link ml-auto">Edit Meow</a>
              <form action="{{ route('meows.destroy', $meow) }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure you wish to delete this meow?')">Move to Trash</button>
              </form>
            @else
              <p class="opacity-70">
                <strong>Deleted: </strong> {{ $meow->created_at->diffForHumans() }}
              </p>
              <form action="{{ route('trashed.update', $meow) }}" method="post" class="ml-auto">
                @method('put')
                @csrf
                <button type="submit" class="btn-link">Restore Meow</a>
              </form>
              <form action="{{ route('trashed.destroy', $meow) }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure you wish to delete this meow forever? This action cannot be undone')">Delete Forever</button>
              </form>
            @endif
          </div>

          <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">

            <h2 class="font-bold text-4xl">
              {{ $meow->title }}
            </h2>

            <p class="mt-6 whitespace-pre-wrap">{{ $meow->text }}</p>
            
          </div>



      </div>
  </div>
</x-app-layout>


