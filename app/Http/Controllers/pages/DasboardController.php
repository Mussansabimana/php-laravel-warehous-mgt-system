<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\products\Furniture;
use App\Models\products\Export;
use App\Models\products\Import;
use Carbon\Carbon;

class DasboardController extends Controller
{
    public function index()
    {


        // Furniture count for today where quantity != 0
        $furnitureCount = Furniture::with('imports')
            ->where('quantity', '!=', 0)
            ->whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->count();

        // Import count for today
        $importCount = Import::whereDate('created_at', Carbon::today())->count();

        // Export count for today
        $exportCount = Export::whereDate('created_at', Carbon::today())->count();


        return view('pages.dashboard', compact('furnitureCount', 'importCount', 'exportCount'));
    }
}
