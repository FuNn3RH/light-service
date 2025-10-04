<?php

namespace App\Livewire\Hoosh\Admin\Users;

use Livewire\Component;
use App\Models\Hoosh\User;
use App\Models\Hoosh\MainQuestion;
use Illuminate\Support\Collection;

class UsersReport extends Component
{
    public $users;
    public array $mainQuestions;
    public array $filledUsers = [];

    public function mount()
    {
        $mainQuestions = MainQuestion::select('id', 'title', 'published_at')
            ->with('subQuestions.answers.user', 'subQuestions.answers.review')
            ->get();

        $data = [];
        $users = User::where('role', 'user')->get();

        foreach ($mainQuestions as $index => $mainQuestion) {

            if ($mainQuestion->subQuestionsCount < 1) {
                continue;
            }

            // group answers by user
            $groupedUsers = $mainQuestion->answers
                ->groupBy('user_id')
                ->map(function ($answers) use ($mainQuestion) {
                    $score = $answers->sum(function ($answer) {
                        return $answer->review?->score ?? 0;
                    });

                    return [
                        'score' => $score,
                        'percent' => $mainQuestion->total_score > 0
                            ? round(($score / $mainQuestion->total_score) * 100)
                            : 0,
                        'username' => $answers->first()->user->username
                    ];
                })
                ->toArray();

            $this->filledUsers = [];
            foreach ($users as $user) {
                if (isset($groupedUsers[$user->id])) {
                    $this->filledUsers[$user->id] = $groupedUsers[$user->id];
                } else {
                    $this->filledUsers[$user->id] = [
                        'score' => 0,
                        'percent' => 0,
                        'username' => $user->username
                    ];
                }
            }

            $filledUsers = array_filter($this->filledUsers, function ($user) {
                return $user['score'] > 0 && $user['percent'] > 0;
            });

            if (empty($filledUsers)) {
                continue;
            }

            $data[$index] = [
                'id' => $mainQuestion->id,
                'title' => $mainQuestion->title,
                'published_at' => JalaliDate($mainQuestion->published_at, 'Y-m-d H:i:s'),
                'question_count' => $mainQuestion->subQuestionsCount,
                'users' => $this->filledUsers
            ];
        }

        $this->mainQuestions = $data;
    }

    public function render()
    {
        return view('livewire.hoosh.admin.users.users-report');
    }
}
