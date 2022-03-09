<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style>
        td {
            border-bottom: 2px dashed rgb(0, 0, 0);
            
        }
       
        .title {
            font-size: 30px;
            font-weight: 700;
        }

    </style>
@php
    date_default_timezone_set('Asia/Tashkent');
    dd(app()->getLocal())
@endphp

    <table>
        <tr>
            <td><b class="title">{{ setting('site.title') }}</b></td>
        </tr>
        <tr>
            <td><b>Номер заявка</b><br>{{ $application->app_number ?? '0' }}</td>
        </tr>
        <tr>
            <td><b>Полное имя водителя</b><br>{{ $application->customer->full_name ?? '' }}</td>
        </tr>
        <tr>
            <td><b>Сумма</b> <br>{{ number_format($application->amount, 0, '', ' ') ?? '0' }} UZS</td>
        </tr>
      
        <tr>
            <td><b>Номер ГОС</b><br>{{ $application->gosNumber->number ?? '' }} </td>
        </tr>
        <tr>
            <td><b>Mарка автомобиль</b><br>{{ $application->carBrand->title ?? '' }}</td>
        </tr>
     
        <tr>
            <td><b>Регион</b><br>{{ $application->customer->region->name_ru ?? '' }}</td>
        </tr>
        <tr>
            <td><b>Район</b><br>{{ $application->customer->district->name_ru ?? '' }}</td>
        </tr>
        <tr>
            <td><b>Статус заявка</b><br>{{ getStatusText($application->status_id ?? '') }}</td>
        </tr>
        <tr>
            <td><b>Дата</b><br>{{date('d-m-Y H:i:s')}}</td>
        </tr>
    </table>
</body>
</html>
    

