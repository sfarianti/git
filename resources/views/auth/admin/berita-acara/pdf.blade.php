<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Berita Acara</title>
</head>
<style>
    .header{
        text-align: center;
    }
    .h3{
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        
    }
    .h2{
        color: #c00000;
        font-size: 20px;
        font-weight: bold;
        text-transform: uppercase;
    }
    .title{
        text-align: center;
        font-weight: bold;
    }
    .content{
        text-align: justify;
    }
    .opening {
        padding-bottom: 28px;
    }
    .kategori p{
        text-align: left;
        font-weight: bold;
    }
    .header, .opening, .kategori{
        padding-left: 32px;
        padding-right: 32px;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    table{
        width: 100%;
    }
    th, td {
        padding: 10px;
    }
    .mb-3{
        margin-bottom: 2rem;
    }
    .ttd{
        text-align: center
    }
    * {
        box-sizing: border-box;
    }
    
    /* Create three equal columns that floats next to each other */
    .column-1 {
        float: left;
        width: 100%;
        height: 175px; /* Should be removed. Only for demonstration */
    }
    .column-2 {
        float: left;
        width: 50%;
        height: 175px; /* Should be removed. Only for demonstration */
    }
    .column-3 {
        float: left;
        width: 33.33%;
        height: 175px; /* Should be removed. Only for demonstration */
    }
    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
    .column-1 p, .column-2 p, .column-3 p, {
        padding-top:80px;
    }
</style>
<body>
    <div class="header">
        <p>
            <span class="h3">BERITA ACARA PENETAPAN JUARA {{$data->jenis_event}}</span><br>
            <span class="H2">{{$data->event_name}}</span><br>
            <span class="h6">Nomor: {{$data->no_surat}}</span>
        </p>
    </div>
    <div class="opening">
        <p class="title">BERDASARKAN</p>
        <span class="content">Pelaksanaan seleksi kompetisi {{$data->jenis_event}} {{$data->event_name}} Tahun {{$data->year}} serta penilaian yang dilakukan melalui On Desk Assessment dan Presentation Assessment yang dimulai pada tanggal {{$carbonInstance_startDate->isoFormat('D MMMM YYYY')}} sampai dengan {{$carbonInstance_endDate->isoFormat('D MMMM YYYY')}}.</span>
        <br>
        <p class="title">MENETAPKAN</p>
        <span class="content">Pada hari ini {{$day}} tanggal {{ $date }} bulan {{$month}} tahun {{$year}} ({{ $carbonInstance->isoFormat('D MMMM YYYY') }}) menetapkan juara di {{$data->event_name}} Tahun {{$data->year}} sebagai berikut :</span>
    
    </div>
    <div class="kategori">
        @foreach($juara as $category => $team )
        
        @if (count($team) > 0)
        <div class="mb-3">
            <p>{{$category}}</p>
            <table>
            <tr>
                <th>No</th>
                <th>Nama Tim</th>
                <th>Judul</th>
                <th>Company</th>
            </tr>
            <?php $no = 1; ?>
            @foreach ($team as $dt)
                <tr>
                    <td>{{$no}}</td>
                    <td>{{$dt['teamname']}}</td>
                    <td>{{$dt['innovation_title']}}</td>
                    <td>{{$dt['company_name']}}</td>
                </tr>
                <?php $no++; ?>
            @endforeach
            </table>
        </div>    
        @endif
        @endforeach
    </div>
    
    <div class="ttd">
        <p>
            Menyetujui, 
            <br>Jakarta, {{ $carbonInstance->isoFormat('D MMMM YYYY') }}
        </p>
        <div class="row">
            <?php 
                if(count($bods) == 4)
                    $column_ke = 2;
                elseif(count($bods) >= 5)
                    $column_ke = 3;
                else
                    $column_ke = count($bods);

                $no = 0;
            ?>
            @foreach($bods as $bod)
                
                @if($no == 5)
                    @break
                @endif
                <div class="column-{{$column_ke}}">
                    <p><b>{{ $bod['name'] }}</b>
                        <br>{{ $bod['position_title'] }}
                    </p>
                </div>
                <?php $no++; ?>
            @endforeach
        </div>
        
    </div>
</body>
</html>