<div class="content-wrapper">
    <div class="page-header flex-wrap row text-start text-gray">
        <h3>Data Kriteria</h3>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="d-flex mx-2 justify-content-between row">
                    <div class="col-md-6 mt-3">
                        <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal"
                            data-bs-target="#modelId" wire:click.prevent="tambah()" id="anjay">
                            Tambah Data
                        </button>
                    </div>
                    <div class=" col-md-6 mt-3">
                        <div class=" input-group d-flex justify-content-md-end">
                            <div class="form-outline">
                                <input type="search" class="form-control " wire:model.debounce.250ms="search"
                                    placeholder="cari nama" />
                            </div>
                            <div class=" input-group-append btn btn-primary d-flex align-items-center"
                                style="padding: 0.5rem">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>Level</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lists as $key => $item)
                                    <tr>
                                        <td class="text-center">{{ ($lists->currentpage()-1) *
                                            $lists->perpage()
                                            + $loop->index + 1
                                            }}</td>
                                        <td class="text-start">{{ $item->username }}</td>
                                        <td class="text-start">{{ $item->nama }}</td>
                                        <td class="text-center">{{ $item->level }}</td>
                                        <td class="text-center">{{
                                            date('d-m-Y',strtotime($item->tanggal_masuk))}}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-warning"
                                                        wire:click.prevent="edit({{ $item->id }})">Edit</button>
                                                    <button class="btn btn-sm btn-danger"
                                                        wire:click="hapusKonfirmasi({{ $item->id }})">Hapus</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2">
                            {{ $lists->links() }}

                        </div>

                    </div>

                </div>
            </div>
        </div>


        <!-- Modal CREATE AND UPDATE-->
        <div wire:ignore.self class="modal fade" id="modelId" data-bs-backdrop="static" data-bs-keyboard="false"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $options }} Data Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="resetInput"></button>
                    </div>

                    <div class="modal-body">
                        <div class="container-fluid">
                            <form wire:submit.prevent="store">
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-4 col-form-label">Username</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                            class="form-control @error('pengguna.username') is-invalid @enderror"
                                            wire:model.defer="pengguna.username" placeholder="contoh = 'muklis'">
                                        @error('pengguna.username')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-4 col-form-label">Nama</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                            class="form-control @error('pengguna.nama') is-invalid @enderror"
                                            wire:model.defer="pengguna.nama" placeholder="contoh = 'Abdul Muklis'">
                                        @error('pengguna.nama')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-4 col-form-label">Level</label>
                                    <div class="col-sm-8">
                                        <select wire:model.defer="pengguna.level"
                                            class="form-control @error('pengguna.level') is-invalid @enderror"
                                            id="basicSelect">
                                            <option>Pilih Level</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                        @error('pengguna.level')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-4 col-form-label">Tanggal masuk</label>
                                    <div class="col-sm-8">
                                        <input type="date" wire:model.defer="pengguna.tanggal_masuk"
                                            class="form-control @error('pengguna.tanggal_masuk') is-invalid @enderror">
                                        @error('pengguna.tanggal_masuk')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-4 col-form-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" wire:model.defer="pengguna.password"
                                            class="form-control @error('pengguna.password') is-invalid @enderror"
                                            placeholder="user123">
                                        @error('pengguna.password')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <hr>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                        wire:click="resetInput">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>


                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- Modal Hapus-->
    <div wire:ignore.self class="modal fade" id="deleteId" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center fs-4">
                        Apakah anda yakin mau menghapus data?
                    </p>
                    <div style="float: right;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" wire:click="hapus({{ $idHapus }})">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session()->has('message'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 100;">
        <div id="toastId" class="toast align-items-center text-white bg-primary border-0" role="alert"
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


    <div class="position-fixed top-0 end-0 p-3" style="z-index: 100;">
        <div id="toastDeleteId" class="toast align-items-center text-white bg-danger border-0" role="alert"
            aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <div class="d-flex">
                <div class="toast-body">
                    Data berhasil dihapus
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>