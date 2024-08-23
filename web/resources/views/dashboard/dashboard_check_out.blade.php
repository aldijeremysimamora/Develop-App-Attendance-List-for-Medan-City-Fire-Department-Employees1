<div>
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">
                    <div class="d-flex d-md-none">
                        <a href="javascript:void(0)" class="page-header-right-close-toggle">
                            <i class="feather-arrow-left me-2"></i>
                            <span>Back</span>
                        </a>
                    </div>
                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <div class="dropdown">
                            <a class="btn btn-icon btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 10"
                                data-bs-auto-close="outside">
                                <i class="feather-filter me-2"></i>
                                <span class="text-truncate-1-line">{{ $this->my_office->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                @foreach ($this->offices as $office)
                                <a wire:key="{{$office->id}}" wire:click="setOffice({{$office->id}})"
                                    href="javascript:void(0);" class="dropdown-item
                                    {{$office->id == $this->my_office->id ? ' active' : ''}}
                                    ">
                                    <i class="feather-users me-3"></i>
                                    <span class="text-truncate-1-line">{{$office->name}}</span>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="dropdown">
                            <input wire:model.live="date" type="date" class="btn btn-primary">
                            </input>
                        </div>
                    </div>
                </div>
                <div class="d-md-none d-flex align-items-center">
                    <a href="javascript:void(0)" class="page-header-right-open-toggle">
                        <i class="feather-align-right fs-20"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row">
                <!-- [Hadir] start -->
                <div class="col-xxl-4">
                    <div class="card stretch stretch-full">
                        <div class="card-header">
                            <h5 class="card-title">Karyawan yang sudah pulang - {{
                                $this->presentUsers->count() }}/{{
                                $this->presentUsers->count() + $this->absentUsers->count() }}</h5>
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
                                            <th scope="row">Nama</th>
                                            @if (count($this->presentUsers) != 0)
                                            <th>Waktu</th>
                                            <th>Status</th>
                                            <th>Bukti Foto</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($this->presentUsers as $user)
                                        <tr wire:key="{{ $user->id }}">
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <a href="{{url('/employee/view/' . $user->nip)}}"
                                                        class="avatar-image">
                                                        <img src="{{url('assets/images/avatar/' . $user->photo)}}"
                                                            alt="" class="img-fluid" />
                                                    </a>
                                                    <a href="{{url('/employee/view/' . $user->nip)}}">
                                                        <span class="d-block">{{ $user->name }}</span>
                                                    </a>
                                                </div>
                                            </td>
                                            <td> {{ $user->attendanceData[0]->created_at->format('H:i') }}</td>
                                            <td>
                                                @if ($user->attendanceData[0]->time_deviation == 0)
                                                <span class="badge bg-soft-success text-success">
                                                    Tepat Waktu
                                                </span>
                                                @elseif($user->attendanceData[0]->time_deviation > 0)
                                                <span class="badge bg-soft-warning text-danger">
                                                    Terlambat
                                                </span>
                                                @elseif($user->attendanceData[0]->time_deviation < 0) <span
                                                    class="badge bg-soft-warning text-danger">
                                                    Terlalu Cepat
                                                    </span>
                                                    @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="wd-50 ht-50 rounded-2">
                                                        <a href="{{url('assets/images/attendance/' . $user->attendanceData[0]->image)}}"
                                                            target="_blank">
                                                            <img src="{{url('assets/images/attendance/' . $user->attendanceData[0]->image)}}"
                                                                alt="" class="img-fluid" />
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @if (count($this->presentUsers) == 0)
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center gap-3">
                                                    <span class="d-block">Belum ada yang pulang</span>
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

                {{--
                <!-- [Tidak Hadir] start -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card stretch stretch-full">
                        <div class="card-header">
                            <h5 class="card-title">Belum pulang - {{ $this->absentUsers->count() }}/{{
                                $this->absentUsers->count() + $this->presentUsers->count() }}</h5>
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
                                            <th scope="row">Nama</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($this->absentUsers as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="avatar-image">
                                                        <img src="{{url('assets/images/avatar/' . $user->photo)}}"
                                                            alt="" class="img-fluid" />
                                                    </div>
                                                    <a href="javascript:void(0);">
                                                        <span class="d-block">{{ $user->name }}</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @if (count($this->absentUsers) == 0)
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center gap-3">
                                                    <span class="d-block">Semuanya sudah pulang</span>
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
                <!-- [Tidak Hadir] start --> --}}
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
    <script src="{{url('assets/vendors/js/daterangepicker.min.js')}}"></script>
    <script src="{{url('assets/vendors/js/apexcharts.min.js')}}"></script>
    <script src="{{url('assets/vendors/js/circle-progress.min.js')}}"></script>
    <script src="{{url('assets/js/dashboard-init.min.js')}}"></script>
</div>

@push('scripts')
<script>
    document.addEventListener('contentChanged', function(e) {
        loadScripts();
    });

    function loadScripts() {
        return new Promise((resolve, reject) => {
            $.getScript("{{url('assets/vendors/js/daterangepicker.min.js')}}", function() {
                $.getScript("{{url('assets/vendors/js/apexcharts.min.js')}}", function() {
                    $.getScript("{{url('assets/vendors/js/circle-progress.min.js')}}", function() {
                        $.getScript("{{url('assets/js/dashboard-init.min.js')}}", function() {
                            resolve();
                        }).fail(reject);
                    }).fail(reject);
                }).fail(reject);
            }).fail(reject);
        });
    }

    loadScripts();
</script>
@endpush

@push('styles')
<link rel="stylesheet" type="text/css" href="{{url('assets/vendors/css/daterangepicker.min.css')}}" />
@endpush