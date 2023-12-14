<?php

namespace App\Http\Controllers;

use App\Models\CollegeFee;
use App\Models\Fees;
use App\Models\Course;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FeesController extends Controller
{
    public function Index()
    {

        return response()->view('admin.fees.index', ['fees_list' => CollegeFee::orderBy('created_at', 'DESC')->get()], ['students' => Students::orderBy('created_at', 'DESC')->get()])->header('Cache-Control', 'no-cache, no-store, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
    }


    public function Add()
    {
        return view('admin.fees.add', ['courses' => Course::orderBy('created_at', 'DESC')->get()], ['students' => Students::orderBy('created_at', 'DESC')->get()]);
    }
    public function Store()
    {
        // dd(request()->all());
        request()->validate([
            'student' => 'required',
            'fee_type' => 'required|min:3|max:50',
            'amount' => 'required|numeric|gt:0|regex:/^\d+(\.\d{1,2})?$/',
            'duedate' => 'required|min:3|max:50'
        ]);

        // validate if exist
        $existingRecord = CollegeFee::where('users_id', request()->get('student'))
            ->where('fee_type', strtolower(request()->get('fee_type')))
            ->exists();

        if ($existingRecord) {
            return back()->with('error', 'Record with the college fee already exists.');
        }

        $fees = CollegeFee::create([
            'users_id' => request()->get('student'),
            'fee_type' => strtolower(request()->get('fee_type')),
            'amount' => request()->get('amount'),
            'due_date' => request()->get('duedate'),
            'status' => 'unpaid',
        ]);

        if ($fees) {
            return back()->with('success', 'Created successfully!');
        } else {
            return back()->with('error', 'Failed to create the record.');
        }
    }

    public function Edit(CollegeFee $id)
    {
        return view('admin.fees.update', [
            'courses' => Course::orderBy('created_at', 'DESC')->get(),
            'students' => Students::orderBy('created_at', 'DESC')->get(),
            'fees' => $id,
        ]);
    }

    public function Destroy(CollegeFee $id)
    {
        try {
            $id->delete();
            return back()->with('success', 'Delete successfully!');
        } catch (ModelNotFoundException  $e) {
            return back()->with('error', 'Record not found.');
        }
    }

    public function Update(CollegeFee $fees)
    {

        request()->validate([
            'student_id' => 'required',
            'status' => 'required',
            'fee_type' => 'required|min:3|max:50',
            'amount' => 'required|numeric|gt:0|regex:/^\d+(\.\d{1,2})?$/',
            'duedate' => 'required|min:3|max:50'
        ]);

        $fees->users_id = request()->get('student_id', '');
        $fees->fee_type = request()->get('fee_type', '');
        $fees->amount = request()->get('amount', '');
        $fees->status = request()->get('status', '');
        $fees->due_date = request()->get('duedate', '');
        $fees->save();
        return back()->with('success', 'Updated successfully!');
    }

    public function Payment(CollegeFee $id)
    {
        return view('admin.fees.payment', [
            'courses' => Course::orderBy('created_at', 'DESC')->get(),
            'students' => Students::orderBy('created_at', 'DESC')->get(),
            'fees' => $id,
        ]);
    }


    public function PaymentUpdate(CollegeFee $fees)
    {
        $fees->status = 'paid';
        $fees->save();

        if ($fees->wasChanged('status')) {
            return redirect()->route('fees')->with('success', 'Payment successfully approved!');
        } else {
            return back()->with('error', 'Please try again later.');
        }
    }
}
