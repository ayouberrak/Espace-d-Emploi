<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generateCv($id)
    {
        $user = User::with('profile')->findOrFail($id);
        $pdf = Pdf::loadView('pdfCv.cv', compact('user'));
        return $pdf->download('cv-' . $user->name . '.pdf');
    }
}
