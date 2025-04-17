<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Ảnh - Cloudflare Demo</title>
</head>
<body>
<h1>Upload ảnh lên Cloudflare Images</h1>

@if(session('url'))
    <p>✅ Ảnh đã upload thành công:</p>
    <img src="{{ session('url') }}" width="300">
    <p><a href="{{ session('url') }}" target="_blank">{{ session('url') }}</a></p>
@endif

@if(session('error'))
    <p style="color:red;">❌ {{ session('error') }}</p>
@endif

<form action="/upload-image" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Chọn ảnh:</label>
    <input type="file" name="image" required>
    <br><br>
    <button type="submit">Upload</button>
</form>
</body>
</html>
