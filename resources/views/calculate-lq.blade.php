<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculate LQ</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>Calculate Location Quotient (LQ)</h1>
        
        <form id="lqForm" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="excel_file">Upload Excel File:</label>
                <input type="file" id="excel_file" name="excel_file" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Calculate LQ</button>
        </form>

        <div id="result" style="display:none;">
            <h2>Results</h2>
            <table id="lqTable" class="table">
                <!-- LQ Results will be inserted here -->
            </table>
            <h2>LQ Chart</h2>
            <canvas id="lqChart"></canvas>
        </div>
    </div>

    <script>
        document.getElementById('lqForm').addEventListener('submit', function(event) {
            event.preventDefault();
            let formData = new FormData(this);

            fetch('{{ route('run-python') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('result').style.display = 'block';

                    // Example of updating table with results and chart with Chart.js
                    // Assuming data includes LQ calculation result and labels
                    const labels = ['2019', '2020', '2021', '2022', '2023'];
                    const lqValues = [/* Data from processed Excel file */];

                    // Update table
                    let tableContent = '<tr><th>Year</th><th>LQ</th></tr>';
                    labels.forEach((label, index) => {
                        tableContent += `<tr><td>${label}</td><td>${lqValues[index]}</td></tr>`;
                    });
                    document.getElementById('lqTable').innerHTML = tableContent;

                    // Update chart
                    const ctx = document.getElementById('lqChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'LQ',
                                data: lqValues,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                } else {
                    alert('Error: ' + data.error);
                }
            });
        });
    </script>
</body>
</html>
