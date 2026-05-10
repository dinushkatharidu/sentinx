<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Master Dossier - {{ $target->name }}</title>
    <style>
        @page { margin: 40px; }
        body { font-family: 'Courier', 'Courier New', monospace; color: #1a1a1a; line-height: 1.4; }
        .watermark { position: absolute; top: 40%; left: 10%; font-size: 80px; color: rgba(200, 0, 0, 0.1); transform: rotate(-45deg); z-index: -1; }
        .header { border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .confidential { color: #d32f2f; font-weight: bold; text-transform: uppercase; border: 2px solid #d32f2f; display: inline-block; padding: 5px 15px; margin-bottom: 10px; }
        .profile-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .target-image { width: 160px; height: 160px; border: 4px solid #333; object-fit: cover; }
        .section-title { background: #1a365d; color: #fff; padding: 5px 10px; text-transform: uppercase; font-size: 14px; margin-top: 20px; }
        .log-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .log-table td { padding: 8px; border-bottom: 1px solid #ddd; font-size: 12px; }
        .evidence-list { font-size: 11px; color: #555; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: right; font-size: 9px; color: #888; border-top: 1px solid #ccc; padding-top: 5px; }
    </style>
</head>
<body>
    <div class="watermark">CLASSIFIED</div>

    <div class="header">
        <div class="confidential">Top Secret // Intelligence Dossier</div>
        <table width="100%">
            <tr>
                <td style="font-size: 24px; font-weight: bold;">SENTINX INTELLIGENCE SYSTEM</td>
                <td align="right" style="font-size: 10px;">REF: {{ $report_ref }}<br>GEN: {{ $generated_at }}</td>
            </tr>
        </table>
    </div>

    <table class="profile-table">
        <tr>
            <td width="30%">
                @if($target->image)
                    <img src="{{ public_path('storage/' . $target->image) }}" class="target-image">
                @else
                    <div style="width:160px; height:160px; background:#eee; text-align:center; line-height:160px; color:#aaa; border:1px solid #ccc;">NO PHOTO</div>
                @endif
            </td>
            <td width="70%" style="vertical-align: top; padding-left: 20px;">
                <h2 style="margin: 0; text-transform: uppercase;">{{ $target->name }}</h2>
                <p><strong>ALIAS:</strong> {{ $target->username ?? 'N/A' }}</p>
                <p><strong>STATUS:</strong> {{ strtoupper($target->status) }}</p>
                <p><strong>PRIMARY EMAIL:</strong> {{ $target->email ?? 'UNKNOWN' }}</p>
                <p><strong>RECORDS START:</strong> {{ $target->created_at->format('Y-m-d') }}</p>
            </td>
        </tr>
    </table>

    <div class="section-title">Field Investigation Logs</div>
    <table class="log-table">
        @forelse($target->activities->reverse() as $activity)
            <tr>
                <td width="25%"><strong>[{{ $activity->created_at->format('Y-m-d H:i') }}]</strong></td>
                <td>{{ $activity->note }}</td>
            </tr>
        @empty
            <tr><td colspan="2">No intelligence gathered in field logs.</td></tr>
        @endforelse
    </table>

    <div class="section-title">Verified Evidence Vault</div>
    <div class="evidence-list">
        <ul style="list-style-type: square; margin-top: 10px;">
            @forelse($target->evidences as $evidence)
                <li>{{ $evidence->original_name }} (Type: {{ strtoupper($evidence->file_type) }} | Hash: {{ substr(md5($evidence->id), 0, 10) }})</li>
            @empty
                <li>No digital evidence secured in the vault.</li>
            @endforelse
        </ul>
    </div>

    <div class="footer">
        Property of SentinX Intelligence | Authorization: LEAD_ENG_THARIDU | Page 1 of 1
    </div>
</body>
</html>
