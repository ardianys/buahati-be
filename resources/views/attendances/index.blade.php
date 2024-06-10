<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="w-full">
          <section>
            <header class="flex justify-between items-center">
              <h2 class="text-lg font-medium text-gray-900">
                Attendances
              </h2>
              <a href="{{ route('attendances.create') }}" class="px-4 py-2 rounded-md bg-sky-500 text-white hover:bg-sky-600" title="Add New Attendance">Add New</a>
            </header>
            </br>

            @if (session()->has('flash_message'))
            <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-emerald-500">
              <span class="inline-block align-middle mr-8">
                {{ session('flash_message') }}
              </span>
              <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="this.parentNode.parentNode.removeChild(this.parentNode);">
                <span>×</span>
              </button>
            </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
              @foreach($attendances as $item)
                <div class="bg-white border dark:bg-gray-800 dark:border-gray-700 p-4 rounded-lg">
                  <img src="{{ asset('storage/' . $item->photo) }}" alt="Attendance Photo" class="w-full h-64 object-cover rounded-t-lg">
                  <div class="mt-4">
                    <h3 class="text-lg font-semibold">{{ $item->id }}</h3>
                    <div class="mt-4 space-x-2">
                      <a href="{{ route('attendances.show', $item->id) }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-800 text-white font-bold rounded" title="View Attendance">View</a>
                      <a href="{{ route('attendances.edit', $item->id) }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded" title="Edit Attendance">Edit</a>
                      <form method="POST" action="{{ route('attendances.destroy', $item->id) }}" accept-charset="UTF-8" class="inline">
                        {{ method_field('DELETE') }}
                        @csrf()
                        <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white font-bold rounded" title="Delete Attendance" onclick="return confirm(&quot;Confirm delete?&quot;)">Delete</button>
                      </form>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>

            <div class="mt-6">
              {!! $attendances->appends(['search' => Request::get('search')])->render() !!}
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>