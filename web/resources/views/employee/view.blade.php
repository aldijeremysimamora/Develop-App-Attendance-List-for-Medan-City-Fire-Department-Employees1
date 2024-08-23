<div>
    <div class="nxl-content">
        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-top-0">
                        <div class="tab-pane fade show active">
                            <div class="card-body personal-info">
                                <div class="mb-4 d-flex align-items-center justify-content-between">
                                    <h5 class="fw-bold mb-0 me-4">
                                        <span class="d-block mb-2">Profil - {{ $this->user->name }}</span>
                                    </h5>
                                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                                        <button type="button" wire:click="destroy"
                                            wire:confirm="Apakah kamu yakin ingin akun {{ $this->user->name }}?"
                                            class="btn btn-light-brand">
                                            <i class="feather-layers me-2"></i>
                                            <span>Hapus</span>
                                        </button>
                                        <a href="{{route('employee.edit', $this->user->nip)}}" class="btn btn-primary">
                                            <i class="feather-edit me-2"></i>
                                            <span>Edit</span>
                                        </a>
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
                                                <img src="{{url('assets/images/avatar/' . $this->user->photo)}}"
                                                    class="upload-pic img-fluid rounded h-100 w-100" alt="">
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
                                            <input value="{{ $this->user->name }}" type="text"
                                                class="form-control bg-white" disabled>
                                        </div>
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
                                            <input value="{{ $this->user->rank }}" type="text"
                                                class="form-control bg-white" disabled>
                                        </div>
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
                                            <input value="{{ $this->user->nip }}" type="text"
                                                class="form-control bg-white" disabled>
                                        </div>
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
                                            <input type="password" class="form-control bg-white" disabled>
                                            <button type="button" class="input-group-text" id="togglePassword">
                                                <i id="eyeIcon" class="feather feather-eye-off"></i>
                                            </button>
                                        </div>
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
                                            <select class="form-control bg-white" disabled>
                                                <option data-icon="feather-home" selected>
                                                    {{ $this->user->office->name }}
                                                </option>
                                            </select>
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
                                            <select wire:model="role" id="roleInput" class="form-control bg-white"
                                                disabled>
                                                <option selected>{{ $this->user->role == 'admin' ?
                                                    'Admin' : 'User' }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- --}}

            <div class="row">
                <!-- [Hadir] start -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card stretch stretch-full">
                        <div class="card-header">
                            <h5 class="card-title">Absen Masuk</h5>
                            <div class="card-header-action">
                                <div class="dropdown">
                                    <div data-bs-toggle="tooltip" title="Refresh">
                                        <a wire:click="getData" href="javascript:void(0);"
                                            class="avatar-text avatar-xs bg-warning"> </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                                        <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success"
                                            data-bs-toggle="expand"> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body custom-card-action p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr class="border-b">
                                            @if (count($this->in) > 0)
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Bukti Foto</th>
                                            @else
                                            <th>Status</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($this->in as $attendance)
                                        <tr wire:key="{{ $attendance->id }}">
                                            <td> {{ $attendance->created_at->translatedFormat('l, d F Y H:i') }}</td>
                                            <td>
                                                @if ($attendance->time_deviation == 0)
                                                <span class="badge bg-soft-success text-success">
                                                    Tepat Waktu
                                                </span>
                                                @elseif($attendance->time_deviation > 0)
                                                <span class="badge bg-soft-warning text-danger">
                                                    Terlambat
                                                </span>
                                                @elseif($attendance->time_deviation < 0) <span
                                                    class="badge bg-soft-warning text-danger">
                                                    Terlalu Cepat
                                                    </span>
                                                    @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="wd-50 ht-50 rounded-2">
                                                        <a href="{{url('assets/images/attendance/' . $attendance->image)}}"
                                                            target="_blank">
                                                            <img src="{{url('assets/images/attendance/' . $attendance->image)}}"
                                                                alt="" class="img-fluid" />
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @if (count($this->in) == 0)
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center gap-3">
                                                    <span class="d-block">Belum pernah absen</span>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [Hadir] start -->
                <!-- [Hadir] pulang start -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card stretch stretch-full">
                        <div class="card-header">
                            <h5 class="card-title">Absen Pulang</h5>
                            <div class="card-header-action">
                                <div class="dropdown">
                                    <div data-bs-toggle="tooltip" title="Refresh">
                                        <a wire:click="getData" href="javascript:void(0);"
                                            class="avatar-text avatar-xs bg-warning"> </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                                        <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success"
                                            data-bs-toggle="expand"> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body custom-card-action p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr class="border-b">
                                            @if (count($this->out) > 0)
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Bukti Foto</th>
                                            @else
                                            <th>Status</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($this->out as $attendance)
                                        <tr wire:key="{{ $attendance->id }}">
                                            <td> {{ $attendance->created_at->translatedFormat('l, d F Y H:i') }}</td>
                                            <td>
                                                @if ($attendance->time_deviation == 0)
                                                <span class="badge bg-soft-success text-success">
                                                    Tepat Waktu
                                                </span>
                                                @elseif($attendance->time_deviation > 0)
                                                <span class="badge bg-soft-warning text-danger">
                                                    Terlambat
                                                </span>
                                                @elseif($attendance->time_deviation < 0) <span
                                                    class="badge bg-soft-warning text-danger">
                                                    Terlalu Cepat
                                                    </span>
                                                    @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="wd-50 ht-50 rounded-2">
                                                        <a href="{{url('assets/images/attendance/' . $attendance->image)}}"
                                                            target="_blank">
                                                            <img src="{{url('assets/images/attendance/' . $attendance->image)}}"
                                                                alt="" class="img-fluid" />
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @if (count($this->out) == 0)
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center gap-3">
                                                    <span class="d-block">Belum pernah absen</span>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [Hadir] pulang start -->
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