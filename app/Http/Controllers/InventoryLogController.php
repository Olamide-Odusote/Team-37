<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryLog;

class InventoryLogController extends Controller
{
    public function index()
    {
        $logs = InventoryLog::latest()->get();
        return view('admin.inventory-logs.index', compact('logs'));
    }

    public function show($id)
    {
        $log = InventoryLog::findOrFail($id);
        return view('admin.inventory-logs.show', compact('log'));
    }
}