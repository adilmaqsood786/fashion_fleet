<div>
    <h1>upload file</h1>
    <form action="/upload" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" id="">
        <br>
        <button>upload</button>
    </form>
</div>