@extends('parent.layouts.app')

@section('content')
<div class="row my-2">
    <div class="col-12 d-flex justify-content-between">
        <h3>Reports</h3>
        <a href="{{ route('parent.reports.home') }}" class="btn btn-dark d-none d-sm-inline-block">
            Reports
        </a>
    </div>
</div>

    <div class="col-12">
        <!-- شريط المعلومات في أعلى الشات -->
        <div class="chats-topbar mb-30 position-relative">
            <div class="d-block d-md-flex justify-content-between">
                <div class="d-block">
                    <h6 class="mb-0">{{$Report->teacher->name}}</h6>
                </div>

            </div>
        </div>

        <!-- منطقة الشات القابلة للتمرير -->
        <div class="scrollbar max-h-600" tabindex="3" style="overflow-y: auto; outline: none;">
            <div class="chats">
                @forelse ($Messages as $Message)
                    <div
                        class="chat-wrapper {{ $Message->type == 'parent' ?'chat-me' : 'chat-other'  }} clearfix">
                        <div class="chat-avatar">
                            <img class="img-fluid avatar-small"
                                src="images/{{ $Message->type == 'parent' ? 'teacher-avatar.jpg' : 'parent-avatar.jpg' }}"
                                alt="">
                        </div>
                        <div
                            class="chat-body {{ $Message->type == 'parent'   ? ' text-white' : 'bg-dark text-white' }} p-3">
                            <p>{{ $Message->message }}</p>
                        </div>
                    </div>
                    <span
                        class="time d-block mt-20px mb-20 text-center text-gray">{{ $Message->created_at->format('H:i A') }}</span>
                @empty
                    <p class="text-center">No messages found</p>
                @endforelse
            </div>
            <div id="chats" class="chats"></div>
        </div>

        <!-- منطقة إدخال الرسائل -->
        <div class="chats mt-30">
            <div class="chat-wrapper mb-0 clearfix">
                <div class="chat-input">
                    <div class="chat-input-icon">
                        <a class="text-muted" href="#"><i class="fa fa-smile-o"></i></a>
                    </div>
                    <textarea id="send" name="message" class="form-control input-message scrollbar" placeholder="Type here...*"
                        rows="2" style="overflow-y: hidden; outline: none;"></textarea>
                </div>
                <div class="chat-button">
                    <a href="#"><i class="ti-clip"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
            $('.scrollbar').animate({ scrollTop: $('.scrollbar')[0].scrollHeight+80000 }, 100);

        $(document).ready(function() {
            $('#send').keypress(function(event) {
                if (event.which == 13 && !event.shiftKey) {
                    event.preventDefault();
                    sendMessage();
                }
            });

            function sendMessage() {
    var message = $('#send').val();
    var reportId = {{ $Report->id }};

    $.ajax({
        url: "{{ route('parent.messages.store','parent') }}",
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            message: message,
            report_id: reportId
        },
        success: function(response) {
            console.log(response);

            // إضافة الرسالة الجديدة في الأعلى داخل chat-wrapper
            $('#chats').append(`
                <div class="chat-wrapper chat-me clearfix">
                    <div class="chat-avatar">
                        <img class="img-fluid avatar-small" src="images/parent-avatar.jpg" alt="">
                    </div>
                    <div class="chat-body text-white p-3">
                        <p>${response.message}</p>
                    </div>
                </div>
                <span class="time d-block mt-20px mb-20 text-center text-gray">${new Date().toLocaleTimeString()}</span>
            `);
            $('#send').val(''); // تفريغ textarea بعد الإرسال
            // تمرير القائمة إلى الأسفل لرؤية الرسالة الجديدة
            $('.scrollbar').animate({ scrollTop: $('.scrollbar')[0].scrollHeight+80000 }, 100);
        },
        error: function(error) {
            console.log('Error:', error);
        }
    });
}


        });
    </script>
@endpush
