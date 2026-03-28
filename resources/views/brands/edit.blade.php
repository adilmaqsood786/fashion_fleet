<form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="text" name="name" placeholder="Brand Name">
    @error('name') <p>{{ $message }}</p> @enderror

    <input type="file" name="logo">
    @error('logo') <p>{{ $message }}</p> @enderror

    <button>Add Brand</button>
</form>