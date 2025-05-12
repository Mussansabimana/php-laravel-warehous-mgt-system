<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\products\Furniture;
use App\Models\products\Export;
use App\Models\products\Import;

class DasboardController extends Controller
{
    public function index()
    {
        $furnitureCount = Furniture::count();
        $importCount = Import::count();
        $exportCount = Export::count();

        return view('pages.dashboard', compact('furnitureCount', 'importCount', 'exportCount'));
    }
}

