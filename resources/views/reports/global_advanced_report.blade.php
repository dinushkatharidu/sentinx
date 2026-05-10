<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Courier', monospace; font-size: 11px; color: #1a202c; }
        .page-header { border-bottom: 3px solid #1a365d; padding-bottom: 10px; margin-bottom: 20px; }
        .confidential-tag { color: #e53e3e; font-weight: bold; border: 1px solid #e53e3e; padding: 2px 8px; float: right; }
        .stats-grid { width: 100%; margin-bottom: 30px; background: #f7fafc; padding: 15px; border: 1px solid #edf2f7; }
        .target-block { margin-bottom: 40px; border: 1px solid #e2e8f0; padding: 15px; page-break-inside: avoid; }
        .target-header { background: #2d3748; color: white; padding: 8px; font-weight: bold; margin-bottom: 10px; }
        .evidence-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .evidence-table th { background: #edf2f7; text-align: left; padding: 5px; font-size: 9px; }
        .evidence-table td { border-bottom: 1px solid #edf2f7; padding: 5px; font-size: 9px; }
        .footer { position: fixed; bottom: 0; width: 100%; font-size: 8px; text-align: center; color: #718096; }
    </style>
</head>
<body>
    <div class="page-header">
        <span class="confidential-tag">SECRET // ORCON</span>
        <h1 style="margin:0;">SENTINX GLOBAL ASSET INVENTORY</h1>
        <p style="margin:5px 0; color:#4a5568;">Comprehensive Intelligence & Evidence Matrix</p>
    </div>

    <div class="stats-grid">
        <table width="100%">
            <tr>
                <td><strong>REPORT ID:</strong> {{ $report_id }}</td>
                <td><strong>TOTAL ASSETS:</strong> {{ $stats['total_targets'] }} Targets</td>
                <td><strong>TOTAL EVIDENCE:</strong> {{ $stats['total_evidence'] }} Records</td>
            </tr>
            <tr>
                <td><strong>GENERATED:</strong> {{ $stats['timestamp'] }}</td>
                <td colspan="2"><strong>AUTHORIZATION:</strong> SYSTEM_ROOT_THARIDU</td>
            </tr>
        </table>
    </div>

    @foreach($targets as $target)
    <div class="target-block">
        <div class="target-header">
            SUBJECT: {{ strtoupper($target->name) }} | ID: #SX-00{{ $target->id }} | CASE_REF: {{ $target->case_id ?? 'N/A' }}
        </div>

        <p><strong>CURRENT INTEL SUMMARY:</strong> {{ $target->notes ?? 'No profile notes available.' }}</p>

        <h4 style="margin: 10px 0 5px 0; color: #2b6cb0;">SECURED EVIDENCE VAULT</h4>
        <table class="evidence-table">
            <thead>
                <tr>
                    <th width="40%">FILENAME</th>
                    <th width="20%">TYPE</th>
                    <th width="20%">HASH_REF</th>
                    <th width="20%">UPLOADED</th>
                </tr>
            </thead>
            <tbody>
                @forelse($target->evidences as $evidence)
                <tr>
                    <td>{{ $evidence->original_name }}</td>
                    <td>{{ strtoupper($evidence->file_type) }}</td>
                    <td>{{ substr(md5($evidence->id), 0, 8) }}</td>
                    <td>{{ $evidence->created_at->format('Y-m-d') }}</td>
                </tr>
                @empty
                <tr><td colspan="4" style="color:#a0aec0; font-style:italic;">No digital assets secured for this subject.</td></tr>
                @endforelse
            </tbody>
        </table>

        <h4 style="margin: 15px 0 5px 0; color: #c05621;">LATEST FIELD LOGS</h4>
        <div style="background: #fffaf0; padding: 8px; border: 1px solid #feebc8;">
            @forelse($target->activities->take(3) as $activity)
                <p style="margin: 3px 0; font-size: 9px;">• [{{ $activity->created_at->format('H:i') }}] {{ $activity->note }}</p>
            @empty
                <p style="margin: 3px 0; font-size: 9px; color: #a0aec0;">Waiting for field intelligence reports...</p>
            @endforelse
        </div>
    </div>
    @endforeach

    <div class="footer">
        SentinX Internal Secure Document | Lead Software Engineer: Adassuriyage Dinushka Tharidu | End of Report
    </div>
</body>
</html>
