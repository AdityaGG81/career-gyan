<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CareerPathController extends Controller
{
    /**
     * Display the specified career path stream.
     *
     * @param  string  $stream
     * @return \Illuminate\View\View
     */
    public function show($stream)
    {
        $careerPaths = config('career_paths');

        if (!array_key_exists($stream, $careerPaths)) {
            return back()->with('error', 'Career path guide for this stream is not available yet.');
        }

        $pathData = $careerPaths[$stream];
        $pathData['slug'] = $stream;

        return view('career-path.show', compact('pathData'));
    }
}
