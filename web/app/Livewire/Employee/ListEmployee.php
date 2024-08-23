<?php

namespace App\Livewire\Employee;

use App\Models\Office;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListEmployee extends Component
{
    public $users;
    public $offices;
    public $my_office;
    public $office_id;

    public function mount()
    {
        $this->office_id = Auth::user()->office_id;
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
        return view('employee.list')->title("Pegawai");
    }

    public function hydrate()
    {
        $this->dispatch('contentChanged');
    }

    protected function getMyOffice()
    {
        $this->my_office = Office::where('id', $this->office_id)->first();
    }

    protected function getUsers()
    {
        $this->users = User::where('office_id', $this->office_id)->get();
    }

    protected function getOffices()
    {
        $this->offices = Office::all();
    }

    public function setOffice($id)
    {
        $this->office_id = $id;
    }

    // public function deleteUser($user_id)
    // {
    //     User::destroy($user_id);
    // }
}