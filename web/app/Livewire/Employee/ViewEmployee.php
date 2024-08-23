<?php

namespace App\Livewire\Employee;

use App\Models\Attendance;
use App\Models\User;
use Livewire\Component;

class ViewEmployee extends Component
{
    public User $user;
    public $in;
    public $out;
    public $nip;

    public function mount($nip)
    {
        $this->nip = $nip;
    }

    public function render()
    {
        $this->getData();
        return view('employee.view')->title("Profil - " . $this->user->name);
    }

    public function getData()
    {
        $this->user = User::whereNip($this->nip)->with(['attendancesIn', 'attendancesOut'])->firstOrFail();
        $this->in = $this->user->attendancesIn;
        $this->out = $this->user->attendancesOut;
    }

    public function destroy()
    {
        $this->user->delete();
        return redirect()->route('employee');
    }
}