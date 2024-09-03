<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF; // Pastikan gunakan library DomPDF yang sudah diinstal
use App\Models\LQData; // Sesuaikan dengan model yang Anda gunakan

class PDFController extends Controller
{
    public function downloadPDF(Request $request)
    {
        // Ambil data LQ dari database atau sumber yang relevan
        $lq_data = LQData::all(); // Sesuaikan query ini jika perlu filter khusus

        // Jika menggunakan gambar untuk grafik, pastikan path benar
        $chartImagePath = public_path('path/to/saved/chart.png'); // Ubah path sesuai dengan gambar chart

        // Render view pdf.blade.php menjadi PDF
        $pdf = PDF::loadView('pdf', compact('lq_data', 'chartImagePath')); // 'pdf' harus sesuai dengan nama view Anda

        // Download PDF
        return $pdf->download('hasil_perhitungan_lq.pdf');
    }
    
}
