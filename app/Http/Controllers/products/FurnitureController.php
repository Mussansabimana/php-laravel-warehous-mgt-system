<?php

namespace App\Http\Controllers\products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\products\Furniture;

class FurnitureController extends Controller
{
    public function index()
    {
        $model = new Furniture();
        $furnitures = Furniture::with('imports')
            ->where('quantity', '!=', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.furnitures', compact('furnitures'));
    }
    public function create()
    {
        $s = "a";
        return view("pages.addFurniture", compact('s'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "name" => "required|string",
            "owner" => "required|string",
            "quantity" => "required|integer|min:1"
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imgName = $request->name . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imgName);
        } else {
            $imgName = null;
        };

        // Save furniture
        $furniture = new Furniture();
        $furniture->furniture_ouner = $request->owner;
        $furniture->furniture_image = $imgName;
        $furniture->furniture_name = $request->name;
        $furniture->quantity = $request->quantity;
        $furniture->save();

        return redirect('furnitures');
    }


    public function edit(string $id)
    {
        $model = new Furniture();
        $furniture = $model->find($id);
        $s = "u";

        return view("pages.addFurniture", compact('furniture', 's'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            "image"    => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "name"     => "required|string",
            "owner"    => "required|string",
            "quantity" => "required|integer|min:1"
        ]);

        $furniture = Furniture::findOrFail($id);

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $image   = $request->file('image');

            // Delete old image if exists
            if ($furniture->furniture_image && file_exists(public_path('images/' . $furniture->furniture_image))) {
                unlink(public_path('images/' . $furniture->furniture_image));
            }

            $imgName = $request->name . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imgName);

            $furniture->furniture_image = $imgName;
        }

        // Update Furniture Fields
        $furniture->furniture_name  = $request->name;
        $furniture->furniture_ouner = $request->owner;
        $furniture->quantity        = $request->quantity;
        $furniture->save();

        // Check for existing Import record
        $import = \App\Models\products\Import::where('furniture_id', $furniture->id)->first();

        if ($import) {
            // Update existing import
            $import->imported_date = now();
            $import->quantity      = $furniture->quantity;
            $import->save();
        } else {
            // Create new import
            $import = new \App\Models\products\Import();
            $import->furniture_id  = $furniture->id;
            $import->imported_date = now();
            $import->quantity      = $furniture->quantity;
            $import->save();
        }

        return redirect()->route('furnitures.index')->with('success', 'Furniture updated successfully.');
    }


    public function destroy(string $id)
    {
        $model = new Furniture();
        $furniture = $model->find($id);

        if ($furniture) {
            // Delete all imports associated with this furniture
            $furniture->imports()->delete();  // Assuming the 'imports' relationship is set correctly in the Furniture model

            // Check if the furniture has an image and delete it
            if ($furniture->furniture_image) {
                $imagePath = public_path('images/' . $furniture->furniture_image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);  // Delete the image from the server
                }
            }

            $furniture->delete();
        }

        return redirect('furnitures');
    }
}
