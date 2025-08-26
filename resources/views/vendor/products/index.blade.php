<link rel="stylesheet" href="{{asset('assets/css/dataTables/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/dataTables/dataTables.bootstrap5.css')}}" />

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('My Products') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <div class="text-right">
            <a href="{{route('products.create')}}" class="btn btn-primary">Add New Product</a>
          </div>

          <hr class="mt-2 mb-2">

          <table class="table table-bordered" id="products-table">
            <thead>
              <tr>
                <th>Image</th>
                <th>Code</th>
                <th>Name</th>
                <th class="text-left">Price</th>
                <th>Status</th>
                <th class="text-left">Submitted At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($products as $product)
                <tr>
                  <td>
                    <div class="d-flex justify-content-center">
                      <img class="rounded-circle" width="50px" src="{{ asset(($product->cover_image ? 'storage/' . $product->cover_image : 'dummy.png'))}}" />
                    </div>
                  </td>
                  <td>{{ $product->code }}</td>
                  <td>{{ $product->name }}</td>
                  <td class="text-left">{{ $product->price }}</td>
                  <td>
                    <span class="badge 
                        @if($product->status == 'pending') bg-warning 
                        @elseif($product->status == 'approved') bg-success 
                        @else bg-danger @endif">
                      {{ ucfirst($product->status) }}
                    </span>
                  </td>
                  <td class="text-left">{{ $product->created_at->format('Y-m-d') }}</td>
                  <td>
                    <a href="{{ route('products.edit',$product) }}" class="btn btn-sm btn-info">
                      <i class="fas fa-pen"></i>
                    </a>

                    <form action="{{ route('products.destroy',$product) }}" method="POST" style="display:inline-block;">
                      @csrf @method('DELETE')

                      <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

<script src="{{asset('assets/js/dataTables/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables/dataTables.js')}}"></script>
<script src="{{asset('assets/js/dataTables/dataTables.bootstrap5.js')}}"></script>

<script>
  $(document).ready(function() {
    $('.table').dataTable();
  });
</script>