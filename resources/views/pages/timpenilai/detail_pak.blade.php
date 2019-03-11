<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- <link rel="shortcut icon"  type="image/png" sizes="16x16" href="{{{ asset('img/kementerian_logo.png') }}}"> -->
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

</head>
<body>
    <div class="A4">
     <div class="container">
         <header class="clearfix">
          <div id="logo">
            <img src="{{ asset('assets/img/kementerian_logo.png') }}">
        </div>
        <h4>DAFTAR USULAN PENETAPAN ANGKA KREDIT</h4>
        <div id="company" class="clearfix">
            <div>Masa Penilaian</div>
            <div>{{ \Carbon\Carbon::parse($this_submission->starts)->format('d / M / Y')." .sd. ".\Carbon\Carbon::parse($this_submission->ends)->format('d / M / Y') }}</div>
            <!-- <div><a href="mailto:company@example.com">company@example.com</a></div> -->
        </div>
        <div id="project">
            <div><span>INSTANSI</span> <strong>KEMENTERIAN AGAMA</strong></div>
            <div><span>JABATAN</span> <strong>PRANATA KOMPUTER</strong></div>
        </div>
    </header>
    <main>
        <div class="center">
            <strong>Keterangan Perorangan</strong>
        </div>
        <br>
        <table>
            <thead>
                <tr>
                    <th class="service">Nama</th>
                    <th class="desc">{{ $this_submission->nama }}</th>
                </tr>
                <tr>
                    <th class="service">NIP</th>
                    <th class="desc">{{ $this_submission->id_pemohon }}</th>
                </tr>
                <tr>
                    <th class="service">Nomor Seri Kartu Pegawai</th>
                    <th class="desc">{{ $this_submission->CardSerialNumber }}</th>
                </tr>
                <tr>
                    <th class="service">Tempat dan Tanggal Lahir</th>
                    <th class="desc">{{ $this_submission->birth_place.", ".$this_submission->birth_date }}</th>
                </tr>
                <tr>
                    <th class="service">Jenis Kelamin</th>
                    <th class="desc">{{ $this_submission->gender }}</th>
                </tr><tr>
                    <th class="service">Pendidikan yang Diperhitungkan Angka Kreditnya</th>
                    <th class="desc">Tanyakan</th>
                </tr><tr>
                    <th class="service">Jabatan Pranata Komputer</th>
                    <th class="desc">{{ $this_submission->pkPosition }}</th>
                </tr><tr>
                    <th class="service">Masa Kerja Golongan Lama</th>
                    <th class="desc">Tanyakan</th>
                </tr><tr>
                    <th class="service">Masa Kerja Golongan Baru</th>
                    <th class="desc">Tanyakan</th>
                </tr><tr>
                    <th class="service">Unit Kerja</th>
                    <th class="desc">{{ $this_submission->unit }}</th>
                </tr>
            </thead>
        </table>
        <table>
            <thead>
              <tr>
                <th class="service">No</th>
                <th class="desc">Unsur, Sub unsur dan Butir Kegiatan</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $items)
            <tr>
                <td class="service">{{$loop->iteration}}</td>
                <td class="desc">{{ $items->item_name }}</td>
                <td class="unit">
                   lama penilai / isian
                </td>
                <td class="qty">
                    baru
                </td>
                <td class="qty">jml</td>
                <td class="qty">lama penilai / isian</td>
                <td class="qty">baru penilai</td>
                <td class="total">jml</td>
            </tr>
            @endforeach

        </tbody>
    </table>
    <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
    </div>
</main>
     </div>
</div>
</body>
</html>

<!-- <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script type="text/javascript">
var max_pages = 100;
var page_count = 0;

function snipMe() {
  page_count++;
  if (page_count > max_pages) {
    return;
  }
  var long = $(this)[0].scrollHeight - Math.ceil($(this).innerHeight());
  var children = $(this).children().toArray();
  var removed = [];
  while (long > 0 && children.length > 0) {
    var child = children.pop();
    $(child).detach();
    removed.unshift(child);
    long = $(this)[0].scrollHeight - Math.ceil($(this).innerHeight());
  }
  if (removed.length > 0) {
    var a4 = $('<div class="A4"></div>');
    a4.append(removed);
    $(this).after(a4);
    snipMe.call(a4[0]);
  }
}

$(document).ready(function() {
  $('.A4').each(function() {
    snipMe.call(this);
  });
});


</script>
 -->