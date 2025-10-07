<?php

namespace App\Livewire\Hoosh\Admin\MainQuestion;

use App\Enums\Hoosh\QuestionLevel;
use App\Models\Hoosh\MainQuestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class MainQuestionForm extends Component
{

    use WithFileUploads;

    public $isEdit = false;
    public $question;
    public $title;
    public $content;
    public $published_at;
    public $image;
    public $savedImagePath;
    public $level = QuestionLevel::EASY;
    public $levels = [];

    public function mount($question = null)
    {
        $this->levels = QuestionLevel::cases();
        if ($question) {
            $this->question = MainQuestion::find($question);
            if (!$this->question) {
                session()->flash('message', ['type' => 'danger', 'text' => ['سوال مورد نظر یافت نشد.']]);
                return $this->redirect(route('hoosh.admin.questions.index'), true);
            }

            $this->isEdit = true;
            $this->title = $this->question->title;
            $this->content = $this->question->content;
            $this->published_at = $this->question->published_at;
            $this->level = $this->question->level;
            $this->savedImagePath = $this->question->image;
        }
    }

    public function save()
    {
        $this->validate();

        $question = new MainQuestion();
        $question->title = $this->title;
        $question->content = $this->content;
        $question->published_at = $this->published_at;
        $question->level = $this->level;
        $question->user_id = Auth::guard('hoosh')->id();

        if ($this->image) {
            $imagePath = $this->image->store('main-questions/images', 'public');
            $question->image = $imagePath;
        }

        $question->save();

        session()->flash('message', ['type' => 'success', 'text' => ['سوال با موفقیت ایجاد شد.']]);
        return $this->redirect(route('hoosh.admin.questions.index'), true);
    }

    public function update($question)
    {
        $this->validate();

        $question = MainQuestion::find($question);
        $question->title = $this->title;
        $question->content = $this->content;
        $question->published_at = $this->published_at;
        $question->level = $this->level;

        if ($this->image) {

            if ($question->image) {
                Storage::disk('public')->delete($question->image);
            }

            $imagePath = $this->image->store('main-questions/images', 'public');
            $question->image = $imagePath;
        }

        $question->save();

        session()->flash('message', ['type' => 'success', 'text' => ['سوال با موفقیت ویرایش شد.']]);
        return $this->redirect(route('hoosh.admin.questions.index'), true);
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'required',
            'image' => 'nullable|image|max:5048',
            'level' => ['required', Rule::enum(QuestionLevel::class)],
        ];
    }

    #[Layout('components.hoosh.layouts.app')]
    #[Title('ایجاد / ویرایش سوال')]
    public function render()
    {
        return view('livewire.hoosh.admin.main-question.main-question-form');
    }
}
