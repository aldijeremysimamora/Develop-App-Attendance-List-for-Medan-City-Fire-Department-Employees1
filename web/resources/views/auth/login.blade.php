<div>
    <main class="auth-minimal-wrapper">
        <div class="auth-minimal-inner">
            <div class="minimal-card-wrapper">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{url('assets/images/logo-full.png')}}" alt="" class="img-fluid" style="height: 17vh;">
                </div>
                <div class="card mb-4 mt-5 mx-4 mx-sm-0 position-relative">
                    <div class="card-body p-sm-5">
                        <h2 class="fs-20 fw-bolder mb-4">Login</h2>
                        <form wire:submit.prevent="login" class="w-100 mt-4 pt-2">
                            @csrf
                            <div class="mb-4">
                                <input type="text" wire:model="nip" class="form-control" placeholder="NIP" required
                                    autocomplete="nip">
                                @error('nip')
                                <span role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <input id="passwordInput" type="password" wire:model="password" class="form-control"
                                        placeholder="Password" autocomplete="current-password" required>
                                    <button type="button" class="input-group-text" id="togglePassword">
                                        <i id="eyeIcon" class="feather feather-eye-off"></i>
                                    </button>
                                </div>
                                @error('password')
                                <span role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-lg btn-primary w-100">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

@push('scripts')
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