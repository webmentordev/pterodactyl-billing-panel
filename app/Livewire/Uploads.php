<?php

namespace App\Livewire;

use Exception;
use App\Models\Upload;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Uploads extends Component
{
    use WithFileUploads;
    public $file;

    #[Layout('layouts.livewire.user')]
    public function render()
    {
        return view('livewire.uploads', [
            'uploads' => Upload::where('user_id', Auth::user()->id)->latest()->get()
        ]);
    }

    public function save(){
        $this->authorize('has-upload-space');

        $this->validate([
            'file' => ['required', 'file', 'max:61440']
        ]);
        $originalName = pathinfo($this->file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $this->file->getClientOriginalExtension();
        $filename = Str::slug($originalName) . '-' . time() . '.' . $extension;

        Upload::create([
            'name' => $this->file->storeAs('uploads', $filename, 'public'),
            'size' => round($this->file->getSize() / 1024, 2),
            'user_id' => Auth::user()->id,
        ]);
        return session()->flash('success', 'Your file has been uploaded!');
    }


    public function delete(Upload $upload){
        try{
            $this->authorize('manage-upload', $upload);
            Storage::disk('public')->delete($upload->name);
            $upload->delete();
            return session()->flash('success', 'Your file has been deleted!');
        }catch(Exception $e){
            Http::post(config('app.discord_exception'), [
                'content' => "```Delete File Exception:\n" . $e->getMessage() . "```",
            ]);
            return session()->flash('failed', 'There was an issue deleting your file. The issue has been reported to the admin.');
        }
    }
}