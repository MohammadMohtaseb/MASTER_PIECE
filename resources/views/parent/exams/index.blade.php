@extends('parent.layouts.app')


@section('content')
    <div class="row my-2">
        <div class="col-12 d-flex justify-content-between">
            <h3>Result</h3>

        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="card-title">All Results</div>
            <div class="text-center my-2">
                <span class="btn btn-success">Today</span>
                <span class="btn btn-warning">Waiting</span>
                <span class="btn btn-danger">Finish</span>
            </div>
            <table id="datatable" class="table-bordered border table table-striped dataTable p-0 text-center">
                @php
                    $i = 1;
                    use Carbon\Carbon;
                    $now = Carbon::now();
                    @endphp
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Teacher</th>
                        <th>Material</th>
                        <th>Start Exam</th>
                        <th>Students</th>
                        <th>Exam Link</th>

                    </tr>
                </thead>

                <tbody>


                    @foreach ($Exams as $item)
                        @php
                            $currentDate = Carbon::today();
                            $examDate = Carbon::parse($item->start_exam);
                            $isToday = $currentDate->isSameDay($examDate);
                            $startTime = Carbon::createFromTimeString($item->start_exam_time);

                            // حساب وقت نهاية الامتحان بإضافة مدة الامتحان إلى وقت البدء
                            $endTime = $startTime->copy()->addMinutes($item->time);

                            // تحويل الأوقات إلى توقيت ميللي ثانية
                            $startTimestamp = $startTime->timestamp * 1000;
                            $endTimestamp = $endTime->timestamp * 1000;

                            $bg = $isToday
                                ? 'bg-success text-white fw-bold'
                                : ($item->start_exam > $currentDate
                                    ? 'bg-warning text-white fw-bold'
                                    : 'bg-danger text-white fw-bold');
                        @endphp

                        <tr class="{{ $bg }}">
                            <td>{{ $i++ }} </td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->teacher->name }}</td>
                            <td>{{ $item->teacher->material->name }}</td>
                            <td>{{ $item->start_exam }}</td>
                          
                            <td>
                                @php 
                                $id_teacher =  $item->teacher->id;
                                $Teacher = \App\Models\Teacher::where('id',$id_teacher)->first();
                                $classroom_id_teacher = $Teacher->classrooms->pluck('id');

                                $Studnets = 
                                \App\Models\Student::where('parent_student_id',Auth::guard('parent')
                                ->user()->id)
                                ->whereIn('classroom_id',$classroom_id_teacher)
                                ->get()
                                @endphp 
                               @foreach ($Studnets as  $value)
                                   <span class="btn btn-dark">{{$value->name}}</span>
                               @endforeach
                            </td>

                            
                            @if(\Carbon\Carbon::parse($item->result_exam)->lessThanOrEqualTo($now))
                            <td><a target="_blank" href="{{ route('parent.result.show', $item->id) }}"
                                class="btn btn-primary btn-sm">RESULT</a></td>
                            @else 
                            <td>_</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection

@push('js')
    <script>
        // Function to update remaining time every second
        function startCountdown(examId, startTime, endTime) {
            const countdownElement = document.getElementById('countdown-' + examId);
            const examLinkElement = document.getElementById('exam-link-' + examId);

            function updateCountdown() {
                const now = new Date().getTime();
                const distance = startTime - now;
                const timeUntilEnd = endTime - now;

                if (distance > 0) {
                    // إذا كان الوقت قبل بدء الامتحان
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    countdownElement.innerHTML = hours + " hours, " + minutes + " minutes, " + seconds +
                        " seconds remaining";
                    examLinkElement.innerHTML = "...";
                } else if (timeUntilEnd > 0) {
                    // إذا كان الوقت بين بدء الامتحان وانتهائه
                    countdownElement.innerHTML = "Exam in progress";
                    examLinkElement.innerHTML =
                        '<a target="_blank"  class="btn btn-dark btn-sm" href="/student/exams/enter/' + examId +
                        '">Enter the exam</a>';
                } else {
                    // إذا انتهى الامتحان
                    countdownElement.innerHTML = "Exam finished";
                    examLinkElement.innerHTML = "<span class='badge bg-danger'>Finished</span>";
                    clearInterval(intervalId);
                }
            }

            // Update every second
            const intervalId = setInterval(updateCountdown, 1000);
        }

        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($Exams as $item)
                @if (Carbon::today()->isSameDay($item->start_exam))
                    startCountdown({{ $item->id }}, {{ $startTime->timestamp * 1000 }},
                        {{ $endTime->timestamp * 1000 }});
                @endif
            @endforeach
        });
    </script>
@endpush
