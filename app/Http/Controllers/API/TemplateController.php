<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TemplateController extends Controller
{
    public function download(Request $request): StreamedResponse
    {
        $lang = $request->query('lang', 'id'); // default 'id'

        $map = [
            'id' => 'templates/cv_template_ats_id.pdf',
            'en' => 'templates/cv_template_ats_en.pdf',
        ];

        if (! array_key_exists($lang, $map)) {
            abort(400, "Unsupported lang parameter. Use 'id' or 'en'.");
        }

        $path = $map[$lang];

        if (! Storage::exists($path)) {
            abort(404, 'Template file not found.');
        }

        $downloadName = $lang === 'en'
            ? 'CV-Template-ATS-EN.pdf'
            : 'CV-Template-ATS-ID.pdf';

        return Storage::download($path, $downloadName, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
