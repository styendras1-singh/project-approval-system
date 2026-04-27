<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Fee;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::latest()->get();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Student::create($request->all());
        return redirect()->route('students.index')->with('success', 'Student Added');
    }
    

    /**
     * Display the specified resource.
     */
public function show(string $id)
{
    $student = Student::findOrFail($id);
    return view('students.show', compact('student'));
}

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
       public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->all());
        return redirect()->route('students.index')->with('success', 'Updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return back()->with('success', 'Deleted');
    }

     // Pay Fee Button Action
   public function payFee(Student $student)
{
    return view('students.pay_fee', compact('student'));
}

public function storeFee(Request $request, Student $student)
{
    Fee::create([
        'student_id' => $student->id,
        'amount' => $request->amount,
        'payment_mode' => $request->payment_mode,
        'payment_date' => now()
    ]);

    return redirect()->route('students.feeHistory', $student->id);
}

public function feeHistory(Student $student)
{
    $fees = $student->fees()->latest()->get();
    return view('students.fee_history', compact('student', 'fees'));
}

public function receipt(Fee $fee)
{
    return view('students.receipt', compact('fee'));
}

public function razorpayPayment(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:1',
        'student_id' => 'required'
    ]);

    $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

    $order = $api->order->create([
        'receipt' => 'order_' . time(),
        'amount' => $request->amount * 100,
        'currency' => 'INR'
    ]);

    $fee = Fee::create([
        'student_id' => $request->student_id,
        'amount' => $request->amount,
        'payment_mode' => 'online',
        'payment_date' => now(),
        'razorpay_order_id' => $order['id'],
        'status' => 'pending'
    ]);

    return view('students.razorpay_checkout', [
        'order_id' => $order['id'],
        'amount' => $request->amount,
        'student_id' => $request->student_id,
        'fee_id' => $fee->id
    ]);
    
    
}
public function razorpaySuccess(Request $request)
{
    return response()->json(['status' => 'success']);
}

}
