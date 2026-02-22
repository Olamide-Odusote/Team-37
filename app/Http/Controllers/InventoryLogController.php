<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryLog;

class InventoryLogController extends Controller
{
    /**
     * Display the specified inventory log.
     */
    public function show($id) {
        $log = InventoryLog::find($id);
        return view('/show', array('log' => $log));
    }
    /**
     * Display a listing of all inventory logs.
     */
    public function list() {
        return view('/list', array('logs'=>InventoryLog::all()));
    }
}
