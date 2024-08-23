<?php

namespace App\Livewire\Announcement;

use App\Models\Announcement;
use App\Models\Office;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateAnnouncement extends Component
{
    use WithFileUploads;

    public $title;
    public $content;
    public $offices;
    public $office_id;
    public $my_office_id;

    public function mount()
    {
        $this->my_office_id = Auth::user()->office_id;
        $this->office_id = $this->my_office_id;
    }

    public function render()
    {
        $this->getOffices();
        return view('announcement.create')->title("Buat berita");
    }

    protected function getOffices()
    {
        $this->offices = Office::all();
    }

    public function store()
    {
        $this->validate();

        Announcement::create([
            'title' => $this->title,
            'content' => $this->content,
            'office_id' => $this->office_id,
            'slug' => Str::slug($this->title),
        ]);

        return redirect()->route('announcement');
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'office_id' => 'required|exists:offices,id',
        ];
    }
}