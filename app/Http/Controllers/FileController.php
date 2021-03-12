<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Rules\UplinkFileRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FileController extends Controller
{
    const MODEL_NAME = "file";
    const SUCCESS = "success";

    public function index()
    {
        $userFiles = Auth::user()->files()->get();
        return view( self::MODEL_NAME . ".index", compact("userFiles"));
    }

    public function create()
    {
        return view( self::MODEL_NAME . ".create");
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return $this->redirectToPreviousPage($validator);
        }

        $this->saveFile($request);

        return redirect()->route("files")->with('status', "File created successfully.");
    }

    private function saveFile($request)
    {
        $file = $request->file("file");

        $savedFile = $file->store('', ['disk' => 'public_uploads']);

        $fileToBeSaved = new File();
        $fileToBeSaved->setNewData($file->getClientOriginalName(), $savedFile);
        $fileToBeSaved->save();
    }

    private function redirectToPreviousPage($validator){
        return back()
            ->withErrors($validator)
            ->withInput();
    }

    protected function validator(array $data)
    {
        $attributeNames = array(
            'file' => "File",
        );

        $validator = Validator::make($data, [
            'file' => ["required", "file", "max:10000", new UplinkFileRule()]
        ]);

        $validator->setAttributeNames($attributeNames);

        return $validator;
    }

    public function show(Request $request, $code)
    {
        $currentFile = File::findByCode($code)->first();
        return view( self::MODEL_NAME . ".detail", compact("currentFile"));
    }

    public function delete(Request $request)
    {
        $responseAttributes = [
            self::SUCCESS => true
        ];

        $fileId = $request->post("fileId");
        $file = File::find($fileId);

        if( $file->user_id != Auth::user()->id ){
            $responseAttributes[self::SUCCESS] = false;
            return response()->json($responseAttributes);
        }

        $file->delete();
        Storage::disk("public_uploads")->delete($file->file_name);

        return response()->json($responseAttributes);
    }

    public function download(Request $request, $code){
        $currentFile = File::findByCode($code)->first();
        $this->updateDownloadCount($currentFile);
        return Storage::disk("public_uploads")->download($currentFile->file_name);
    }

    private function updateDownloadCount($file){
        $file->download_count = $file->download_count + 1;
        $file->save();
    }
}
