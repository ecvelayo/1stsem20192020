<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Certificate;
use App\User;
use App\EnrolledTrainings;
use App\Training;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    public function getCertificate($id) {
        $cert = Certificate::where('training_id', '=', $id)->first();
        return response()->json($cert);
    }

    public function update(Request $request, Certificate $certificate) {
        $certificate->update($request->all());
        return response()->json($certificate);
    }

    public function addImage(Certificate $certificate, Request $request) {
        $request->validate([
            'background' => 'file|image|max:4000'
        ]);
        if($request->hasFile('background')) {
            if ($request->file('background')->isValid()) {
                $file = $request->file('background');
                $extension = $file->getClientOriginalExtension();
                $randomFilename = Str::random(20);
                $newFilename = $randomFilename.'.'.$extension;
                $destinationPath = public_path('storage/certificate/');
                $file->move($destinationPath, $newFilename);
                $certificate->background = $newFilename;
                $certificate->save();
            }
        }
        return response()->json($certificate);
    }
}
