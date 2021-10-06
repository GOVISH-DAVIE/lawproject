<?php

namespace App\Http\Controllers;

use App\Models\Records;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\File;

class RecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $records = Records:: paginate(20);
        return view('records.index')->with('records', $records);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function uploadImages()
    {
        # code...
        $images = array();
        // return 
        // return 22;

        if (isset($_FILES['files'])) {
            if ($_FILES['files']['error'][0] > 0) {
                # code...
                return $_FILES['files']['error'];
            } else {
                foreach ($_FILES['files']['name'] as $file => $value) {

                    Storage::putFileAs('public/', new File($_FILES["files"]["tmp_name"][$file]),  STR::random(10) . time() . '.' . pathinfo($_FILES["files"]["name"][$file], PATHINFO_EXTENSION));
                    array_push($images, STR::random(10) . time() . '.' . pathinfo($_FILES["files"]["name"][$file], PATHINFO_EXTENSION));
                }
                return json_encode($images);
            }
            # code...

        } else {
            return null;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // return $_FILES;
        // return $this->uploadImages();
        $record =    Records::create(
            [
                'title' => $request->title,
                'date' => $request->date,
                'location' => $request->location,
                'amount' => $request->amount,
                'des' => $request->dec,
                'email' => $request->email,
                'tel' => $request->tel,
                'name' => $request->name,
                'docs' => $this->uploadImages(),
                'user_id' => auth()->user()->id,
            
        ]);
        return redirect()->back()->with(['success' => 'Created Succesfully']);;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
