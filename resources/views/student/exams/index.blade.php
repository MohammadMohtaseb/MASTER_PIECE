@extends('student.layouts.app')

@section('title')
    Exams
@endsection

@section('content')
    <div class="text-center my-2">
        <span class="btn btn-success">Today</span>
        <span class="btn btn-warning">Waiting</span>
        <span class="btn btn-danger">Finish</span>
    </div>
    <div class="card">
        <div class="card-body">
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
                        <th>Time left</th>
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
                            $endTime = $startTime->copy()->addMinutes($item->time);
                
                            $bg = $isToday
                                ? 'bg-success text-white fw-bold'
                                : ($item->start_exam > $currentDate
                                    ? 'bg-warning text-white fw-bold'
                                    : 'bg-danger text-white fw-bold');
                        @endphp
                        <tr class="{{ $bg }}" 
                            data-exam-id="{{ $item->id }}" 
                            data-start-time="{{ $startTime->timestamp * 1000 }}" 
                            data-end-time="{{ $endTime->timestamp * 1000 }}">
                            <td>{{ $i++ }} </td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->teacher->name }}</td>
                            <td>{{ $item->teacher->material->name }}</td>
                            <td>{{ $item->start_exam }}</td>
                            <td>
                                @if ($isToday)
                                    <span class="countdown"></span>
                                @else
                                    -
                                @endif
                            </td>
                            @if (Carbon::parse($item->start_exam)->isSameDay($now))
                                <td class="exam-link"></td>
                            @else
                                @if(Carbon::parse($item->result_exam)->lessThanOrEqualTo($now))
                                    <td><a target="_blank" href="{{ route('student.result.show', $item->id) }}" class="btn btn-primary btn-sm">RESULT</a></td>
                                @else 
                                    <td>_</td>
                                @endif
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
   document.addEventListener('DOMContentLoaded', function() {
    // الحصول على جميع الصفوف التي تحتوي على بيانات الوقت باستخدام `data-attributes`
    document.querySelectorAll('tr[data-exam-id]').forEach(function(row) {
        const examId = row.getAttribute('data-exam-id');
        const startTime = parseInt(row.getAttribute('data-start-time'));
        const endTime = parseInt(row.getAttribute('data-end-time'));
        const countdownElement = row.querySelector('.countdown');
        const examLinkElement = row.querySelector('.exam-link');

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = startTime - now;
            const timeUntilEnd = endTime - now;

            // تحقق من وجود countdownElement و examLinkElement قبل استخدامهما
            if (countdownElement && examLinkElement) {
                if (distance > 0) {
                    // الوقت قبل بدء الامتحان
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    countdownElement.innerHTML = hours + " hours, " + minutes + " minutes, " + seconds + " seconds remaining";
                    examLinkElement.innerHTML = "...";
                } else if (timeUntilEnd > 0) {
                    // بين بدء الامتحان وانتهائه
                    countdownElement.innerHTML = "Exam in progress";
                    examLinkElement.innerHTML = '<a target="_blank" class="btn btn-dark btn-sm" href="/student/exams/enter/' + examId + '">Enter the exam</a>';
                } else {
                    // الامتحان انتهى
                    countdownElement.innerHTML = "Exam finished";
                    examLinkElement.innerHTML = "<span class='badge bg-danger'>Finished</span>";
                    clearInterval(intervalId);
                }
            }
        }

        // تحديث كل ثانية
        const intervalId = setInterval(updateCountdown, 1000);
    });
});

    </script>
@endpush
