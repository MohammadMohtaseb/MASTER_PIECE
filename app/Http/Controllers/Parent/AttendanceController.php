<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index(Request $request)
{
    $month = $request->input('month', date('m'));
    $year = $request->input('year', date('Y'));
    $week = $request->input('week', 0); // Default week is 0
    $status = $request->input('status'); // Get the attendance status (0 or 1)

    $studentId = $request->input('student_id'); // Get the selected student

    // Get all students associated with the parent
    $students = Auth::guard('parent')->user()->student;

    $attendances = collect(); // Collection to store attendance records

    // If the week value is 0, fetch all records for the month for each student
    if ($week == 0) {
        foreach ($students as $student) {
            if ($studentId && $student->id != $studentId) continue; // Filter based on selected student

            $query = Attendance::where('student_id', $student->id)
                ->whereMonth('date', $month)
                ->whereYear('date', $year);
            
            // Filter by status if provided
            if ($status !== null) {
                $query->where('status', $status);
            }

            $studentAttendances = $query->get();

            $attendances = $attendances->merge($studentAttendances);
        }
    } else {
        // Calculate start and end date of the week based on the specified month and year
        $startDate = Carbon::createFromDate($year, $month, 1)->startOfWeek()->addWeeks($week - 1);
        $endDate = $startDate->copy()->endOfWeek();

        foreach ($students as $student) {
            if ($studentId && $student->id != $studentId) continue; // Filter based on selected student

            $query = Attendance::where('student_id', $student->id)
                ->whereBetween('date', [$startDate, $endDate]);

            // Filter by status if provided
            if ($status !== null) {
                $query->where('status', $status);
            }

            $studentAttendances = $query->get();

            $attendances = $attendances->merge($studentAttendances);
        }
    }

    // Calculate the count of present and absent days
    $presentCount = $attendances->where('status', 1)->count();
    $absentCount = $attendances->where('status', 0)->count();

    return view('parent.attendances.index', compact('status', 'attendances', 'students', 'month', 'year', 'week', 'presentCount', 'absentCount', 'studentId'));
}

    

}
