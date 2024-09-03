<!DOCTYPE html>
<html>
<head>
    <title>Hasil LQ</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Hasil LQ</h1>
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
            @foreach($data as $row)
                <tr>
                    <td>{{ $row->Sektor }}</td>
                    <td>{{ $row->LQ_2019 }}</td>
                    <td>{{ $row->LQ_2020 }}</td>
                    <td>{{ $row->LQ_2021 }}</td>
                    <td>{{ $row->LQ_2022 }}</td>
                    <td>{{ $row->LQ_2023 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
