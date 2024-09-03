<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use PDF;  // Tambahkan untuk PDF handling
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PythonController extends Controller
{

    public function showForm()
    {
        return view('upload_form');  // Load the form view
    }

    public function runPythonScript(Request $request)
    {
        // Validate file yang diupload
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx',
        ]);

        // menyimpan file yang sudah diupload
        $fileName = $request->file('excel_file')->getClientOriginalName();
        $path = $request->file('excel_file')->storeAs('public', $fileName);

        // Define paths
        $pythonPath = 'C:\Users\LENOVO\AppData\Local\Programs\Python\Python312\python.exe';
        $scriptPath = storage_path('scripts/process_data.py');
        $excelPath = storage_path('app/public/' . $fileName);

        // menjalankan skrip python
        $process = new Process([$pythonPath, $scriptPath, $excelPath]);

        try {
            $process->mustRun();
    
            // Parse JSON output dari Python script
            $output = json_decode($process->getOutput(), true);
    
            // Tambahkan kategori ke output
            foreach ($output as &$row) {
                $row['Kategori'] = $row['LQ_2023'] > 1 ? 'Basis' : 'Non-Basis';
            }
    
            // Buat nama tabel berdasarkan nama file (hapus ekstensi dan sanitasi nama)
            $tableName = 'lq_results_' . pathinfo($fileName, PATHINFO_FILENAME);
            $tableName = preg_replace('/[^A-Za-z0-9_]/', '_', $tableName);
    
            // Buat tabel secara dinamis
            $this->createLQTable($tableName);
    
            // Simpan data LQ ke tabel yang baru dibuat
            $this->storeLQResults($output, $tableName);
    
            // Kembalikan respons sukses dengan data LQ dan tautan unduh opsional
            return response()->json([
                'status' => 'success',
                'message' => 'LQ Calculation completed successfully and saved to table: ' . $tableName,
                'lq_data' => $output,
                'tableName' => $tableName
            ]);
        } catch (ProcessFailedException $exception) {
            return response()->json(['status' => 'error', 'error' => $exception->getMessage()]);
        }
    }

    public function downloadPDF($tableName)
    {
        // Periksa apakah tabel ada
        if (!Schema::hasTable($tableName)) {
            return redirect()->back()->with('error', 'Table not found.');
        }
    
        // Ambil data dari tabel
        $lqResults = \DB::table($tableName)->get();
    
        // Membuat view PDF menggunakan laravel-dompdf pake landscape
        $pdf = PDF::loadView('lq_results_pdf', compact('lqResults'))
                  ->setPaper('a4', 'landscape'); // Menambahkan setPaper untuk mengatur tipe kertas dan orientasi
    
        // Unduh file PDF
        return $pdf->download($tableName . '_LQ_Results.pdf');
    }
    
    protected function storeLQResults($lqData, $tableName)
    {
        try {
            foreach ($lqData as $row) {
                \Illuminate\Support\Facades\DB::table($tableName)->insert([
                    'sektor' => $row['Sektor'],
                    'lq_2019' => $row['LQ_2019'],
                    'lq_2020' => $row['LQ_2020'],
                    'lq_2021' => $row['LQ_2021'],
                    'lq_2022' => $row['LQ_2022'],
                    'lq_2023' => $row['LQ_2023'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error saving LQ results: ' . $e->getMessage());
        }
    }

    protected function createLQTable($tableName)
    {
        \Illuminate\Support\Facades\Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('sektor');
            $table->decimal('lq_2019', 15, 4)->nullable();
            $table->decimal('lq_2020', 15, 4)->nullable();
            $table->decimal('lq_2021', 15, 4)->nullable();
            $table->decimal('lq_2022', 15, 4)->nullable();
            $table->decimal('lq_2023', 15, 4)->nullable();
            $table->timestamps();
        });
    }
}
