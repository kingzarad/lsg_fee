<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Students;
use App\Models\CollegeFee;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function Index()
    {
        return response()->view('users.home', [
            'fees_list' => CollegeFee::orderBy('created_at', 'DESC')->get(),
            'students' => Students::orderBy('created_at', 'DESC')->get()
        ])->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function Show()
    {
        return view('admin.users.index', ['courses' => Course::orderBy('created_at', 'DESC')->get()], ['students' => Students::orderBy('created_at', 'DESC')->get()]);
    }

    public function PayForm(collegeFee $id)
    {
        return view('users.payform', [
            'courses' => Course::orderBy('created_at', 'DESC')->get(),
            'students' => Students::orderBy('created_at', 'DESC')->get(),
            'fees' => $id,
        ]);
    }

    public function PayFormUpdate(CollegeFee $fees)
    {
        request()->validate([
            'receipt' => 'required',
        ]);

        $originalFileName = request()->file('receipt')->getClientOriginalName();

        $filenamec = str_replace(' ', '_', $fees->users_id);
        $ext = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
        $unique = date('YmdHis');
        $fileNameNew = $filenamec . '_' . $unique . '.' . $ext;

        $fees->status = 'pending';
        $fees->proof_payment = strtolower($fileNameNew);
        $fees->save();

        if ($fees->wasChanged('status')) {
            $uploadedFile = request()->file('receipt')->storeAs('uploads', $fileNameNew, 'public');
            if ($uploadedFile) {
                return redirect()->route('users.home')->with('success', 'Payment successfully!');
            } else {
                return back()->with('error', 'Please try again later.');
            }
        } else {
            return back()->with('error', 'Please try again later.');
        }
    }
}
