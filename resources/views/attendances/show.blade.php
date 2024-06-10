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
                Show Attendance
              </h2>
              <div class="mt-5">
                <a class="px-4 py-2 rounded-md bg-sky-500 text-black hover:bg-sky-600" href="{{ route('attendances.index') }}" title="Back">Back</a>
              </div>
            </header>
            </br>

            <div class="bg-white border dark:bg-gray-800 dark:border-gray-700 p-4 rounded-lg">
              <img src="{{ asset('storage/' . $attendance->photo) }}" alt="Attendance Photo" class="w-full h-full object-cover rounded-t-lg">
              <div class="mt-4">
                <h3 class="text-lg font-semibold">ID: {{ $attendance->id }}</h3>
              </div>
            </div>

          </section>

        </div>
      </div>
    </div>
  </div>
</x-app-layout>