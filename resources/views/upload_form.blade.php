@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Upload Excel File for LQ Calculation</h2>

    <!-- Form untuk mengunggah file Excel -->
    <form action="{{ route('run-python-script') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="file" name="excel_file" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Upload and Calculate</button>
    </form>

    <!-- Tabel dan Diagram akan muncul di sini -->
    <div class="mt-5" id="lq-result" style="display:none;">
        <h2 class="mb-4">Tabel LQ</h2>
        <table class="table table-striped table-bordered" id="lq-table">
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
            <tbody></tbody>
        </table>

        <h2 class="mt-5 mb-4">Diagram Batang LQ</h2>
        <canvas id="lqChart"></canvas>

        <!-- Tampilkan Tombol Download -->
        <div class="mt-4" id="download-section" style="display:none;">
            <a href="#" id="download-link" class="btn btn-primary">Download Hasil LQ</a>
        </div>
    </div>
</div>

<!-- Tambahkan library Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData(form);
        const response = await fetch("{{ route('run-python-script') }}", {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.status === 'success') {
            // Tampilkan bagian hasil
            document.getElementById('lq-result').style.display = 'block';

            // Isi tabel dengan data
            const tableBody = document.querySelector('#lq-table tbody');
            tableBody.innerHTML = '';
            result.lq_data.forEach(row => {
                // Menghitung kategori per tahun
                const kategori2019 = row.LQ_2019 > 1 ? 'Basis' : 'Non-Basis';
                const kategori2020 = row.LQ_2020 > 1 ? 'Basis' : 'Non-Basis';
                const kategori2021 = row.LQ_2021 > 1 ? 'Basis' : 'Non-Basis';
                const kategori2022 = row.LQ_2022 > 1 ? 'Basis' : 'Non-Basis';
                const kategori2023 = row.LQ_2023 > 1 ? 'Basis' : 'Non-Basis';
                
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${row.Sektor}</td>
                    <td>${row.LQ_2019}</td>
                    <td>${row.LQ_2020}</td>
                    <td>${row.LQ_2021}</td>
                    <td>${row.LQ_2022}</td>
                    <td>${row.LQ_2023}</td>
                    <td>${kategori2019}</td>
                    <td>${kategori2020}</td>
                    <td>${kategori2021}</td>
                    <td>${kategori2022}</td>
                    <td>${kategori2023}</td>
                `;
                tableBody.appendChild(tr);
            });

            // Siapkan data untuk diagram
            const labels = result.lq_data.map(row => row.Sektor);
            const lq2019 = result.lq_data.map(row => row.LQ_2019);
            const lq2020 = result.lq_data.map(row => row.LQ_2020);
            const lq2021 = result.lq_data.map(row => row.LQ_2021);
            const lq2022 = result.lq_data.map(row => row.LQ_2022);
            const lq2023 = result.lq_data.map(row => row.LQ_2023);

            // Buat diagram
            var ctx = document.getElementById('lqChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'LQ 2019',
                            data: lq2019,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'LQ 2020',
                            data: lq2020,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'LQ 2021',
                            data: lq2021,
                            backgroundColor: 'rgba(255, 206, 86, 0.2)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'LQ 2022',
                            data: lq2022,
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'LQ 2023',
                            data: lq2023,
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Tampilkan tombol download jika tersedia
            if (result.tableName) {
                document.getElementById('download-section').style.display = 'block';
                document.getElementById('download-link').href = "{{ route('download-pdf', ['tableName' => ':tableName']) }}".replace(':tableName', result.tableName);
            }
        } else {
            alert('Error: ' + result.error);
        }
    });
});
</script>
@endsection
