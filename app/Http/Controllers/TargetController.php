<?php

namespace App\Http\Controllers;

use App\Models\Target;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Evidence;
use Barryvdh\DomPDF\Facade\Pdf;
use setasign\Fpdi\Fpdi;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class TargetController extends Controller
{
    public function index()
    {
        $targets = Target::latest()->get();
        return view('targets.index', compact('targets'));
    }

    public function create()
    {
        return view('targets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string||max:255',
            'email' => 'nullable|email',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'evidences.*' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:5120',
        ]);

        $target = Target::create($request->only(['name', 'username', 'email']));


        if ($request->hasFile('evidences')) {
            foreach ($request->file('evidences') as $file) {
                $path = $file->store('evidences', 'public');


                $target->evidences()->create([
                    'file_path' => $path,
                    'file_type' => $file->getClientOriginalExtension(),
                    'original_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()->route('targets.index')->with('success', 'New Target & Evidence Vault created!');
    }

    public function show(Target $target)
    {
        return view('targets.show', compact('target'));
    }

    public function edit(Target $target)
    {
        return view('targets.edit', compact('target'));
    }

    public function update(Request $request, Target $target)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'status' => 'required|in:pending,active,closed',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'evidences.*' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:5120',
        ]);

        $target->update($request->only(['name', 'username', 'email', 'status']));


        if ($request->hasFile('evidences')) {


            foreach ($request->file('evidences') as $file) {


                $path = $file->store('evidences', 'public');


                $target->evidences()->create([
                    'file_path' => $path,
                    'file_type' => $file->getClientOriginalExtension(),
                    'original_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()->route('targets.show', $target->id)->with('success', 'Evidence Vault updated!');
    }

    public function destroy(Target $target)
    {
        $target->delete();
        return redirect()->route('targets.index')->with('success', 'Target erased from records.');
    }

    public function destroyEvidence(Evidence $evidence)
    {

        if (Storage::disk('public')->exists($evidence->file_path)) {
            Storage::disk('public')->delete($evidence->file_path);
        }


        $evidence->delete();

        return back()->with('success', 'Evidence removed from vault.');
    }

    public function generateReport(Target $target)
    {
        $target->load(['activities', 'evidences']);


        $imageData = null;
        if ($target->image && Storage::disk('public')->exists($target->image)) {
            $path = public_path('storage/' . $target->image);
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $imageData = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }


        $qrCode = base64_encode(
            QrCode::format('svg')
                ->size(100)
                ->errorCorrection('H')
                ->generate(route('targets.show', $target->id))
        );


        $htmlPdf = Pdf::loadView('targets.report', compact('target', 'imageData', 'qrCode'))->output();
        $tempPath = storage_path('app/public/temp_report.pdf');
        file_put_contents($tempPath, $htmlPdf);


        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($tempPath);
        for ($i = 1; $i <= $pageCount; $i++) {
            $tplId = $pdf->importPage($i);
            $pdf->addPage();
            $pdf->useTemplate($tplId);
        }

        $evidencePdfs = $target->evidences()->where('file_type', 'pdf')->get();
        foreach ($evidencePdfs as $evidence) {
            $filePath = storage_path('app/public/' . $evidence->file_path);
            if (file_exists($filePath)) {
                $ePageCount = $pdf->setSourceFile($filePath);
                for ($j = 1; $j <= $ePageCount; $j++) {
                    $eTplId = $pdf->importPage($j);
                    $pdf->addPage();
                    $pdf->useTemplate($eTplId);
                }
            }
        }


        if (file_exists($tempPath)) {
            unlink($tempPath);
        }

        return response($pdf->Output('S'), 200)
            ->header('Content-Type', 'application/pdf');
    }

    public function generateMasterReport()
    {
        $targets = Target::with(['activities', 'evidences'])->where('status', 'active')->get();
        $stats = [
            'total_targets' => $targets->count(),
            'total_evidence' => \App\Models\Evidence::count(),
            'generated_by' => 'D. Tharidu (Lead Engineer)',
            'timestamp' => now()->format('Y-m-d H:i:s')
        ];

        $data = [
            'targets' => $targets,
            'stats' => $stats,
            'report_id' => 'STX-GLOBAL-' . time()
        ];

        $pdf = Pdf::loadView('global_advanced_report', $data);

        return $pdf->stream("SentinX_Global_Advanced_Report.pdf");
    }
}
