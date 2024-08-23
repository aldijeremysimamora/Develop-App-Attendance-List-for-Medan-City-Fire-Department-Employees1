<?php

namespace App\Livewire\Office;

use App\Models\Office;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Component;

class EditOffice extends Component
{
    use WithFileUploads;

    public $name;
    public $address;
    public $latitude;
    public $longitude;
    public $start_open;
    public $end_open;
    public $start_close;
    public $end_close;
    public Office $office;

    public function mount($slug)
    {
        $this->office = Office::whereSlug($slug)->firstOrFail();
        $this->dataFromOffice();
    }

    public function render()
    {
        return view('office.edit')->title("Edit Kantor - " . $this->office->name);
    }

    protected function dataFromOffice()
    {
        $this->name = $this->office->name;
        $this->address = $this->office->address;
        $this->latitude = $this->office->latitude;
        $this->longitude = $this->office->longitude;
        $this->start_open = $this->office->start_open;
        $this->end_open = $this->office->end_open;
        $this->start_close = $this->office->start_close;
        $this->end_close = $this->office->end_close;
    }

    protected function dataToOffice()
    {
        $this->office->name = $this->name;
        $this->office->address = $this->address;
        $this->office->latitude = $this->latitude;
        $this->office->longitude = $this->longitude;
        $this->office->start_open = $this->start_open;
        $this->office->end_open = $this->end_open;
        $this->office->start_close = $this->start_close;
        $this->office->end_close = $this->end_close;
    }

    public function store()
    {
        $this->validate();
        $this->dataToOffice();
        $this->office->save();

        return redirect()->route('office');
    }

    public function destroy()
    {
        $this->office->delete();
        return redirect()->route('office');
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'start_open' => 'required|date_format:H:i',
            'end_open' => 'required|date_format:H:i|after:start_open',
            'start_close' => 'required|date_format:H:i|after:end_open',
            'end_close' => 'required|date_format:H:i|after:start_close',
        ];
    }
}