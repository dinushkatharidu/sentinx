<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Intelligence Report #{{ $target->id }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; line-height: 1.6; }
        .header { text-align: center; border-bottom: 2px solid #333; margin-bottom: 20px; }
        .target-info { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .target-info th, .target-info td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .target-info th { background-color: #f2f2f2; font-weight: bold; width: 30%; }
        .log-section { margin-top: 30px; }
        .log-table { width: 100%; border-collapse: collapse; }
        .log-table th, .log-table td { border-bottom: 1px solid #eee; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0; color: #1a365d;">SENTINX INTELLIGENCE DOSSIER</h1>
        <p style="margin: 5px 0;">CONFIDENTIAL DOCUMENT | CASE ID: #SX-00{{ $target->id }}</p>
    </div>

    <table class="target-info">
        <tr><th>SUBJECT NAME</th><td>{{ $target->name }}</td></tr>
        <tr><th>IDENTIFIER</th><td>{{ $target->username ?? 'NONE' }}</td></tr>
        <tr><th>EMAIL ADDRESS</th><td>{{ $target->email }}</td></tr>
        <tr><th>CURRENT STATUS</th><td>{{ strtoupper($target->status) }}</td></tr>
    </table>

    <div class="log-section">
        <h3 style="border-left: 5px solid #1a365d; padding-left: 10px;">INVESTIGATION LOGS</h3>
        <table class="log-table">
            <thead>
                <tr><th style="width: 25%">TIMESTAMP</th><th>FINDINGS</th></tr>
            </thead>
            <tbody>
                @foreach($target->activities->reverse() as $activity)
                <tr>
                    <td>{{ $activity->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $activity->note }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 50px; text-align: right; font-size: 10px; color: #777;">
        System Timestamp: {{ now()->toDateTimeString() }}
    </div>
</body>
</html>
