<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use App\Models\Records;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $record = Records::find($id);
        $record->load('notes');
        return view('notes.index')->with('record', $record);
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

    public function uploadImages()
    {
        # code...
        $images = array();
        // return 
        // return 22;

        if (isset($_FILES['files'])) {
            if ($_FILES['files']['error'][0] > 0) {
                # code...
                return null;
            } else {
                foreach ($_FILES['files']['name'] as $file => $value) {
                    $filename =  $_FILES['files']['name'][$file] . time() . '.' . pathinfo($_FILES["files"]["name"][$file], PATHINFO_EXTENSION);
                    Storage::putFileAs('public/', new File($_FILES["files"]["tmp_name"][$file]), $filename);
                    array_push($images,  $filename);
                }
                return json_encode($images);
            }
            # code...

        } else {
            return null;
        }
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

        // return $_POST;
        if ($request->sms) {
            # code...   
            $S = new  SMSController();
            $S->sendSMS(Records::find($id)->tel,  $request->notes);
            $notes = new Notes();
            $notes->files = $this->uploadImages();
            $notes->records_id = intval($id);
            $notes->text = $request->notes;
            $notes->istexted = $request->sms == null ? 'off' : $request->sms;
            $notes->save();
            return redirect()->back()->with(['success' => 'Note Created Succesfully']);
        } else {
            # code...
            $notes = new Notes();
            $notes->files = $this->uploadImages();
            $notes->records_id = intval($id);
            $notes->text = $request->notes;
            $notes->istexted = $request->sms == null ? 'off' : $request->sms;
            $notes->save();
            return redirect()->back()->with(['success' => 'Created Succesfully']);
        }
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
