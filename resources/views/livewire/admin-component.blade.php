<div class="content-wrapper">
    <div class="page-header flex-wrap row text-start text-gray">
        <h3>Data Admin</h3>
    </div>
    <div class="row">
        <!-- column -->
        <div class="col-12 grid-margin">
            <div class="card">

                @if($gantiForm == false)
                <div class="card-content">
                    <div class="card-body">
                        <h3 class="card-title">Username</h3>
                        <fieldset class="form-group">
                            <p class="form-control-static">{{ Auth::user()->username }}</p>
                        </fieldset>
                        <h3 class="card-title">Nama</h3>
                        <fieldset class="form-group">
                            <p class="form-control-static">{{ Auth::user()->nama }}</p>
                        </fieldset>
                        <div class="my-2" style="float: right;">
                            <button class="btn btn-md btn-warning" wire:click.prevent="edit()">Edit</button>
                        </div>
                    </div>
                </div>
                @else
                <div class="card-content">
                    <div class="card-body">
                        <h3 class="card-title">Username </h3>
                        <fieldset class="form-group">
                            @error('username')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" wire:model.defer="username" class="form-control">
                        </fieldset>
                        <h3 class="card-title">Nama </h3>
                        <fieldset class="form-group">
                            @error('nama')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" wire:model.defer="nama" class="form-control">
                        </fieldset>
                        <h3 class="card-title">Password Baru</h3>
                        <fieldset class="form-group">
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="password" wire:model.defer="password" class="form-control"
                                placeholder="iniuntukyangmasuk123">
                        </fieldset>

                        <h3 class="card-title">Konfirmasi Password</h3>
                        <fieldset class="form-group">
                            <input type="password" wire:model.defer="password_confirmation" class="form-control"
                                placeholder="iniuntukyangmasuk123">
                        </fieldset>

                        <h3 class="card-title">Password Sekarang</h3>
                        <fieldset class="form-group">
                            @error('current_password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="password" wire:model.defer="current_password" class="form-control"
                                placeholder="iniuntukyangmasuk123">
                        </fieldset>
                        <div class="my-2" style="float: right;">
                            <button class="btn btn-md btn-secondary" wire:click.prevent="gantiFormIni">Batal</button>
                            <button class="btn btn-md btn-info" wire:click.prevent="store">Simpan
                                Data</button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>




        @if(session()->has('message'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 100">
            <div id="toastId" class="toast align-items-center text-white bg-success border-0" role="alert"
                aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('message') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>