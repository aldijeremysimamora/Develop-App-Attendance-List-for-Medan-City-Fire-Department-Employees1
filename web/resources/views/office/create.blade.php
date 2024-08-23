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
                                        <span class="d-block mb-2">Buat kantor baru:</span>
                                    </h5>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="feather-save me-2"></i>
                                        <span>Simpan</span>
                                    </button>
                                </div>

                                {{-- Name --}}
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="fw-semibold">Nama: </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-type"></i></div>
                                            <input wire:model="name" id="nameInput" type="text" class="form-control"
                                                placeholder="Nama">
                                        </div>
                                        @error('name') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                {{-- Address --}}
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-3">
                                        <label for="addressInput" class="fw-semibold">Alamat: </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-map"></i></div>
                                            <input wire:model="address" id="addressInput" type="text"
                                                class="form-control" placeholder="Alamat">
                                        </div>
                                        @error('address') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                {{-- Latitude --}}
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-3">
                                        <label for="latitudeInput" class="fw-semibold">Koordinat Latitude: </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-map-pin"></i></div>
                                            <input wire:model="latitude" id="latitudeInput" type="text"
                                                class="form-control" placeholder="1.234567">
                                        </div>
                                        @error('latitude') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                {{-- Longitude --}}
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-3">
                                        <label for="longitudeInput" class="fw-semibold">Koordinat Longitude: </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-map-pin"></i></div>
                                            <input wire:model="longitude" id="longitudeInput" type="text"
                                                class="form-control" placeholder="7.654321">
                                        </div>
                                        @error('longitude') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                {{-- Start Open --}}
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-3">
                                        <label for="start_openInput" class="fw-semibold">Awal Jam Masuk: </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-clock"></i></div>
                                            <input wire:model="start_open" id="start_openInput" type="time"
                                                class="form-control" placeholder="06:00">
                                        </div>
                                        @error('start_open') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                {{-- End Open --}}
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-3">
                                        <label for="end_openInput" class="fw-semibold">Akhir Jam Masuk: </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-clock"></i></div>
                                            <input wire:model="end_open" id="end_openInput" type="time"
                                                class="form-control" placeholder="08:00">
                                        </div>
                                        @error('end_open') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                {{-- Start Close --}}
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-3">
                                        <label for="start_closeInput" class="fw-semibold">Awal Jam Pulang: </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-clock"></i></div>
                                            <input wire:model="start_close" id="start_closeInput" type="time"
                                                class="form-control" placeholder="17:00">
                                        </div>
                                        @error('start_close') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                {{-- End Close --}}
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-3">
                                        <label for="end_closeInput" class="fw-semibold">Akhir Jam Pulang: </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-clock"></i></div>
                                            <input wire:model="end_close" id="end_closeInput" type="time"
                                                class="form-control" placeholder="20:00">
                                        </div>
                                        @error('end_close') <span class="error">{{ $message }}</span> @enderror
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