<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('../assets/img/local/logo1.png') }}">
    <title>GasTrack admin | @yield('title', $title)</title>
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.1.0') }}" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="g-sidenav-show">
    @foreach ($transaksis as $transaksi)
        <div class="border border-2 py-3 px-2">
            <div class="row">
                <div class="col ms-2">
                    <h1>INVOICE</h1>
                </div>
                <div class="col text-end mt-1 me-2">
                    <img class="ms-2" src="{{ asset('assets/img/local/logo5.png') }}" height="50" alt="main_logo">
                </div>
            </div>
            <hr class="border border-dark" style="width: 100%">
            <div class="row">
                <div class="col ms-4">
                    <h6 class="mb-0">KEPADA :</h6>
                    <p class="text-sm">{{ $transaksi->pelanggan->nama_perusahaan }}<br>
                        {{ $transaksi->pelanggan->email }}<br>
                        {{ $transaksi->pelanggan->no_hp }}<br>
                        {{ $transaksi->pelanggan->alamat }}</p>
                </div>
                <div class="col ms-7">
                    <div class="row">
                        <p class="col-4 text-sm fw-bold text-dark mb-0">Nomor</p>
                        <p class="col-1 text-sm fw-bold text-dark mb-0">:</p>
                        <p class="col text-sm text-second mb-0">INV-{{ $transaksi->resi_transaksi }}</p>
                    </div>
                    <div class="row">
                        <p class="col-4 text-sm fw-bold text-dark mb-0">Resi</p>
                        <p class="col-1 text-sm fw-bold text-dark mb-0">:</p>
                        <p class="col text-sm text-second mb-0">{{ $transaksi->resi_transaksi }}</p>
                    </div>
                    <div class="row">
                        <p class="col-4 text-sm fw-bold text-dark mb-0">Tanggal</p>
                        <p class="col-1 text-sm fw-bold text-dark mb-0">:</p>
                        <p class="col text-sm text-second mb-0">{{ date('d/m/Y') }}</p>
                    </div>
                    <div class="row">
                        <p class="col-4 text-sm fw-bold text-dark mb-0">Jatuh Tempo</p>
                        <p class="col-1 text-sm fw-bold text-dark mb-0">:</p>
                        <p class="col text-sm text-second mb-0">
                            {{ date('d/m/Y', strtotime($transaksi->tagihan->tanggal_jatuh_tempo)) }}</p>
                    </div>
                    <div class="row mb-2">
                        <p class="col-4 text-sm fw-bold text-dark mb-0">Admin</p>
                        <p class="col-1 text-sm fw-bold text-dark mb-0">:</p>
                        <p class="col text-sm text-second mb-0">{{ Auth::user()->nama }}</p>
                    </div>
                    <div class="row mb-3">
                        <div class="border border-1 border-dark text-center align-center p-1 w-75">
                            @if ($transaksi->tagihan->status_tagihan == 'Belum Bayar')
                                <h6 class="text-danger m-0"><em>Belum Bayar</em></h6>
                            @else
                                <h6 class="text-success m-0"><em>Lunas</em></h6>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="text-center ms-2">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Waktu</th>
                                        <th class="text-center">Produk</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Harga Satuan</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="text-dark" style="background-color: #e9ecef">
                                    @foreach ($pesanans as $index => $pesanan)
                                        @if ($pesanan->id_transaksi == $transaksi->id_transaksi)
                                            <tr class="fw-light">
                                                <td class="text-center">
                                                    <p class="text-sm mb-0">tanggal :
                                                        {{ date('d/m/Y', strtotime($pesanan->tanggal_pesanan)) }}</p>
                                                    <p class="text-sm mb-0">jam :
                                                        {{ date('h:i', strtotime($pesanan->tanggal_pesanan)) }}</p>
                                                </td>
                                                <td class="text-center">Gas Alam </td>
                                                <td class="text-center">{{ $pesanan->jumlah_bar }} bar / {{ $pesanan->jumlah_m3 }} m<sup>3</sup></td>
                                                <td class="text-center">{{ $harga_gas }}</td>
                                                <td class="text-center">
                                                    Rp.{{ number_format($pesanan->harga_pesanan, 0, ',', '.') }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <tr style="background-color: #ffffff">
                                        <td class="fw-bold text-secondary">Total: </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="5" class="fw-bold text-primary">
                                            Rp.{{ number_format($transaksi->tagihan->jumlah_tagihan, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col ms-4 text-dark">
                            <p class="text-sm fw-bold mb-1">Metode Pembayaran :</p>
                            <p class="text-sm mb-0">Tunai</p>
                        </div>
                        <div class="col ms-10 text-dark text-center">
                            <p class="text-sm fw-bold mb-4">Hormat Kami</p>
                            <p class="text-sm mb-4" style="color: #e9ecef;">TTD</p>
                            <p class="text-sm mb-4">____________________</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Core JS Files -->
    <script>
        window.print();
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
    @vite('resources/js/app.js')
</body>

</html>
