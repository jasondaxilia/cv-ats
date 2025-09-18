
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResumeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // tidak pakai auth dulu
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required','string','max:255'],
            'email'     => ['required','email','max:191'],
            'phone'     => ['nullable','string','max:50'],
            'country'   => ['nullable','string','max:100'],
            'region'    => ['nullable','string','max:100'],
            'city'      => ['nullable','string','max:100'],
            'summary'   => ['nullable','string'],
            'language'  => ['nullable','in:id,en'],
            'file'      => ['required','file','mimes:pdf','max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'file.mimes' => 'File harus dalam format PDF.',
            'file.max'   => 'Ukuran file maksimal 10 MB.',
        ];
    }
}
