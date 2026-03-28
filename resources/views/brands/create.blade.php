<a href="{{ route('brands.create') }}">Add Brand</a>

@foreach($brands as $brand)
    <h3>{{ $brand->name }}</h3>
    <img src="{{ asset('storage/'.$brand->logo) }}" width="100">

    <a href="{{ route('brands.edit', $brand->id) }}">Edit</a>

    <form action="{{ route('brands.destroy', $brand->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button>Delete</button>
    </form>
@endforeach