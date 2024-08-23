<?php

namespace App\Livewire\Announcement;

use App\Models\Announcement;
use App\Models\Office;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListAnnouncement extends Component
{
    public $announcements;
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
        $this->getAnnouncements();
        $this->getOffices();
    }

    public function render()
    {
        $this->getData();
        return view('announcement.list')->title("Berita");
    }

    public function hydrate()
    {
        $this->dispatch('contentChanged');
    }

    protected function getMyOffice()
    {
        $this->my_office = Office::where('id', $this->office_id)->first();
    }

    protected function getAnnouncements()
    {
        $this->announcements = Announcement::where('office_id', $this->office_id)->get();
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