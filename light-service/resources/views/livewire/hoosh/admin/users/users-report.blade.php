<div class="mb-5">

    <div class="table-responsive mt-5">
        <h2>گزارش</h2>
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>عنوان</th>
                    <th>تعداد سوالات</th>
                    <th>زمان انتشار</th>

                    @foreach ($filledUsers as $key => $filledUser)
                        <td>{{ $filledUser['username'] }}</td>
                    @endforeach

                </tr>
            </thead>
            <tbody>

                @foreach ($mainQuestions as $key => $mq)
                    <tr>
                        <td>{{ $mq['title'] }}</td>
                        <td>{{ $mq['question_count'] }}</td>
                        <td>{{ $mq['published_at'] ?? 'بدون تاریخ' }}</td>

                        @foreach ($mq['users'] as $user)
                            <td>{{ $user['percent'] }}%</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <livewire:hoosh.admin.users.users-chart :$mainQuestions />

</div>
