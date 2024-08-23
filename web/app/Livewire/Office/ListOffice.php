<?php

namespace App\Livewire\Office;

use App\Models\Office;
use Carbon\Carbon;
use Livewire\Component;

class ListOffice extends Component
{
    public $offices;

    public function getData()
    {
        $this->getOffices();
    }

    public function render()
    {
        $this->getData();
        return view('office.list')->title("Kantor");
    }

    public function hydrate()
    {
        $this->dispatch('contentChanged');
    }

    protected function getOffices()
    {
        $this->offices = Office::all();

        foreach ($this->offices as $office) {
            $office->end_open = Carbon::parse($office->end_open)->format('H:i');
            $office->end_close = Carbon::parse($office->end_close)->format('H:i');
        }
    }
}