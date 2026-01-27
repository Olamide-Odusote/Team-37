<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    /**
     * Display the specified feedback.
     */
    public function show($id) {
        $feedback = Feedback::find($id);
        return view('/show', array('feedback' => $feedback));
    }
    /**
     * Display a listing of all feedbacks.
     */
    public function list() {
        return view('/list', array('feedbacks'=>Feedback::all()));
    }
}
