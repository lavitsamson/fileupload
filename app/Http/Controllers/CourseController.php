<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\UploadCSVfile;
use App\Models\Course;

class CourseController extends Controller
{
    //
    public function index()
    {
        return view('upload-file', ['message' => ""]);
    }

    public function store()
    {
        if (request()->has('csvfile')) {
            $data = file(request()->csvfile);
        }

        // creating chunks of data
        $chunks = array_chunk($data, 100);
        // $tmppath = resource_path('temp');

        // foreach ($chunks as $key => $file) {
        //     $filename = "/tmp{$key}.csv";
        //     file_put_contents($tmppath . $filename, $file);
        // }
        $msg = "** ";
        foreach ($chunks as $key => $file) {
            $data = array_map('str_getcsv', $file);
            if ($key === 0) {
                $header = $data[0];
                unset($data[0]);
                if (!in_array('id', $header)) {
                    $msg .= "File does not contain 'id' field";
                } elseif (!in_array('course_name', $header)) {
                    $msg .= "File does not contain 'course_name' field";
                } elseif (!in_array('course_code', $header)) {
                    $msg .= "File does not contain 'course_code' field";
                }
                if ($msg != "** ") {
                    return view('upload-file', ['message' => $msg]);
                }
            }
            UploadCSVfile::dispatch($data, $header);
        }
        return view('upload-file', ['message' => "** Data is being Saved!"]);
    }
}