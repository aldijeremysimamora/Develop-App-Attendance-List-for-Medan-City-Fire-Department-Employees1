<div>
    <div class="nxl-content">
        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-top-0">
                        <div class="tab-pane fade show active">
                            <form wire:submit.prevent="store" class="card-body personal-info">
                                <div class="mb-4 d-flex align-items-center justify-content-between">
                                    <h5 class="fw-bold mb-0 me-4">
                                        <span class="d-block mb-2">Edit Profil - {{ $this->name }}:</span>
                                    </h5>
                                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                                        <button type="button" wire:click="destroy"
                                            wire:confirm="Apakah kamu yakin ingin akun {{ $this->name }}?"
                                            class="btn btn-light-brand">
                                            <i class="feather-layers me-2"></i>
                                            <span>Hapus</span>
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="feather-save me-2"></i>
                                            <span>Simpan</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-3">
                                        <label class="fw-semibold">Foto Profil: </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="mb-4 mb-md-0 d-flex gap-4 your-brand">
                                            <div
                                                class="wd-100 ht-100 position-relative overflow-hidden border border-gray-2 rounded">
                                                <img src="{{ $photo ? $photo->temporaryUrl() : url('assets/images/avatar/' . $this->user->photo) }}"
                                                    class="upload-pic img-fluid rounded h-100 w-100" alt="">
                                                <div
                                                    class="position-absolute start-50 top-50 end-0 bottom-0 translate-middle h-100 w-100 hstack align-items-center justify-content-center c-pointer upload-button">
                                                    <i class="feather feather-camera" aria-hidden="true"></i>
                                                </div>
                                                <input wire:model="photo" class="file-upload" type="file"
                                                    accept="image/*">
                                            </div>
                                            <div class="d-flex flex-column gap-1">
                                                <div class="fs-11 text-gray-500 mt-2"># Unggah Foto Profil</div>
                                                <div class="fs-11 text-gray-500"># Rasio 800x800</div>
                                                <div class="fs-11 text-gray-500"># Ukuran Maks 2mb</div>
                                                <div class="fs-11 text-gray-500"># Tipe Foto: png, jpg, jpeg
                                                </div>
                                                @error('photo') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Name --}}
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="fw-semibold">Nama: </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-user"></i></div>
                                            <input wire:model="name" type="text" class="form-control" id="nameInput"
                                                placeholder="Nama" required pattern="^[a-zA-Z0-9\s]+$"
                                                title="Hanya huruf, angka, dan spasi yang diizinkan.">
                                        </div>
                                        @error('name') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                {{-- Rank --}}
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-3">
                                        <label for="rankInput" class="fw-semibold">Jabatan: </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-briefcase"></i></div>
                                            <input wire:model="rank" type="text" class="form-control" id="rankInput"
                                                placeholder="Jabatan" required pattern="^[a-zA-Z0-9\s]+$"
                                                title="Hanya huruf, angka, dan spasi yang diizinkan.">
                                        </div>
                                        @error('rank') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                {{-- NIP --}}
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-3">
                                        <label for="nipInput" class="fw-semibold">NIP: </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-globe"></i></div>
                                            <input wire:model="nip" type="text" class="form-control" id="nipInput"
                                                placeholder="NIP" required pattern="^[a-zA-Z0-9\s]+$"
                                                title="Hanya huruf, angka, dan spasi yang diizinkan.">
                                        </div>
                                        @error('nip') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                {{-- Password --}}
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-3">
                                        <label for="passwordInput" class="fw-semibold">Password: </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-lock"></i></div>
                                            <input wire:model="password" type="password" class="form-control"
                                                id="passwordInput" placeholder="Password" pattern="^[a-zA-Z0-9\s]+$"
                                                title="Hanya huruf, angka, dan spasi yang diizinkan.">
                                            <button type="button" class="input-group-text" id="togglePassword">
                                                <i id="eyeIcon" class="feather feather-eye-off"></i>
                                            </button>
                                        </div>
                                        @error('password') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                {{-- Office --}}
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-3">
                                        <label class="fw-semibold" for="office_idInput">Kantor: </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-home"></i></div>
                                            <select wire:model="office_id" id="office_idInput" class="form-control"
                                                required pattern="^[a-zA-Z0-9\s]+$"
                                                title="Hanya huruf, angka, dan spasi yang diizinkan.">
                                                @foreach ($this->offices as $office)
                                                <option value="{{ $office->id }}" data-icon="feather-home" {{ $office->
                                                    id ==
                                                    $this->my_office_id ? 'selected' : '' }}>{{
                                                    $office->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('office_id') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- Role --}}
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-3">
                                        <label class="fw-semibold" for="roleInput">Role: </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-shield"></i></div>
                                            <select wire:model="role" id="roleInput" class="form-control">
                                                <option value="admin" data-icon="feather-lock">Administrator</option>
                                                <option value="user" data-icon="feather-globe" selected>User</option>
                                            </select>
                                            @error('role') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('contentChanged', function(e) {
        loadScripts();
    });

    function loadScripts() {
        return new Promise((resolve, reject) => {
            $.getScript("{{url('assets/vendors/js/datepicker.min.js')}}", function() {
                $.getScript("{{url('assets/vendors/js/lslstrength.min.js')}}", function() {
                    $.getScript("{{url('assets/vendors/js/select2.min.js')}}", function() {
                        $.getScript("{{url('assets/vendors/js/select2-active.min.js')}}", function() {
                            $.getScript("{{url('assets/js/customers-create-init.min.js')}}", function() {
                                resolve();
                            }).fail(reject);
                        }).fail(reject);
                    }).fail(reject);
                }).fail(reject);
            }).fail(reject);
        });
    }

    loadScripts();
</script>
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        var passwordInput = document.getElementById('passwordInput');
        var eyeIcon = document.getElementById('eyeIcon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('feather-eye-off');
            eyeIcon.classList.add('feather-eye');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('feather-eye');
            eyeIcon.classList.add('feather-eye-off');
        }
    });
</script>
@endpush

@push('styles')
<link rel="stylesheet" type="text/css" href="{{url('assets/vendors/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/vendors/css/select2-theme.min.css')}}">
@endpush