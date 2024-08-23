<?php

namespace App\Livewire\Announcement;

use App\Models\Announcement;
use Livewire\Component;

class ViewAnnouncement extends Component
{
    public Announcement $announcement;

    public function mount($slug)
    {
        $this->announcement = Announcement::whereSlug($slug)->firstOrFail();
    }

    public function render()
    {
        return view('announcement.view')->title("Berita - " . $this->announcement->title);
    }

    public function destroy()
    {
        $this->announcement->delete();
        return redirect()->route('announcement');
    }
}