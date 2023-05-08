<div class="content-wrapper">
    <div class="page-header flex-wrap row text-gray">
        <h3>Data Pegawai</h3>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">

            <div class="card">
                <div class="d-flex mx-2 justify-content-between row">
                    <div class=" mt-3">
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
                                        <th>Nama Pegawai</th>
                                        @foreach ($kriteria as $item)
                                        <th>{{ $item->nama }}</th>
                                        @endforeach
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @dd($lists[0]->subkriteria[0]->nama_sub_kriteria) --}}
                                    @foreach ($lists as $key => $item)
                                    <tr>
                                        <td class="text-center">{{ ($lists->currentpage()-1) *
                                            $lists->perpage()
                                            + $loop->index + 1
                                            }}</td>
                                        <td>{{ $item->nama }}</td>
                                        @foreach ($item->subkriteria as $sub)
                                        <td class="text-center">
                                            {{ $sub->nama_sub_kriteria }}
                                        </td>
                                        @endforeach
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-md btn-success"
                                                        wire:click.prevent="edit({{ $item->id }})">Menilai</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="my-2">
                            {{ $lists->links() }}

                        </div>

                    </div>

                </div>
            </div>
        </div>


        <!-- Modal Menilai-->
        <div wire:ignore.self class="modal fade" id="modelId" data-bs-backdrop="static" data-bs-keyboard="false"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $options }} Data Pegawai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="resetInput"></button>
                    </div>

                    <div class="modal-body">
                        <div class="container-fluid">
                            <form wire:submit.prevent="store">
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-4 col-form-label">Nama Pegawai</label>
                                    <fieldset class="form-group">
                                        <p class="form-control-static">{{ $pengguna['nama'] }}</p>
                                    </fieldset>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-4 col-form-label">Tanggal Masuk Pegawai</label>
                                    <fieldset class="form-group">
                                        <p class="form-control-static">{{ $pengguna['tanggal_masuk'] }}</p>
                                    </fieldset>
                                </div>
                                <hr>
                                <h3 class="text-center">Penilaian Kriteria</h3>

                                @foreach ($kriteria as $key => $item)
                                <h4 class="card-title">{{ $item->nama }}</h4>
                                <fieldset class="form-group">
                                    @error('pengguna.subkriteria.*')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <select wire:model.defer="pengguna.subkriteria.{{$key}}" class="form-control"
                                        id="basicSelect">
                                        <option>Pilih Tipe</option>
                                        @foreach ($item['subkriteria'] as $subkriteria)
                                        <option value="{{ $subkriteria->id }}">{{
                                            $subkriteria->nama_sub_kriteria }}</option>
                                        @endforeach
                                    </select>
                                </fieldset>
                                @endforeach

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                        wire:click.prevent="resetInput">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    @if(session()->has('message'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 120">
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
</div>