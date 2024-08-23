<?php

namespace App\Livewire\Announcement;

use App\Models\Announcement;
use App\Models\Office;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Component;

class EditAnnouncement extends Component
{
    use WithFileUploads;

    public $title;
    public $content;
    public $offices;
    public $office_id;
    public $my_office_id;
    public Announcement $announcement;

    public function mount($slug)
    {
        $this->announcement = Announcement::whereSlug($slug)->firstOrFail();
        $this->dataFromAnnouncement();
    }

    public function render()
    {
        $this->getOffices();
        return view('announcement.edit')->title("Edit Berita - " . $this->announcement->title);
    }

    protected function getOffices()
    {
        $this->offices = Office::all();
    }

    protected function dataFromAnnouncement()
    {
        $this->title = $this->announcement->title;
        $this->content = $this->announcement->content;
        $this->office_id = $this->announcement->office_id;
    }

    protected function dataToAnnouncement()
    {
        $this->announcement->title = $this->title;
        $this->announcement->content = $this->content;
        $this->announcement->office_id = $this->office_id;
        $this->announcement->slug = Str::slug($this->title);
    }

    public function store()
    {
        $this->validate();
        $this->dataToAnnouncement();
        $this->announcement->save();

        return redirect()->route('announcement');
    }

    public function destroy()
    {
        $this->announcement->delete();
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