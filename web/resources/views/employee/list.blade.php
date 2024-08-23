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
                        <a href="/employee/create" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            <span>Tambah Pegawai</span>
                        </a>
                    </div>
                </div>
                <div class="d-md-none d-flex align-items-center">
                    <a href="javascript:void(0)" class="page-header-right-open-toggle">
                        <i class="feather-align-right fs-20"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover" id="customerList">
                                    <thead>
                                        <tr>
                                            <th>Pegawai</th>
                                            <th>NIP</th>
                                            <th>Jabatan</th>
                                            <th class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($this->users as $user)
                                        <tr wire:key="{{$user->id}}" class="single-item">
                                            <td>
                                                <a href="{{url('employee/view/' . $user->nip)}}" class="hstack gap-3">
                                                    <div class="avatar-image avatar-md">
                                                        <img src="{{url('assets/images/avatar/' . $user->photo)}}"
                                                            alt="" class="img-fluid">
                                                    </div>
                                                    <div>
                                                        <span class="text-truncate-1-line">{{$user->name}}</span>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>{{$user->nip}}</td>
                                            <td>{{$user->rank}}</td>
                                            <td>
                                                <div class="hstack gap-2 justify-content-end">
                                                    <a href="{{url('employee/view/' . $user->nip)}}"
                                                        class="avatar-text avatar-md">
                                                        <i class="feather feather-eye"></i>
                                                    </a>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                            data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                            <i class="feather feather-more-horizontal"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{url('employee/edit/' . $user->nip)}}">
                                                                    <i class="feather feather-edit-3 me-3"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                            </li>
                                                            {{-- <li class="dropdown-divider"></li>
                                                            <li>
                                                                <a wire:click="deleteUser({{$user->id}})"
                                                                    wire:confirm="Apakah kamu yakin ingin menghapus akun {{$user->name}}?"
                                                                    class="dropdown-item" href="javascript:void(0)">
                                                                    <i class="feather feather-trash-2 me-3"></i>
                                                                    <span>Delete</span>
                                                                </a>
                                                            </li> --}}
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
            $.getScript("{{url('assets/vendors/js/dataTables.min.js')}}", function() {
                $.getScript("{{url('assets/vendors/js/dataTables.bs5.min.js')}}", function() {
                    $.getScript("{{url('assets/vendors/js/select2.min.js')}}", function() {
                        $.getScript("{{url('assets/vendors/js/select2-active.min.js')}}", function() {
                            $.getScript("{{url('assets/js/customers-init.min.js')}}", function() {
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
@endpush

@push('styles')
<link rel="stylesheet" type="text/css" href="{{url('assets/vendors/css/dataTables.bs5.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/vendors/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/vendors/css/select2-theme.min.css')}}">
@endpush