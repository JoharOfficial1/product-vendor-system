<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Edit Product') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
              <!-- Name -->
              <div class="mb-6 col-md-6">
                <div class="d-flex">
                  <x-input-label for="name" :value="__('Name')" />
                  <span class="text-danger">&nbsp;*</span>
                </div>

                <x-text-input id="name"
                  class="block mt-1 w-full"
                  type="text"
                  name="name"
                  :value="old('name', $product->name)"
                  required
                  autofocus
                  autocomplete="name" />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
              </div>

              <!-- Price -->
              <div class="mb-6 col-md-6">
                <div class="d-flex">
                  <x-input-label for="price" :value="__('Price')" />
                  <span class="text-danger">&nbsp;*</span>
                </div>

                <x-text-input id="price"
                  class="block mt-1 w-full"
                  type="number"
                  name="price"
                  step="0.01"
                  :value="old('price', $product->price)"
                  required
                  autofocus
                  autocomplete="price" />

                <x-input-error :messages="$errors->get('price')" class="mt-2" />
              </div>

              <!-- Cover Image -->
              <div class="mb-6 col-md-6">
                <x-input-label for="cover_image" :value="__('Cover Image')" />

                <input id="cover_image"
                  class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                  type="file"
                  name="cover_image"
                  accept="image/*">

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                  PNG, JPG, GIF up to 2MB. Leave empty to keep current image.
                </p>

                <x-input-error :messages="$errors->get('cover_image')" class="mt-2" />
              </div>

              <!-- Current Cover Image -->
              @if($product->cover_image)
                <div class="mb-4 col-12">
                  <x-input-label :value="__('Current Cover Image')" />

                  <div class="mt-2">
                    <img src="{{ asset('storage/' . $product->cover_image) }}"
                      alt="Current cover image"
                      class="w-32 h-32 object-cover rounded-lg border border-gray-300 dark:border-gray-600" width="150px">
                  </div>
                </div>
              @endif

              <!-- Description -->
              <div class="mb-6 col-12">
                <div class="d-flex">
                  <x-input-label for="description" :value="__('Description')" />
                  <span class="text-danger">&nbsp;*</span>
                </div>

                <div class="mt-1">
                  <textarea id="description"
                    name="description"
                    rows="15"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-indigo-400 dark:focus:ring-indigo-400">{{ old('description', $product->description) }}</textarea>
                </div>

                <x-input-error :messages="$errors->get('description')" class="mt-2" />
              </div>
            </div>

            <div class="col-12 form-group">
              <button class="btn btn-success">Update</button>
              <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>