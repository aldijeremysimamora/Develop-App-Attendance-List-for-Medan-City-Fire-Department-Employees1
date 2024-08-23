<?php

namespace App\Livewire\Office;

use App\Models\Announcement;
use App\Models\Office;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateOffice extends Component
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

    public function render()
    {
        return view('office.create')->title("Buat kantor");
    }

    public function store()
    {
        $this->validate();

        Office::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'start_open' => $this->start_open,
            'end_open' => $this->end_open,
            'start_close' => $this->start_close,
            'end_close' => $this->end_close,
        ]);

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