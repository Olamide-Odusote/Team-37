<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryLog;

class InventoryLogController extends Controller
{
    public function show($id) {
        $log = InventoryLog::find($id);
        return view('/show', array('log' => $log));
    }

    public function list() {
        return view('/list', array('logs'=>InventoryLog::all()));
    }
}
