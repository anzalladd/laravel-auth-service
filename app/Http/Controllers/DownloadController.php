<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function brocure()
    {
        $file_path = storage_path('app/public/brocure.pdf');

        return response()->download($file_path, 'brocure.pdf');
    }

    public function compro()
    {
        $file_path = storage_path('app/public/compro.pdf');

        return response()->download($file_path, 'compro.pdf');
    }

    public function poclia()
    {
        $file_path = storage_path('app/public/poclia.pdf');

        return response()->download($file_path, 'poclia.pdf');
    }
}
