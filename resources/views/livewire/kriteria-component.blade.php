<div class="content-wrapper">
    <div class="page-header flex-wrap row text-start text-gray">
        <h3>Data Kriteria</h3>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                @if (Auth::user()->level == 0)
                <div class="m-3 float-md-right">
                    <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal"
                        data-bs-target="#modelId" wire:click.prevent="tambah()" id="anjay">
                        Tambah Data
                    </button>
                </div>

                @endif
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>Kode</th>
                                        <th>Kriteria</th>
                                        <th>Bobot</th>
                                        <th>Sub Kriteria</th>
                                        @if (Auth::user()->level == 0)
                                        <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lists as $key => $item)
                                    <tr>
                                        <td class="text-center">K{{ ($lists->currentpage()-1) *
                                            $lists->perpage()
                                            + $loop->index + 1
                                            }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td class="text-center">{{ $item->bobot*100 }}%</td>
                                        <td class="text-center">
                                            {{-- @dd($item->subkriteria) --}}
                                            @foreach ($item->subkriteria as $value)
                                            {{-- @dd($value) --}}
                                            {{ $value->nama_sub_kriteria
                                            }}({{ $value->bobot_sub_kriteria }})<br>
                                            @endforeach
                                        </td>
                                        @if (Auth::user()->level == 0)
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-md btn-success"
                                                        wire:click.prevent="edit({{ $item->id }})">Edit</button>
                                                    <button class="btn btn-md btn-danger"
                                                        wire:click="hapusKonfirmasi({{ $item->id }})">Hapus</button>
                                                </div>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                        <h5 class="modal-title">{{ $options }} Data Kriteria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="resetInput"></button>
                    </div>

                    <div class="modal-body">
                        <div class="container-fluid">
                            <form wire:submit.prevent="store">
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-4 col-form-label">Nama Kriteria</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            wire:model.defer="nama" placeholder="contoh = 'Kejujuran'">
                                        @error('nama')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-4 col-form-label">Bobot Kriteria</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('bobot') is-invalid @enderror"
                                            wire:model.defer="bobot" placeholder="contoh = '20'">
                                        @error('bobot')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-4 col-form-label">Tipe Kriteria</label>
                                    <div class="col-sm-8">
                                        <select wire:model.defer="tipe"
                                            class="form-control @error('tipe') is-invalid @enderror" id="basicSelect">
                                            <option>Pilih Tipe</option>
                                            <option value="benefit">Benefit</option>
                                            <option value="cost">Cost</option>
                                        </select>
                                        @error('tipe')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <hr>
                                @foreach ($subkriteria as $key => $value)
                                {{-- {{ $item['nama_sub_kriteria'] }} --}}
                                {{-- {{ $subkriteria.$key.nama_sub_kriteria }} --}}
                                @if ($key == 0)
                                <div class="">
                                    <h4>Sub Kriteria {{ $key+1 }}</h4>
                                    <h5 class="text-lg">Nama Sub Kriteria</h5>
                                    <fieldset class="form-group">
                                        @error('subkriteria.'.$key.'.nama_sub_kriteria')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <input type="text" wire:model.defer="subkriteria.{{ $key }}.nama_sub_kriteria"
                                            class="form-control" placeholder="contoh='< 3 mdpl'">
                                    </fieldset>
                                    <h5 class="card-title">Bobot Sub Kriteria</h5>
                                    <fieldset class="form-group">
                                        @error('subkriteria.'.$key.'.bobot_sub_kriteria')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <input type="text" wire:model.defer="subkriteria.{{ $key }}.bobot_sub_kriteria"
                                            class="form-control" placeholder="contoh='1'">
                                    </fieldset>

                                    <div class="btn btn-success btn-min-width mr-1 mb-1 btn-sm"
                                        wire:click.prevent="tambahSubKriteria"><i class="ft-plus-circle"></i>
                                        Tambah Sub
                                        Kriteria</div>

                                </div>
                                <br>
                                @else
                                <div class="">
                                    <h4>Sub Kriteria {{ $key+1 }}</h4>
                                    <div class="">
                                        <h5 class="card-title">Nama Sub Kriteria</h5>
                                        <fieldset class="form-group">
                                            @error('subkriteria.'.$key.'.nama_sub_kriteria')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <input type="text"
                                                wire:model.defer="subkriteria.{{ $key }}.nama_sub_kriteria"
                                                class="form-control" placeholder="contoh='< 3 mdpl'">
                                        </fieldset>
                                        <h5 class="card-title">Bobot Sub Kriteria</h5>
                                        <fieldset class="form-group">
                                            @error('subkriteria.'.$key.'.bobot_sub_kriteria')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <input type="text"
                                                wire:model.defer="subkriteria.{{ $key }}.bobot_sub_kriteria"
                                                class="form-control" placeholder="contoh='1'">
                                        </fieldset>
                                    </div>

                                    <div class="">
                                        <div class="btn btn-danger btn-min-width mr-1 mb-1 btn-sm"
                                            wire:click.prevent="hapusSubKriteria({{ $key }})"><i
                                                class="ft-minus-circle"></i>
                                            Hapus Sub
                                            Kriteria</div>
                                    </div>
                                    <br>
                                </div>
                                @endif
                                @endforeach

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


    <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
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