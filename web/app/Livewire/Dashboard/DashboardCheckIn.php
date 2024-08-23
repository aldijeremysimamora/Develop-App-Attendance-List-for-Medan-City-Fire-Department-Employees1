<?php

namespace App\Livewire\Dashboard;

use App\Models\Attendance;
use App\Models\Office;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardCheckIn extends Component
{
    public $presentUsers;
    public $absentUsers;
    public $offices;
    public $my_office;
    public $office_id;
    public $date;

    public function mount()
    {
        $this->office_id = Auth::user()->office_id;
        $this->date = date('Y-m-d');
    }

    public function updating($property, $value)
    {
        if ($property === 'date') {
            $this->getUsers();
        }
    }

    public function getData()
    {
        $this->getMyOffice();
        $this->getUsers();
        $this->getOffices();
    }

    public function render()
    {
        $this->getData();
        return view('dashboard.dashboard_check_in')->title("Absen Masuk");
    }

    protected function getUsers()
    {
        $date = $this->date;
        $users = User::where('office_id', $this->office_id)->get();

        $userIds = $users->pluck('id')->toArray();

        $attendances = Attendance::whereIn('user_id', $userIds)
            ->where('type', 'in')
            ->whereDate('created_at', $date)
            ->get()
            ->groupBy('user_id');

        $this->presentUsers = $users->map(function ($user) use ($attendances) {
            $user->attendanceData = $attendances->get($user->id, collect());
            return $user;
        })->filter(function ($user) {
            return $user->attendanceData->isNotEmpty();
        });

        $this->absentUsers = $users->filter(function ($user) use ($attendances) {
            return !$attendances->has($user->id);
        });
    }

    protected function getMyOffice()
    {
        $this->my_office = Office::where('id', $this->office_id)->first();
    }

    protected function getOffices()
    {
        $this->offices = Office::all();
    }

    public function setOffice($id)
    {
        $this->office_id = $id;
    }

    public function hydrate()
    {
        $this->dispatch('contentChanged');
    }
}
