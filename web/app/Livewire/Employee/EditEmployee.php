<?php

namespace App\Livewire\Employee;

use App\Http\Controllers\Utils;
use App\Models\Office;
use App\Models\User;
use Livewire\WithFileUploads;
use Livewire\Component;

class EditEmployee extends Component
{
    use WithFileUploads;

    public $photo;
    public $name;
    public $nip;
    public $role;
    public $rank;
    public $password;
    public $offices;
    public $office_id;
    public $my_office_id;
    public User $user;

    public function mount($nip)
    {
        $this->user = User::whereNip($nip)->first();
        $this->dataFromUser();
    }

    public function render()
    {
        $this->getOffices();
        return view('employee.edit')->title("Edit Profil - " . $this->name);
    }

    protected function getOffices()
    {
        $this->offices = Office::all();
    }

    protected function encryptPassword()
    {
        $this->password = bcrypt($this->password);
    }

    protected function dataFromUser()
    {
        $this->name = $this->user->name;
        $this->nip = $this->user->nip;
        $this->role = $this->user->role;
        $this->rank = $this->user->rank;
        $this->office_id = $this->user->office_id;
    }

    protected function dataToUser()
    {
        $this->user->name = $this->name;
        $this->user->nip = $this->nip;
        $this->user->role = $this->role;
        $this->user->rank = $this->rank;
        $this->user->office_id = $this->office_id;

        if ($this->photo) {
            $this->user->photo = $this->photo;
        }

        if ($this->password) {
            $this->user->password = $this->password;
        }
    }

    public function store()
    {
        $this->validate();
        if ($this->password) {
            $this->encryptPassword();
        }

        if ($this->photo) {
            $this->photo = Utils::upload($this->photo, 'avatar');
        }

        $this->dataToUser();
        $this->user->save();

        return redirect()->route('employee');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'max:255', $this->uniqueNipRule()],
            'role' => ['required', 'string', 'max:255'],
            'rank' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'max:255'],
            'office_id' => ['required', 'exists:offices,id'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ];
    }

    protected function uniqueNipRule()
    {
        if ($this->nip === $this->user->nip) {
            return '';
        } else {
            return 'unique:users,nip';
        }
    }

    public function destroy()
    {
        $this->user->delete();
        return redirect()->route('employee');
    }
}