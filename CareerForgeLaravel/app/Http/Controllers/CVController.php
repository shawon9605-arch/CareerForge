<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class CVController extends Controller
{
    private function getBase64Image($path)
{
    if (!$path || !file_exists(public_path($path))) {
        return null;
    }

    $imageData = base64_encode(
        file_get_contents(public_path($path))
    );

    $extension = pathinfo($path, PATHINFO_EXTENSION);

    return 'data:image/' .
           $extension .
           ';base64,' .
           $imageData;
}
    // VIEW CV
    public function view()
    {
        $user = DB::table('students')->first();

        $profileImage =$this->getBase64Image($user->image ?? '');

        $imagePath = null;

        if (!empty($user->image)) {

            $imagePath =
            public_path($user->image);

        }

        $skills = [];

        if (!empty($user->skills)) {

            $skills =
            explode(',', $user->skills);

        }

        $projects =
        json_decode($user->projects ?? '[]');

        return view(
            'cv',
            compact(
                'user',
                'skills',
                'projects',
                'profileImage'
            )
        );
    }

    // DOWNLOAD CV
    public function download()
    {
        $user = DB::table('students')->first();

        $profileImage =$this->getBase64Image($user->image ?? '');

        $imagePath = null;

        if (!empty($user->image)) {

            $imagePath = asset($user->image);

        }

        $skills = [];

        if (!empty($user->skills)) {

            $skills =
            explode(',', $user->skills);

        }

        $projects =
        json_decode($user->projects ?? '[]');

        set_time_limit(300);

        $pdf = Pdf::loadView(
            'cv',
            compact(
                'user',
                'skills',
                'projects',
                'profileImage'
            )
        );

        $pdf->setPaper('A4');

        return $pdf->download(
            'CareerForge_CV.pdf'
        );
    }
}