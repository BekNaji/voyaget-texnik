<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $application->app_number }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" >
    <style>
        @media print {
            @page {
                size: 297mm x 420mm;
            }
        }

    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
            {{setting('site.title');}}
        </div>
        <div class="card-body">
            <h1>{{ $application->gosNumber->number ?? '' }}</h1>
        </div>
        <table class="table table-stripped">
            <tbody>
                <tr>
                    <th>Ariza raqami</th>
                    <td>{{ number_format($application->amount,0,'',' ') ?? '0' }} UZS</td>
                </tr>
                <tr>
                    <th>Miqdor</th>
                    <td>{{ number_format($application->amount,0,'',' ') ?? '0' }} UZS</td>
                </tr>
                <tr>
                    <th>GOS raqami</th>
                    <td>{{ $application->gosNumber->number ?? '' }}</td>
                </tr>
                <tr>
                    <th>Avtomobil markasi</th>
                    <td>{{ $application->carBrand->title ?? '' }}</td>
                </tr>
    
                <tr>
                    <th>Haydovchining to'liq ismi</th>
                    <td>{{ $application->customer->full_name ?? '' }}</td>
                </tr>
                <tr>
                    <th>Viloyat</th>
                    <td>{{ $application->customer->region->name_uz ?? '' }}</td>
                </tr>
                <tr>
                    <th>Tuman</th>
                    <td>{{ $application->customer->district->name_uz ?? '' }}</td>
                </tr>
    
                <tr>
                    <th>Ariza holati</th>
                    <td>{{ getStatusText($application->status_id ?? '') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
   <script> 
window.print();
</script>
</body>

</html>
