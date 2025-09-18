<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResumeRequest;
use App\Models\{Candidate, Resume, ResumeStageHistory};
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;

class ResumeUploadController extends Controller
{
    public function store(StoreResumeRequest $request): JsonResponse
    {
        // 1) Upsert Candidate by email (lowercase + trim)
        $email = strtolower(trim($request->email));

        $candidate = Candidate::updateOrCreate(
            ['email' => $email],
            [
                'full_name'   => $request->full_name,
                'phone'       => $request->phone,
                'country'     => $request->country,
                'region'      => $request->region,
                'city'        => $request->city,
                'summary'     => $request->summary,
            ]
        );

        // 2) Simpan file PDF
        $file            = $request->file('file');
        $originalName    = $file->getClientOriginalName();
        $safeName        = now()->format('Ymd_His') . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME));
        $ext             = $file->getClientOriginalExtension() ?: 'pdf';
        $finalName       = $safeName . '.' . $ext;
        $dir             = "resumes/{$candidate->id}";
        $path            = $file->storeAs($dir, $finalName);
        $fileSize        = $file->getSize();
        $mime            = $file->getMimeType() ?: 'application/pdf';

        // 3) Buat/replace Resume (1:1)
        $resume = Resume::updateOrCreate(
            ['candidate_id' => $candidate->id],
            [
                'original_filename' => $originalName,
                'file_path'         => $path,
                'file_size'         => $fileSize,
                'file_mime'         => $mime,

                'language'          => $request->language,
                'pages_count'       => null,   // diisi saat parsing (opsional)
                'text_content'      => null,   // diisi saat parsing
                'parsed_json'       => null,   // diisi saat parsing

                'parse_status'      => 'pending',
                'parsed_at'         => null,
                'failed_reason'     => null,
                'parser_version'    => null,

                'validation_status' => 'unvalidated',
                'validated_at'      => null,
            ]
        );

        // 4) Catat stage
        ResumeStageHistory::create([
            'resume_id' => $resume->id,
            'stage'     => 'uploaded',
            'note'      => 'User uploaded via API',
        ]);

        // 5) (Opsional) Dispatch job parsing
        // ParseResumeJob::dispatch($resume->id);

        return response()->json([
            'message'      => 'Resume uploaded. Parsing queued.',
            'candidate_id' => $candidate->id,
            'resume_id'    => $resume->id,
        ], 201);
    }
}
