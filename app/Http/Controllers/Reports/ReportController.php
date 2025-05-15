<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\products\Furniture;
use App\Models\products\Import;
use App\Models\products\Export;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ReportController extends Controller
{
    public function index()
    {
        $files = collect(File::files(public_path('documents')));

        return view('pages.report', compact('files'));
    }

    public function store(Request $request)
    {
        $filename = '';
        $content = '';

        if ($request->report_type == "furniture") {
            $furnitures = Furniture::all();
            $content = "Furniture Inventory Report\n\n";
            foreach ($furnitures as $furniture) {
                $content .= "Furniture Name: {$furniture->furniture_name}, Owner: {$furniture->furniture_ouner}, Quantity: {$furniture->quantity}\n";
            }
            $filename = 'furniture_report_' . now()->format('Ymd_His') . '.txt';
        } elseif ($request->report_type == "imports") {
            $imports = Import::with('furniture')->get();
            $content = "Furniture Import Report\n\n";
            foreach ($imports as $import) {
                $content .= "Furniture Name: {$import->furniture->furniture_name}, Imported Date: {$import->imported_date}, Quantity: {$import->quantity}\n";
            }
            $filename = 'import_report_' . now()->format('Ymd_His') . '.txt';
        } elseif ($request->report_type == "exports") {
            $exports = Export::with('furniture')->get();
            $content = "Furniture Export Report\n\n";
            foreach ($exports as $export) {
                $content .= "Furniture Name: {$export->furniture->furniture_name}, Exported Date: {$export->exported_date}, Quantity: {$export->quantity}\n";
            }
            $filename = 'export_report_' . now()->format('Ymd_His') . '.txt';
        }

        if (!$filename || !$content) {
            return redirect()->route('reports.index')->with('error', 'Invalid report type or empty content.');
        }

        // Define the documents directory path
        $documentsPath = public_path('documents');

        // Ensure documents directory exists
        if (!File::exists($documentsPath)) {
            File::makeDirectory($documentsPath, 0755, true);
        }

        // Full file path in documents folder
        $path = $documentsPath . '/' . $filename;

        // Save the content to the file
        File::put($path, $content);

        return redirect()->route('reports.index')->with('success', 'Report generated successfully: ' . $filename);
    }

    public function show($report)
    {
        $path = public_path('documents/' . $report);

        if (!File::exists($path)) {
            return redirect()->route('reports.index')->with('error', 'Report file not found.');
        }

        return response()->download($path);
    }

    public function destroy($report)
    {
        $path = public_path('documents/' . $report);

        if (!File::exists($path)) {
            return redirect()->route('reports.index')->with('error', 'Report file not found.');
        }

        File::delete($path);

        return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
    }
}
