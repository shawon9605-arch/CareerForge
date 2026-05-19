<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfileSaveController extends Controller
{
    public function store(Request $request): RedirectResponse|
        \Illuminate\Http\JsonResponse|
        \Illuminate\Http\Response
    {
        $isAjax = $request->ajax()
            || $request->expectsJson()
            || $request->boolean('ajax');

        $email = (string) $request->session()->get('email', '');
        if ($email === '') {
            if ($isAjax) {
                return response()->json(['ok' => false, 'message' => 'Not logged in'], 401);
            }

            return redirect()->route('student.login');
        }

        $user = DB::table('students')->where('email', $email)->first();
        if (!$user) {
            if ($isAjax) {
                return response()->json(['ok' => false, 'message' => 'User not found'], 404);
            }
            abort(500, 'User not found. Please login again.');
        }

        $update = [];

        if ($request->has('name')) {
            $update['name'] = trim((string) $request->input('name', ''));
        }

        if ($request->has('skills')) {
            $skills = (string) $request->input('skills', '');
            $skillsArray = array_filter(array_map('trim', explode(',', $skills)), fn ($s) => $s !== '');
            $update['skills'] = implode(', ', array_values(array_unique($skillsArray)));
        }

        if ($request->has('interests')) {
            $update['interests'] = trim((string) $request->input('interests', ''));
        }

        if ($request->has('education')) {
            $update['education'] = trim((string) $request->input('education', ''));
        }

        if ($request->has('experience')) {
            $update['experience'] = trim((string) $request->input('experience', ''));
        }

        if ($request->has('projects')) {
            $update['projects'] = trim((string) $request->input('projects', '[]'));
        }

        if ($request->exists('gpa')) {
            $gpaRaw = trim((string) $request->input('gpa', ''));
            $update['gpa'] = ($gpaRaw === '') ? null : (float) $gpaRaw;
        }

        $relativePath = (string) ($user->image ?? '');

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');

            if (!$file->isValid()) {
                if ($isAjax) {
                    return response()->json(['ok' => false, 'message' => 'Image upload failed'], 400);
                }

                return response('Image upload failed', 400);
            }

            if ($file->getSize() > 2 * 1024 * 1024) {
                if ($isAjax) {
                    return response()->json(['ok' => false, 'message' => 'Image too large (max 2MB)'], 400);
                }

                return response('Image too large (max 2MB)', 400);
            }

            $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
            $ext = strtolower($file->getClientOriginalExtension() ?: '');
            if (!in_array($ext, $allowedExt, true)) {
                if ($isAjax) {
                    return response()->json(['ok' => false, 'message' => 'Unsupported image type'], 400);
                }

                return response('Unsupported image type', 400);
            }

            if ($ext === 'jpeg') {
                $ext = 'jpg';
            }

            $fileName = Str::random(32) . '.' . $ext;
            $targetDir = public_path('uploads/profile_images');

            if (!is_dir($targetDir)) {
                @mkdir($targetDir, 0777, true);
            }

            $file->move($targetDir, $fileName);

            $relativePath = 'uploads/profile_images/' . $fileName;
            $update['image'] = $relativePath;
        }

        if (!empty($update)) {
            DB::table('students')->where('email', $email)->update($update);
        }

        if ($isAjax) {
            return response()->json(['ok' => true]);
        }

        return redirect()->route('student.dashboard', ['success' => 1]);
    }
}
