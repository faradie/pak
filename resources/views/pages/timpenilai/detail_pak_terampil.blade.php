<html>
<head>
    <title>Detail PAK {{ $this_submission->id }}</title>
</head>
<style>
.page-break {
    page-break-after: always;
}
.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

.text-center{
    text-align: center;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 18px;
    letter-spacing: -0.2px;
    word-spacing: 2px;
    color: #6D7286;
    font-weight: 400;
    text-decoration: none;
    font-style: normal;
    font-variant: normal;
    text-transform: uppercase;
}
.text-title{
    width: 15cm;  
    font-family: "Times New Roman", Times, serif;
    font-size: 15px;
    letter-spacing: 0.4px;
    word-spacing: -1.8px;
    color: #6D7286;
    font-weight: 400;
    text-decoration: none;
    font-style: normal;
    font-variant: normal;
    text-transform: none;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
/*  position: relative;
  width: 20cm;  
  height: 29.7cm; 
  margin: 0 auto; */
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

.logo {
  text-align: center;
  margin-bottom: 10px;
}

.logo img {
  width: 50px;
}

h4 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 1.5em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  /*background: url(dimension.png);*/
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
  width: 50%;
}

#project div,
#company div {
  white-space: nowrap;        
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}

.container {
  padding-top: 30px;
  padding-right: 30px;
  padding-bottom: 30px;
  padding-left: 30px;
}

.center {
  text-align: center;
  font-size: 1.2em;
}


/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 46%;
  display: table;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  display: table;
}

assets/img/kementerian_logo.png
</style>
<body>
    <header>
      <div class="logo">
        {{-- <img src="{{ URL::to('/')."/assets/img/kementerian_logo.png" }}"> --}}
    </div>
    <h4>DAFTAR USULAN PENETAPAN ANGKA KREDIT</h4>
    
    <div id="project">
        <div><span>INSTANSI</span> <strong>KEMENTERIAN AGAMA</strong></div>
        <div><span>JABATAN</span> <strong>PRANATA KOMPUTER</strong></div>
    </div>
    <div id="company">
        <div>Masa Penilaian</div>
        <div><strong>{{ \Carbon\Carbon::parse($this_submission->starts)->format('d / M / Y')." .sd. ".\Carbon\Carbon::parse($this_submission->ends)->format('d / M / Y') }}</strong></div>
        <!-- <div><a href="mailto:company@example.com">company@example.com</a></div> -->
    </div>
</header>
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
            <th class="desc">{{ $this_submission->birth_place }}, {{ $this_submission->tglLahir == null ? "" :\Carbon\Carbon::parse($this_submission->tglLahir)->format('d / M / Y') }}</th>
        </tr>
        <tr>
            <th class="service">Jenis Kelamin</th>
            <th class="desc">{{ $this_submission->gender }}</th>
        </tr><tr>
            <th class="service">Pendidikan yang Diperhitungkan Angka Kreditnya</th>
            <th class="desc">Tanyakan</th>
        </tr><tr>
            <th class="service">Jabatan Pranata Komputer</th>
            <th class="desc">{{ $pk_Position->position }}</th>
        </tr><tr>
            <th class="service">Masa Kerja Golongan Lama</th>
            <th class="desc">Tanyakan</th>
        </tr><tr>
            <th class="service">Masa Kerja Golongan Baru</th>
            <th class="desc">Tanyakan</th>
        </tr><tr>
            <th class="service">Unit Kerja</th>
            <th class="desc">{{ $unit_applicant->workUnit }}</th>
        </tr>
    </thead>
</table>
<small>Ket : </small>
<br>
<small>3 = Lama Institusi ; 4 = Baru Institusi ; 5 = Jumlah dari Institusi</small>
<br>
<small>6 = Lama Tim Penilai ; 7 = Baru Tim Penilai ; 8 = Jumlah dari Tim Penilai</small>
<br>
<br>

<div class="text-center">
    <strong>PENDIDIKAN</strong>
</div>
<div class="text-title">
    <strong>A. Pendidikan sekolah dan memperoleh ijazah/gelar</strong>
</div>
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
    @foreach ($butir_terampil1A as $butir)
    <tr>
        <td class="service">{{ strtoupper(substr($butir->id, 3)) }}</td>
        <td class="desc">{{ $butir->item_name }}</td>
        <td class="unit">
         @if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif
     </td>
     <td class="qty">
        @if ($get_submission_items->contains('id',$butir->id))
        @foreach ($get_submission_items as $get_submission_item)
        @if ($get_submission_item->id == $butir->id)
        {{ $get_submission_item->times*$get_submission_item->point }}
        @endif
        @endforeach
        @else
        -
        @endif
    </td>
    <td class="qty">jml</td>
    <td class="qty">
        @if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif
    </td>
    <td class="qty">
   @if ($get_final_dupak_scores->contains('item_id',$butir->id))
   @foreach ($get_final_dupak_scores as $get_final_dupak_score)
   @if ($get_final_dupak_score->item_id == $butir->id)
   {{ $get_final_dupak_score->times*$get_final_dupak_score->item_score }}
   @endif
   @endforeach
   @else
   -
   @endif
</td>
    <td class="total">jml</td>
</tr>
@endforeach
</tbody>
</table>
<div class="page-break"></div>
<div class="text-title">
    <strong>B. Pendidikan dan Pelatihan fungsional dibidang kepranataan komputer dan memperoleh surat tanda tamat pendidikan dan pelatihan</strong>
</div>
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
    @foreach ($butir_terampil1B as $butir)
    <tr>
        <td class="service">{{ strtoupper(substr($butir->id, 3)) }}</td>
        <td class="desc">{{ $butir->item_name }}</td>
        <td class="unit">
           @if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif
       </td>
       <td class="qty">
        @if ($get_submission_items->contains('id',$butir->id))
        @foreach ($get_submission_items as $get_submission_item)
        @if ($get_submission_item->id == $butir->id)
        {{ $get_submission_item->times*$get_submission_item->point }}
        @endif
        @endforeach
        @else
        -
        @endif
    </td>
    <td class="qty">jml</td>
    <td class="qty">@if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif</td>
    <td class="qty">
   @if ($get_final_dupak_scores->contains('item_id',$butir->id))
   @foreach ($get_final_dupak_scores as $get_final_dupak_score)
   @if ($get_final_dupak_score->item_id == $butir->id)
   {{ $get_final_dupak_score->times*$get_final_dupak_score->item_score }}
   @endif
   @endforeach
   @else
   -
   @endif
</td>
    <td class="total">jml</td>
</tr>
@endforeach
</tbody>
</table>

<div class="text-center">
    <strong>OPERASI TEKNOLOGI INFORMASI</strong>
</div>
<div class="text-title">
    <strong>A . Pengoperasian Komputer</strong>
</div>
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
   @foreach ($butir_terampil2A as $butir)
   <tr>
    <td class="service">{{ strtoupper(substr($butir->id, 3)) }}</td>
    <td class="desc">{{ $butir->item_name }}</td>
    <td class="unit">
       @if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif
   </td>
   <td class="qty">
    @if ($get_submission_items->contains('id',$butir->id))
    @foreach ($get_submission_items as $get_submission_item)
    @if ($get_submission_item->id == $butir->id)
    {{ $get_submission_item->times*$get_submission_item->point }}
    @endif
    @endforeach
    @else
    -
    @endif
</td>
<td class="qty">jml</td>
<td class="qty">@if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif</td>
<td class="qty">
   @if ($get_final_dupak_scores->contains('item_id',$butir->id))
   @foreach ($get_final_dupak_scores as $get_final_dupak_score)
   @if ($get_final_dupak_score->item_id == $butir->id)
   {{ $get_final_dupak_score->times*$get_final_dupak_score->item_score }}
   @endif
   @endforeach
   @else
   -
   @endif
</td>
<td class="total">jml</td>
</tr>
@endforeach
</tbody>
</table>


<div class="text-title">
    <strong>B . Perekaman Data</strong>
</div>
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
    @foreach ($butir_terampil2B as $butir)
    <tr>
        <td class="service">{{ strtoupper(substr($butir->id, 3)) }}</td>
        <td class="desc">{{ $butir->item_name }}</td>
        <td class="unit">
         @if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif
     </td>
     <td class="qty">
        @if ($get_submission_items->contains('id',$butir->id))
        @foreach ($get_submission_items as $get_submission_item)
        @if ($get_submission_item->id == $butir->id)
        {{ $get_submission_item->times*$get_submission_item->point }}
        @endif
        @endforeach
        @else
        -
        @endif
    </td>
    <td class="qty">jml</td>
    <td class="qty">@if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif</td>
    <td class="qty">
   @if ($get_final_dupak_scores->contains('item_id',$butir->id))
   @foreach ($get_final_dupak_scores as $get_final_dupak_score)
   @if ($get_final_dupak_score->item_id == $butir->id)
   {{ $get_final_dupak_score->times*$get_final_dupak_score->item_score }}
   @endif
   @endforeach
   @else
   -
   @endif
</td>
    <td class="total">jml</td>
</tr>
@endforeach
</tbody>
</table>

<div class="text-title">
    <strong>C . Pemasangan dan Pemeliharaan Sistem Komputer dan Sistem Jaringan Komputer</strong>
</div>
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
    @foreach ($butir_terampil2C as $butir)
    <tr>
        <td class="service">{{ strtoupper(substr($butir->id, 3)) }}</td>
        <td class="desc">{{ $butir->item_name }}</td>
        <td class="unit">
         @if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif
     </td>
     <td class="qty">
        @if ($get_submission_items->contains('id',$butir->id))
        @foreach ($get_submission_items as $get_submission_item)
        @if ($get_submission_item->id == $butir->id)
        {{ $get_submission_item->times*$get_submission_item->point }}
        @endif
        @endforeach
        @else
        -
        @endif
    </td>
    <td class="qty">jml</td>
    <td class="qty">@if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif</td>
    <td class="qty">
   @if ($get_final_dupak_scores->contains('item_id',$butir->id))
   @foreach ($get_final_dupak_scores as $get_final_dupak_score)
   @if ($get_final_dupak_score->item_id == $butir->id)
   {{ $get_final_dupak_score->times*$get_final_dupak_score->item_score }}
   @endif
   @endforeach
   @else
   -
   @endif
</td>
    <td class="total">jml</td>
</tr>
@endforeach
</tbody>
</table>

<div class="text-center">
    <strong>IMPLEMENTASI TEKNOLOGI INFORMASI</strong>
</div>
<div class="text-title">
    <strong>A . Pemrograman Dasar</strong>
</div>
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
    @foreach ($butir_terampil3A as $butir)
    <tr>
        <td class="service">{{ strtoupper(substr($butir->id, 3)) }}</td>
        <td class="desc">{{ $butir->item_name }}</td>
        <td class="unit">
         @if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif
     </td>
     <td class="qty">
        @if ($get_submission_items->contains('id',$butir->id))
        @foreach ($get_submission_items as $get_submission_item)
        @if ($get_submission_item->id == $butir->id)
        {{ $get_submission_item->times*$get_submission_item->point }}
        @endif
        @endforeach
        @else
        -
        @endif
    </td>
    <td class="qty">jml</td>
    <td class="qty">@if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif</td>
    <td class="qty">
   @if ($get_final_dupak_scores->contains('item_id',$butir->id))
   @foreach ($get_final_dupak_scores as $get_final_dupak_score)
   @if ($get_final_dupak_score->item_id == $butir->id)
   {{ $get_final_dupak_score->times*$get_final_dupak_score->item_score }}
   @endif
   @endforeach
   @else
   -
   @endif
</td>
    <td class="total">jml</td>
</tr>
@endforeach
</tbody>
</table>

<div class="text-title">
    <strong>B . Pemrograman Menengah</strong>
</div>
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
    @foreach ($butir_terampil3B as $butir)
    <tr>
        <td class="service">{{ strtoupper(substr($butir->id, 3)) }}</td>
        <td class="desc">{{ $butir->item_name }}</td>
        <td class="unit">
         @if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif
     </td>
     <td class="qty">
        @if ($get_submission_items->contains('id',$butir->id))
        @foreach ($get_submission_items as $get_submission_item)
        @if ($get_submission_item->id == $butir->id)
        {{ $get_submission_item->times*$get_submission_item->point }}
        @endif
        @endforeach
        @else
        -
        @endif
    </td>
    <td class="qty">jml</td>
    <td class="qty">@if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif</td>
    <td class="qty">
   @if ($get_final_dupak_scores->contains('item_id',$butir->id))
   @foreach ($get_final_dupak_scores as $get_final_dupak_score)
   @if ($get_final_dupak_score->item_id == $butir->id)
   {{ $get_final_dupak_score->times*$get_final_dupak_score->item_score }}
   @endif
   @endforeach
   @else
   -
   @endif
</td>
    <td class="total">jml</td>
</tr>
@endforeach
</tbody>
</table>

<div class="text-title">
    <strong>C . Pemrograman Lanjutan</strong>
</div>
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
    @foreach ($butir_terampil3C as $butir)
    <tr>
        <td class="service">{{ strtoupper(substr($butir->id, 3)) }}</td>
        <td class="desc">{{ $butir->item_name }}</td>
        <td class="unit">
         @if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif
     </td>
     <td class="qty">
        @if ($get_submission_items->contains('id',$butir->id))
        @foreach ($get_submission_items as $get_submission_item)
        @if ($get_submission_item->id == $butir->id)
        {{ $get_submission_item->times*$get_submission_item->point }}
        @endif
        @endforeach
        @else
        -
        @endif
    </td>
    <td class="qty">jml</td>
    <td class="qty">@if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif</td>
    <td class="qty">
   @if ($get_final_dupak_scores->contains('item_id',$butir->id))
   @foreach ($get_final_dupak_scores as $get_final_dupak_score)
   @if ($get_final_dupak_score->item_id == $butir->id)
   {{ $get_final_dupak_score->times*$get_final_dupak_score->item_score }}
   @endif
   @endforeach
   @else
   -
   @endif
</td>
    <td class="total">jml</td>
</tr>
@endforeach
</tbody>
</table>

<div class="text-title">
    <strong>D . Penerapan Sistem Komputer</strong>
</div>
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
    @foreach ($butir_terampil3D as $butir)
    <tr>
        <td class="service">{{ strtoupper(substr($butir->id, 3)) }}</td>
        <td class="desc">{{ $butir->item_name }}</td>
        <td class="unit">
         @if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif
     </td>
     <td class="qty">
        @if ($get_submission_items->contains('id',$butir->id))
        @foreach ($get_submission_items as $get_submission_item)
        @if ($get_submission_item->id == $butir->id)
        {{ $get_submission_item->times*$get_submission_item->point }}
        @endif
        @endforeach
        @else
        -
        @endif
    </td>
    <td class="qty">jml</td>
    <td class="qty">@if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif</td>
    <td class="qty">
   @if ($get_final_dupak_scores->contains('item_id',$butir->id))
   @foreach ($get_final_dupak_scores as $get_final_dupak_score)
   @if ($get_final_dupak_score->item_id == $butir->id)
   {{ $get_final_dupak_score->times*$get_final_dupak_score->item_score }}
   @endif
   @endforeach
   @else
   -
   @endif
</td>
    <td class="total">jml</td>
</tr>
@endforeach
</tbody>
</table>

<div class="text-center">
    <strong>PENGEMBANGAN PROFESI</strong>
</div>
<div class="text-title">
    <strong>A . Pembuatan Karya Tulis / Karya Ilmiah dibidang Teknologi Informasi</strong>
</div>
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
    @foreach ($butir_terampil4A as $butir)
    <tr>
        <td class="service">{{ strtoupper(substr($butir->id, 3)) }}</td>
        <td class="desc">{{ $butir->item_name }}</td>
        <td class="unit">
         @if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif
     </td>
     <td class="qty">
        @if ($get_submission_items->contains('id',$butir->id))
        @foreach ($get_submission_items as $get_submission_item)
        @if ($get_submission_item->id == $butir->id)
        {{ $get_submission_item->times*$get_submission_item->point }}
        @endif
        @endforeach
        @else
        -
        @endif
    </td>
    <td class="qty">jml</td>
    <td class="qty">@if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif</td>
    <td class="qty">
   @if ($get_final_dupak_scores->contains('item_id',$butir->id))
   @foreach ($get_final_dupak_scores as $get_final_dupak_score)
   @if ($get_final_dupak_score->item_id == $butir->id)
   {{ $get_final_dupak_score->times*$get_final_dupak_score->item_score }}
   @endif
   @endforeach
   @else
   -
   @endif
</td>
    <td class="total">jml</td>
</tr>
@endforeach
</tbody>
</table>

<div class="text-title">
    <strong>B . Penyusunan Petunjuk Teknis Pelaksanaan Pengelolaan Kegiatan Teknologi Informasi</strong>
</div>
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
    @foreach ($butir_terampil4B as $butir)
    <tr>
        <td class="service">{{ strtoupper(substr($butir->id, 3)) }}</td>
        <td class="desc">{{ $butir->item_name }}</td>
        <td class="unit">
         @if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif
     </td>
     <td class="qty">
        @if ($get_submission_items->contains('id',$butir->id))
        @foreach ($get_submission_items as $get_submission_item)
        @if ($get_submission_item->id == $butir->id)
        {{ $get_submission_item->times*$get_submission_item->point }}
        @endif
        @endforeach
        @else
        -
        @endif
    </td>
    <td class="qty">jml</td>
    <td class="qty">@if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif</td>
    <td class="qty">
   @if ($get_final_dupak_scores->contains('item_id',$butir->id))
   @foreach ($get_final_dupak_scores as $get_final_dupak_score)
   @if ($get_final_dupak_score->item_id == $butir->id)
   {{ $get_final_dupak_score->times*$get_final_dupak_score->item_score }}
   @endif
   @endforeach
   @else
   -
   @endif
</td>
    <td class="total">jml</td>
</tr>
@endforeach
</tbody>
</table>

<div class="text-title">
    <strong>C . Penerjemahan / Penyaduran Buku dan Bahan-Bahan Lain di Bidang Kegiatan Teknologi Informasi</strong>
</div>
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
    @foreach ($butir_terampil4C as $butir)
    <tr>
        <td class="service">{{ strtoupper(substr($butir->id, 3)) }}</td>
        <td class="desc">{{ $butir->item_name }}</td>
        <td class="unit">
         @if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif
     </td>
     <td class="qty">
        @if ($get_submission_items->contains('id',$butir->id))
        @foreach ($get_submission_items as $get_submission_item)
        @if ($get_submission_item->id == $butir->id)
        {{ $get_submission_item->times*$get_submission_item->point }}
        @endif
        @endforeach
        @else
        -
        @endif
    </td>
    <td class="qty">jml</td>
    <td class="qty">@if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif</td>
    <td class="qty">
   @if ($get_final_dupak_scores->contains('item_id',$butir->id))
   @foreach ($get_final_dupak_scores as $get_final_dupak_score)
   @if ($get_final_dupak_score->item_id == $butir->id)
   {{ $get_final_dupak_score->times*$get_final_dupak_score->item_score }}
   @endif
   @endforeach
   @else
   -
   @endif
</td>
    <td class="total">jml</td>
</tr>
@endforeach
</tbody>
</table>


<div class="text-center">
    <strong>PENDUKUNG KEGIATAN PRANATA KOMPUTER</strong>
</div>
<div class="text-title">
    <strong>A . Mengajar atau Melatih dibidang Teknologi Informasi</strong>
</div>
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
    @foreach ($butir_terampil5A as $butir)
    <tr>
        <td class="service">{{ strtoupper(substr($butir->id, 3)) }}</td>
        <td class="desc">{{ $butir->item_name }}</td>
        <td class="unit">
         @if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif
     </td>
     <td class="qty">
        @if ($get_submission_items->contains('id',$butir->id))
        @foreach ($get_submission_items as $get_submission_item)
        @if ($get_submission_item->id == $butir->id)
        {{ $get_submission_item->times*$get_submission_item->point }}
        @endif
        @endforeach
        @else
        -
        @endif
    </td>
    <td class="qty">jml</td>
    <td class="qty">@if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif</td>
    <td class="qty">
   @if ($get_final_dupak_scores->contains('item_id',$butir->id))
   @foreach ($get_final_dupak_scores as $get_final_dupak_score)
   @if ($get_final_dupak_score->item_id == $butir->id)
   {{ $get_final_dupak_score->times*$get_final_dupak_score->item_score }}
   @endif
   @endforeach
   @else
   -
   @endif
</td>
    <td class="total">jml</td>
</tr>
@endforeach
</tbody>
</table>


<div class="text-title">
    <strong>B . Peran serta dalam Seminar / Lokakarya / Konferensi</strong>
</div>
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
    @foreach ($butir_terampil5B as $butir)
    <tr>
        <td class="service">{{ strtoupper(substr($butir->id, 3)) }}</td>
        <td class="desc">{{ $butir->item_name }}</td>
        <td class="unit">
         @if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif
     </td>
     <td class="qty">
        @if ($get_submission_items->contains('id',$butir->id))
        @foreach ($get_submission_items as $get_submission_item)
        @if ($get_submission_item->id == $butir->id)
        {{ $get_submission_item->times*$get_submission_item->point }}
        @endif
        @endforeach
        @else
        -
        @endif
    </td>
    <td class="qty">jml</td>
    <td class="qty">@if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif</td>
    <td class="qty">
   @if ($get_final_dupak_scores->contains('item_id',$butir->id))
   @foreach ($get_final_dupak_scores as $get_final_dupak_score)
   @if ($get_final_dupak_score->item_id == $butir->id)
   {{ $get_final_dupak_score->times*$get_final_dupak_score->item_score }}
   @endif
   @endforeach
   @else
   -
   @endif
</td>
    <td class="total">jml</td>
</tr>
@endforeach
</tbody>
</table>

<div class="text-title">
    <strong>C . Keanggotaan dalam Tim Penilai JFPK</strong>
</div>
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
    @foreach ($butir_terampil5C as $butir)
    <tr>
        <td class="service">{{ strtoupper(substr($butir->id, 3)) }}</td>
        <td class="desc">{{ $butir->item_name }}</td>
        <td class="unit">
         @if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif
     </td>
     <td class="qty">
        @if ($get_submission_items->contains('id',$butir->id))
        @foreach ($get_submission_items as $get_submission_item)
        @if ($get_submission_item->id == $butir->id)
        {{ $get_submission_item->times*$get_submission_item->point }}
        @endif
        @endforeach
        @else
        -
        @endif
    </td>
    <td class="qty">jml</td>
    <td class="qty">@if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif</td>
    <td class="qty">
   @if ($get_final_dupak_scores->contains('item_id',$butir->id))
   @foreach ($get_final_dupak_scores as $get_final_dupak_score)
   @if ($get_final_dupak_score->item_id == $butir->id)
   {{ $get_final_dupak_score->times*$get_final_dupak_score->item_score }}
   @endif
   @endforeach
   @else
   -
   @endif
</td>
    <td class="total">jml</td>
</tr>
@endforeach
</tbody>
</table>


<div class="text-title">
    <strong>D . Keanggotaan dalam Organisasi Profesi</strong>
</div>
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
    @foreach ($butir_terampil5D as $butir)
    <tr>
        <td class="service">{{ strtoupper(substr($butir->id, 3)) }}</td>
        <td class="desc">{{ $butir->item_name }}</td>
        <td class="unit">
         @if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif
     </td>
     <td class="qty">
        @if ($get_submission_items->contains('id',$butir->id))
        @foreach ($get_submission_items as $get_submission_item)
        @if ($get_submission_item->id == $butir->id)
        {{ $get_submission_item->times*$get_submission_item->point }}
        @endif
        @endforeach
        @else
        -
        @endif
    </td>
    <td class="qty">jml</td>
    <td class="qty">@if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif</td>
    <td class="qty">
   @if ($get_final_dupak_scores->contains('item_id',$butir->id))
   @foreach ($get_final_dupak_scores as $get_final_dupak_score)
   @if ($get_final_dupak_score->item_id == $butir->id)
   {{ $get_final_dupak_score->times*$get_final_dupak_score->item_score }}
   @endif
   @endforeach
   @else
   -
   @endif
</td>
    <td class="total">jml</td>
</tr>
@endforeach
</tbody>
</table>

<div class="text-title">
    <strong>E . Perolehan Piagam Kehormatan</strong>
</div>
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
    @foreach ($butir_terampil5E as $butir)
    <tr>
        <td class="service">{{ strtoupper(substr($butir->id, 3)) }}</td>
        <td class="desc">{{ $butir->item_name }}</td>
        <td class="unit">
         @if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif
     </td>
     <td class="qty">
        @if ($get_submission_items->contains('id',$butir->id))
        @foreach ($get_submission_items as $get_submission_item)
        @if ($get_submission_item->id == $butir->id)
        {{ $get_submission_item->times*$get_submission_item->point }}
        @endif
        @endforeach
        @else
        -
        @endif
    </td>
    <td class="qty">jml</td>
    <td class="qty">@if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif</td>
    <td class="qty">
   @if ($get_final_dupak_scores->contains('item_id',$butir->id))
   @foreach ($get_final_dupak_scores as $get_final_dupak_score)
   @if ($get_final_dupak_score->item_id == $butir->id)
   {{ $get_final_dupak_score->times*$get_final_dupak_score->item_score }}
   @endif
   @endforeach
   @else
   -
   @endif
</td>
    <td class="total">jml</td>
</tr>
@endforeach
</tbody>
</table>


<div class="text-title">
    <strong>F . Perolehan Gelar Kesarjanaan lainnya</strong>
</div>
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
    @foreach ($butir_terampil5F as $butir)
    <tr>
        <td class="service">{{ strtoupper(substr($butir->id, 3)) }}</td>
        <td class="desc">{{ $butir->item_name }}</td>
        <td class="unit">
         @if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif
     </td>
     <td class="qty">
        @if ($get_submission_items->contains('id',$butir->id))
        @foreach ($get_submission_items as $get_submission_item)
        @if ($get_submission_item->id == $butir->id)
        {{ $get_submission_item->times*$get_submission_item->point }}
        @endif
        @endforeach
        @else
        -
        @endif
    </td>
    <td class="qty">jml</td>
    <td class="qty">@if ($this_submission->previous_id == $this_submission->nip)
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score }}
            @endif
            @endforeach
            @else
            -
            @endif
        @else
            @if ($get_final_previous_scores->contains('item_id',$butir->id))
            @foreach ($get_final_previous_scores as $get_final_previous_score)
            @if ($get_final_previous_score->item_id == $butir->id)
            {{ $get_final_previous_score->item_score*$get_final_previous_score->times }}
            @endif
            @endforeach
            @else
            -
            @endif
        @endif</td>
    <td class="qty">
   @if ($get_final_dupak_scores->contains('item_id',$butir->id))
   @foreach ($get_final_dupak_scores as $get_final_dupak_score)
   @if ($get_final_dupak_score->item_id == $butir->id)
   {{ $get_final_dupak_score->times*$get_final_dupak_score->item_score }}
   @endif
   @endforeach
   @else
   -
   @endif
</td>
    <td class="total">jml</td>
</tr>
@endforeach
</tbody>
</table>

</body>
</html>