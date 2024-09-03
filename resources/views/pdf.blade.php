<!-- Contoh di pdf.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <style>
        /* Styling untuk tabel */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Tabel LQ</h2>
    <table>
        <thead>
            <tr>
                <th>Sektor</th>
                <th>LQ 2019</th>
                <th>LQ 2020</th>
                <th>LQ 2021</th>
                <th>LQ 2022</th>
                <th>LQ 2023</th>
            </tr>
        </thead>
        <tbody>
            @foreach($l
