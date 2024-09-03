<!DOCTYPE html>
<html>
<head>
    <title>Hasil LQ</title>
    <style>
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
    <h2>Hasil LQ</h2>
    <table>
        <thead>
            <tr>
                <th>Sektor</th>
                <th>LQ 2019</th>
                <th>LQ 2020</th>
                <th>LQ 2021</th>
                <th>LQ 2022</th>
                <th>LQ 2023</th>
                <th>Kategori 2019</th>
                <th>Kategori 2020</th>
                <th>Kategori 2021</th>
                <th>Kategori 2022</th>
                <th>Kategori 2023</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lqResults as $result)
                <tr>
                    <td>{{ $result->sektor }}</td>
                    <td>{{ $result->lq_2019 }}</td>
                    <td>{{ $result->lq_2020 }}</td>
                    <td>{{ $result->lq_2021 }}</td>
                    <td>{{ $result->lq_2022 }}</td>
                    <td>{{ $result->lq_2023 }}</td>
                    <td>{{ $result->lq_2019 > 1 ? 'Basis' : 'Non-Basis' }}</td>
                    <td>{{ $result->lq_2020 > 1 ? 'Basis' : 'Non-Basis' }}</td>
                    <td>{{ $result->lq_2021 > 1 ? 'Basis' : 'Non-Basis' }}</td>
                    <td>{{ $result->lq_2022 > 1 ? 'Basis' : 'Non-Basis' }}</td>
                    <td>{{ $result->lq_2023 > 1 ? 'Basis' : 'Non-Basis' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
