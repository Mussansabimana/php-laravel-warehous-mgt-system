<?php

namespace App\Http\Controllers\products;

use App\Http\Controllers\Controller;
use App\Models\products\Import;
use App\Models\products\Furniture;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index()
    {
        $imports = Import::with('furniture')
            ->orderBy('created_at', 'desc')
            ->get();
        return view("pages.imports", compact('imports'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'furniture_id'  => 'required|exists:furnitures,id',
            'imported_date' => 'required|date',
        ]);

        $furniture = Furniture::findOrFail($validated['furniture_id']);

        $import = new Import();
        $import->furniture_id  = $validated['furniture_id'];
        $import->imported_date = $validated['imported_date'];
        $import->quantity      = $furniture->quantity;  // take current stock quantity
        $import->save();

        return redirect()->route('furnitures.index')->with('success', 'Furniture imported successfully!');
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'imported_date' => 'required|date',
        ]);

        $import = Import::find($id);

        if (!$import) {
            return redirect()->back()->with('error', 'Import record not found.');
        }

        $import->imported_date = $request->imported_date;
        $import->save();

        return redirect()->route('imports.index')->with('success', 'Imported date updated successfully.');
    }
}
