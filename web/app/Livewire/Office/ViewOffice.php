<?php

namespace App\Livewire\Office;

use App\Models\Office;
use Livewire\Component;

class ViewOffice extends Component
{
    public Office $office;

    public function mount($slug)
    {
        $this->office = Office::whereSlug($slug)->firstOrFail();
    }

    public function render()
    {
        return view('office.view')->title("Kantor - " . $this->office->name);
    }

    public function destroy()
    {
        $this->office->delete();
        return redirect()->route('office');
    }
}