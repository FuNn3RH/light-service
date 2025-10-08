<?php

namespace App\Livewire\Hoosh\Users\Questions;

use Livewire\Component;
use App\Models\Hoosh\Answer;
use App\Models\Hoosh\Question;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Hoosh\MainQuestion;
use Livewire\WithFileUploads;

class QuestionForm extends Component
{

    use WithFileUploads;

    public MainQuestion $mainQuestion;
    public $questions;
    public $question;
    public string $answer_text;
    public array $images = [];

    public function mount(MainQuestion $mainQuestion)
    {
        $this->mainQuestion->userMainQuestion()->updateOrCreate([
            'user_id' => auth()->guard('hoosh')->id(),
        ]);

        $this->mainQuestion = $mainQuestion;
        $this->questions = Question::whereDoesntHave('answers', function ($query) {
            $query->where('user_id', auth()->guard('hoosh')->id());
        })
            ->where('main_question_id', $mainQuestion->id)
            ->get();

        $this->setNextQuestion();
    }

    protected function setNextQuestion()
    {
        if ($this->questions->count() >= 1) {
            $this->question = $this->questions->first();
            $this->question = $this->questions->first();
            $this->questions = $this->questions->slice(1)->values();
        } else {
            $this->redirect(route('hoosh.users.questions', $this->mainQuestion->id));
        }
    }

    public function submit()
    {

        if ($this->question->type === 'image') {
            $this->answer_text = 'عکس ارسال شده';
        }

        $this->validate();

        $imageSrc = [];
        if ($this->question->type === 'image') {
            foreach ($this->images as $image) {
                $imageSrc[] = $image->store('hoosh/answers', 'public');
            }
        }

        $this->question->answers()->updateOrCreate([
            'user_id' => auth()->guard('hoosh')->id(),
            'question_id' => $this->question->id
        ], [
            'answer_text' => $this->answer_text,
            'images' => $imageSrc ?? []
        ]);

        $this->reset('answer_text', 'images');
        $this->setNextQuestion();
        $this->showAlert(['type' => 'success', 'text' => ['پاسخ با موفقیت ثبت شد.']]);
    }

    protected function showAlert($data)
    {
        session()->flash('message', [
            'type' => $data['type'],
            'text' => $data['text'],
        ]);
    }

    public function rules(): array
    {
        $isImageQuestion = $this->question->type === 'image';

        return [
            'answer_text' => 'required|min:3|max:2000',
            'images' => [$isImageQuestion ? 'required' : 'nullable', 'array'],
            'images.*' => [$isImageQuestion ? 'required' : 'nullable', 'image'],
        ];
    }

    #[Title('داشبورد | پاسخ به زیر سوال')]
    #[Layout('components.hoosh.layouts.app')]
    public function render()
    {
        return view('livewire.hoosh.users.questions.question-form');
    }
}
