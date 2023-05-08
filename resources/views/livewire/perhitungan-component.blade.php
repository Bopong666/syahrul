<div class="content-wrapper">
    <div class="page-header flex-wrap row text-start text-gray">
        <h3>Perhitungan</h3>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">

                        <div id="coba">

                            <div class="my-3 d-flex justify-content-center">
                                <button class="btn btn-md btn-primary" onclick="toggle()" id="tombol">Tampil
                                    Perhitungan<i class="mdi mdi-eye"></i></button>
                            </div>

                            <div id="lihat" style="display: none;">
                                <h4 class="text-center">Matrik Keputusan</h4>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="text-center">
                                            <th>Kode pegawai</th>
                                            <th>Nama pegawai</th>
                                            @foreach ($kriteria as $key => $item)
                                            <th>(K{{ $key+1 }})</th>
                                            @endforeach
                                        </thead>
                                        <tbody>
                                            @foreach ($pegawai as $key => $item)
                                            <tr>
                                                <td class="text-center">A{{ $key+1 }}</td>
                                                <td class="text-start">{{ $item['nama'] }}</td>
                                                @foreach ($item['subkriteria'] as $subkriteria)
                                                <td class="text-center">{{ $subkriteria['bobot_sub_kriteria'] }}</td>
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <br><br>
                                <h4 class="text-center">Menentukan Nilai Bobot Kriteria</h4>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="text-center">
                                            <th>Kode</th>
                                            <th>Nama Kriteria</th>
                                            <th>Skala Nilai</th>
                                            <th>Tipe Kriteria</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($kriteria as $key => $item)
                                            <tr>
                                                <td class="text-center">K{{ $key+1 }}</td>
                                                <td class="">{{ $item->nama }}</td>
                                                <td class="text-center">{{ $item->bobot }}</td>
                                                <td class="text-center">{{ $item->tipe }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <br><br>
                                <h4 class="text-center">Nilai Pembagi</h4>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="text-center">

                                            @foreach ($kriteria as $key => $item)
                                            <th>(C{{ $key+1 }})</th>
                                            @endforeach
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($pembagi as $key => $item)
                                                <td class="text-center">{{ $item }}</td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br><br>
                                <h4 class="text-center">Matrik Normalisasi dengan Pembagi</h4>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="text-center">
                                            <th>Kode pegawai</th>
                                            @foreach ($kriteria as $key => $item)
                                            <th>(K{{ $key+1 }})</th>
                                            @endforeach
                                        </thead>
                                        <tbody>
                                            @foreach ($normalisasi as $key => $item)
                                            <tr>
                                                <td class="text-center">A{{ $key+1 }}</td>
                                                @foreach ($item as $subkriteria)
                                                <td class="text-center">{{ $subkriteria }}</td>
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <br><br>

                                <h4 class="text-center">Matrik Normalisasi Terbobot</h4>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="text-center">
                                            <th>Kode pegawai</th>
                                            @foreach ($kriteria as $key => $item)
                                            <th>(K{{ $key+1 }})</th>
                                            @endforeach
                                        </thead>
                                        <tbody>
                                            @foreach ($normalisasiterbobot as $key => $item)
                                            <tr>
                                                <td class="text-center">A{{ $key+1 }}</td>
                                                @foreach ($item as $subkriteria)
                                                <td class="text-center">{{ $subkriteria }}</td>
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <br><br>

                                <h4 class="text-center">Matrik Ideal Positif dan Negatif</h4>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="text-center">A+</td>
                                                @foreach ($aplus as $item)
                                                <td class="text-center">{{ $item }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="text-center">A-</td>
                                                @foreach ($amin as $item)
                                                <td class="text-center">{{ $item }}</td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br><br>

                                <h4 class="text-center">Jarak Setiap pegawai dengan Matriks Solusi Ideal Positif &
                                    Solusi
                                    Ideal
                                    Negatif</h4>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="text-center">
                                            <th>D+</th>
                                            @foreach ($kriteria as $key => $item)
                                            <th>(K{{ $key+1 }})</th>
                                            @endforeach
                                        </thead>
                                        <tbody>
                                            @foreach ($dplus as $key => $item)
                                            <tr>
                                                <td>{{ $item }}</td>
                                                @foreach ($jarakdplus[$key] as $nilai)
                                                <td class="text-center">{{ $nilai }}</td>
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="text-center">
                                            <th>D-</th>
                                            @foreach ($kriteria as $key => $item)
                                            <th>(K{{ $key+1 }})</th>
                                            @endforeach
                                        </thead>
                                        <tbody>
                                            @foreach ($dmin as $key => $item)
                                            <tr>
                                                <td>{{ $item }}</td>
                                                @foreach ($jarakdmin[$key] as $nilai)
                                                <td class="text-center">{{ $nilai }}</td>
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <br><br>


                                <h4 class="text-center">Hasil Perhitungan Metode TOPSIS </h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="text-center">
                                            <th>Nama Pegawai</th>
                                            <th>Hasil</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($hasil as $key =>$item)
                                            <tr>
                                                <td>{{ $item['nama_pegawai'] }}</td>
                                                <td class="text-center">{{ $item['hasil'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <br><br>
                            </div>
                            <h4 class="text-center">Ranking Hasil Perhitungan TOPSIS</h4>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-center">
                                        <th>Ranking</th>
                                        <th>Nama Pegawai</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($hasilranking as $key =>$item)
                                        <tr>
                                            <td class="text-center">{{ $key+1 }}</td>
                                            <td>{{ $item['nama_pegawai'] }}</td>
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
        @push('scripts')
        <script>
            function toggle() {
        var x = document.getElementById("lihat");
        if (x.style.display === "none") {
            x.style.display = "block";
            document.getElementById("tombol").innerHTML = "Tutup Perhitungan<i class='mdi mdi-eye-off'>";
        } else {
            x.style.display = "none";
            document.getElementById("tombol").innerHTML = "Tampil Perhitungan<i class='mdi mdi-eye'>";
    
        }
        }
        </script>
        @endpush
    </div>


</div>