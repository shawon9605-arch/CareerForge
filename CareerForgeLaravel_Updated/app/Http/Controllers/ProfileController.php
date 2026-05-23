<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $user = session('user');

        // LOGIN CHECK
        if (!$user) {

            return redirect('/login');

        }

        $skills = [];

        if (!empty($user?->skills)) {

            $skills = explode(',', $user->skills);

        }

        $imageSrc = asset('assets/user.png');

        if (!empty($user?->image)) {

            $imageSrc = asset($user->image);

        }

        return view('profile', [

            'user' => $user,

            'skills' => $skills,

            'imageSrc' => $imageSrc

        ]);
    }

    public function update(Request $request)
    {
        // CURRENT LOGGED USER
        $user = session('user');

        // LOGIN CHECK
        if (!$user) {

            return redirect('/login');

        }

        $imagePath = $user->image ?? null;

        // IMAGE UPLOAD
        if ($request->hasFile('profile_image')) {

            $file = $request->file('profile_image');

            $fileName =
            time() . '_' .
            $file->getClientOriginalName();

            $destinationPath =
            public_path('uploads/profile_images');

            // CREATE FOLDER IF NOT EXISTS
            if (!file_exists($destinationPath)) {

                mkdir(
                    $destinationPath,
                    0777,
                    true
                );

            }

            // MOVE FILE
            $file->move(
                $destinationPath,
                $fileName
            );

            $imagePath =
            'uploads/profile_images/' . $fileName;
        }

        // UPDATE CURRENT USER
        DB::table('students')

            ->where(
                'id',
                $user->id
            )

            ->update([

                'name' =>
                $request->name,

                'gpa' =>
                $request->gpa,

                'interests' =>
                $request->interests,

                'education' =>
                $request->education,

                'experience' =>
                $request->experience,

                'skills' =>
                $request->skills,

                'projects' =>
                $request->projects,

                'image' =>
                $imagePath

            ]);

        // REFRESH SESSION
        $updatedUser = DB::table('students')

            ->where(
                'id',
                $user->id
            )

            ->first();

        session([
            'user' => $updatedUser
        ]);

        return redirect('/profile')

            ->with(
                'success',
                'Profile Updated Successfully!'
            );
    }
}
