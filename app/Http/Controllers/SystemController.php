<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\DocType;
use Illuminate\Http\Request;
use Illuminate\Queue\Console\BatchesTableCommand;
use Illuminate\Support\Facades\DB;

class SystemController extends Controller
{
    public function index(){

        $batches = DB::table('batches')->get();
        $docTypes = DB::table('doc_types')->get();
        $folders = DB::table('folder_lists')->get();
        $departments = DB::table('departments')->get();

        return view('/system-management/index', compact('batches','docTypes','folders','departments'));
    }

    public function getfolder(Request $request){
        $batchID = $request->batch;

        $batchFolders = DB::table('folder_lists')->where('batch_id', $batchID)->orderBy('id', 'desc')->get();

        $output =   '';

        foreach ($batchFolders as $batchFolder){
            $output .=  '
                            <tr class="bg-white border-b">
                                <td class="py-4 px-6">'.$batchFolder->name.'</td>
                                <td class="py-4 px-6">
                                    <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                                    <span> | </span>
                                    <a href="#" class="font-medium text-red-600 hover:underline">Delete</a>
                                </td>
                            </tr>
                        ';
        }

        echo $output;
    }

    // ====================================================== B A T C H ======================================================

    public function batchAdd(Request $request){
        $request->validate([
            'batchName' => 'required',
        ]);

        $batch = New Batch();
        $batch->name = strtoupper($request->batchName);
        $batch->save();

        return redirect()->back();
    }

    public function batchEdit(Request $request, $id){
        $batchName = $request->batchName;

        $request->validate([
            'batchName' => 'required',
        ]);

        DB::update('update batches SET name = ? WHERE id = ?', [$batchName, $id]);

        return redirect()->back();
    }

    public function batchDelete($id){
        Batch::where('id',$id)->delete();
        return redirect()->back();
    }

    // ====================================================== D O C - T Y P E ======================================================
    
    public function doctypeAdd(Request $request){
        $request->validate([
            'docTypeName' => 'required',
        ]);

        $docType = New DocType();
        $docType->name = strtoupper($request->docTypeName);
        $docType->save();

        return redirect()->back();
    }

    public function doctypeEdit(Request $request, $id){
        $docTypeName = $request->docTypeName;

        $request->validate([
            'docTypeName' => 'required',
        ]);

        DB::update('update doc_types SET name = ? WHERE id = ?', [$docTypeName, $id]);

        return redirect()->back();
    }

    public function doctypeDelete($id){
        DocType::where('id',$id)->delete();
        return redirect()->back();
    }


}
