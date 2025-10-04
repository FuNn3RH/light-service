<?php

namespace App\Livewire\Hoosh\Admin\SubQuestion;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Hoosh\Question;
use Livewire\Attributes\Title;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use App\Enums\Hoosh\QuestionLevel;
use App\Models\Hoosh\MainQuestion;
use Illuminate\Support\Facades\Storage;

class SubQuestionForm extends Component
{

    use WithFileUploads;

    public $mainQuestion;
    public $subQuestion;
    public $levels = [];
    public $showType = false;
    public $level = QuestionLevel::EASY;
    public $score = 10;
    public $category = 'درک مطلب';
    public $content;
    public $type = 'text';
    public $options = [];
    public $image;
    public $savedImagePath;

    public bool $isEdit = false;

    public function mount(MainQuestion $mainQuestion, $subQuestion = null)
    {

        $this->mainQuestion = $mainQuestion;

        $this->levels = QuestionLevel::cases();

        if ($subQuestion) {
            $this->subQuestion = Question::find($subQuestion);

            if ($this->subQuestion) {
                $this->showType = $this->subQuestion->showType;
                $this->level = $this->subQuestion->level;
                $this->score = $this->subQuestion->score;
                $this->category = $this->subQuestion->category;
                $this->content = $this->subQuestion->content;
                $this->type = $this->subQuestion->type;
                $this->options = $this->subQuestion->options ?? [];
                $this->savedImagePath = $this->subQuestion->image;
                $this->isEdit = true;
            } else {
                session()->flash('message', ['type' => 'danger', 'text' => ['زیر سوال یافت نشد!']]);
                $this->redirect(route('hoosh.admin.questions.sub-questions.index', $this->mainQuestion));
            }
        }
    }

    public function save()
    {
        $this->validate();

        $subQuestion = new Question();
        $subQuestion->showType = $this->showType;
        $subQuestion->level = $this->level;
        $subQuestion->score = $this->score;
        $subQuestion->category = $this->category;
        $subQuestion->content = $this->content;
        $subQuestion->type = $this->type;
        $subQuestion->options = $this->options;

        if ($this->image) {
            $subQuestion->image = $this->image->store('hoosh/sub-questions', 'public');
        }

        $subQuestion->main_question_id = $this->mainQuestion->id;
        $subQuestion->save();

        session()->flash('message', ['type' => 'success', 'text' => ['زیر سوال با موفقیت ایجاد شد!']]);
        $this->redirect(route('hoosh.admin.questions.sub-questions.index', $this->mainQuestion));
    }

    public function update($subQuestionId)
    {
        $this->validate();

        $subQuestion = Question::find($subQuestionId);
        if (! $subQuestion) {
            session()->flash('message', ['type' => 'danger', 'text' => ['زیر سوال یافت نشد!']]);
            $this->redirect(route('hoosh.admin.questions.sub-questions.index', $this->mainQuestion));
        }

        $subQuestion->showType = $this->showType;
        $subQuestion->level = $this->level;
        $subQuestion->score = $this->score;
        $subQuestion->category = $this->category;
        $subQuestion->content = $this->content;
        $subQuestion->type = $this->type;
        $subQuestion->options = $this->options;
        $subQuestion->save();


        if ($this->image) {

            if ($subQuestion->image) {
                Storage::disk('public')->delete($subQuestion->image);
            }

            $subQuestion->image = $this->image->store('hoosh/sub-questions', 'public');
            $subQuestion->save();
        }

        session()->flash('message', ['type' => 'success', 'text' => ['زیر سوال با موفقیت ویرایش شد!']]);
        $this->redirect(route('hoosh.admin.questions.sub-questions.index', $this->mainQuestion), true);
    }

    protected function rules()
    {
        return [
            'level' => ['required', Rule::enum(QuestionLevel::class)],
            'score' => ['required', 'integer', 'min:1', 'max:100'],
            'category' => 'required|string|max:255',
            'content' => 'required|string|max:30000',
            'type' => 'required|in:text,choose,image',
            'options' => 'nullable|array',
            'options.*' => 'string',
            'image' => 'nullable|image|max:5048',
            'showType' => 'boolean',
        ];
    }

    #[Layout('components.hoosh.layouts.app')]
    #[Title('ویرایش/ایجاد زیر سوال')]
    public function render()
    {
        return view('livewire.hoosh.admin.sub-question.sub-question-form');
    }
}
