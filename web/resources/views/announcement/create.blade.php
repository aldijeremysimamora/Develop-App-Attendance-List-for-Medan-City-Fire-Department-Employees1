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
                                        <span class="d-block mb-2">Buat berita baru:</span>
                                    </h5>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="feather-save me-2"></i>
                                        <span>Simpan</span>
                                    </button>
                                </div>

                                {{-- Name --}}
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="fw-semibold">Judul: </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-type"></i></div>
                                            <input wire:model="title" type="text" class="form-control" placeholder="Judul">
                                        </div>
                                        @error('title') <span class="error">{{ $message }}</span> @enderror
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
                                        </div>
                                        @error('office_id') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                {{-- content --}}
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-3">
                                        <label for="contentInput" class="fw-semibold">Konten: </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-message-square"></i></div>
                                            <textarea wire:model="content" class="form-control" id="contentInput" cols="30" rows="10"
                                                placeholder="Konten"></textarea>
                                        </div>
                                        @error('content') <span class="error">{{ $message }}</span> @enderror
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