<?php

namespace App\Livewire\Share;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Share\Share as ShareModel;

class Share extends Component
{
    use WithFileUploads;

    public string $text = '';
    #[Validate('required|file|max:10240')]
    public $file;
    public $files = [];

    public function mount()
    {
        $this->text = $this->getText();
    }

    public function updatedFile()
    {
        $this->validateOnly('file');
        if ($this->file) {
            $filePath = uniqid('share_') . '_' . $this->file->getClientOriginalName();
            $this->file->storeAs('shares', $filePath, 'public');

            ShareModel::create([
                'src' => 'shares/' . $filePath,
                'name' => $this->file->getClientOriginalName(),
                'mime' => $this->file->getMimeType(),
                'size' => $this->file->getSize(),
                'expire_at' => Carbon::now()->addDay(),
            ]);
        }
    }

    public function updatedText()
    {
        File::put(storage_path('app/share/share.txt'), $this->text);
    }

    protected function getText()
    {
        $textPath = storage_path('app/share/share.txt');

        if (!File::exists(dirname($textPath))) {
            File::makeDirectory(dirname($textPath), 0755, true);
        }

        if (!File::exists($textPath)) {
            File::put($textPath, $this->text);
        }

        return File::get($textPath);
    }

    protected function getFiles()
    {
        return ShareModel::all();
    }

    public function delete($id)
    {
        $share = ShareModel::where('id', $id)->first();

        File::delete(public_path($share->src));
        $share->delete();
    }

    public function download($id)
    {
        $share = ShareModel::findOrFail($id);

        return Storage::disk('public')->download($share->src, $share->name);
    }

    #[Title('اشتراک')]
    #[Layout('components.share.layouts.app')]
    public function render()
    {
        $this->files = $this->getFiles();
        return view('livewire.share.share');
    }
}
