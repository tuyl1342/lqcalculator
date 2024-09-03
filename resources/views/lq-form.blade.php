<!DOCTYPE html>
<html>
<head>
    <title>LQ Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Upload Excel File for LQ Calculation</h2>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ url('/lq/calculate') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="excel_file" class="form-label">Excel File</label>
            <input type="file" name="excel_file" class="form-control" id="excel_file" required>
        </div>
        <button type="submit" class="btn btn-primary">Calculate LQ</button>
    </form>
    <!-- Tampilkan Hasil LQ di sini -->
<h1>Hasil Perhitungan LQ</h1>
<!-- ... kode lain yang menampilkan hasil ... -->

<!-- Tambahkan Tombol Download PDF -->
<a href="{{ route('download.lq.pdf', ['tableName' => $tableName]) }}" class="btn btn-primary">Download sebagai PDF</a>

</div>
</body>
</html>
