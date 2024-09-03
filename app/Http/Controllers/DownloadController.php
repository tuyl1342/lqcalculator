<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadController extends Controller
{
    public function downloadHasil()
    {
        $filePath = storage_path('app/public/hasil_akhir.csv'); 
        
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File tidak ditemukan.'], 404);
        }

        return response()->download($filePath, 'hasil_akhir.xlsx');
    }
}


