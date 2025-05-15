<?php

namespace App\Http\Controllers\products;

use App\Http\Controllers\Controller;
use App\Models\products\Export;
use App\Models\products\Furniture;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function index()
    {
        $exports = Export::with('furniture')
            ->orderBy('created_at', 'desc')
            ->get();
        return view("pages.exports", compact('exports'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'furniture_id'   => 'required|exists:furnitures,id',
            'exported_date'  => 'required|date',
            'quantity'       => 'required|integer|min:1',
        ]);

        $furniture = Furniture::findOrFail($request->furniture_id);

        if ($request->quantity > $furniture->quantity) {
            return redirect()->back()->with('error', 'Export quantity cannot exceed available stock.');
        }

        $furniture->quantity -= $request->quantity;
        $furniture->save();

        $export = new Export();
        $export->furniture_id  = $validated['furniture_id'];
        $export->exported_date = $validated['exported_date'];
        $export->quantity      = $validated['quantity'];
        $export->save();

        return redirect()->route('furnitures.index')->with('success', 'Furniture exported successfully!');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'exported_date' => 'required|date',
        ]);

        $export = Export::find($id);
        if (!$export) {
            return redirect()->back()->with('error', 'Export record not found.');
        }

        $export->exported_date = $request->exported_date;
        $export->save();

        return redirect()->route('exports.index')->with('success', 'Exported date updated successfully.');
    }

}
