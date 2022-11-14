<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\DeletedBatch;
use App\Models\Department;
use App\Models\DocType;
use App\Models\EncodeForm;
use App\Models\FolderList;
use Illuminate\Http\Request;
use Illuminate\Queue\Console\BatchesTableCommand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\New_;

class SystemController extends Controller
{
    public function index(){

        $batches = DB::table('batches')->orderBy('name', 'asc')->get();
        $docTypes = DB::table('doc_types')->orderBy('name', 'asc')->get();
        $folders = DB::table('folder_lists')->get();
        $departments = DB::table('departments')->orderBy('name', 'asc')->get();
        // $accounts = DB::table('accounts')->where('id','!=','1')->get();
        $accounts = DB::select('SELECT accounts.id, accounts.name, accounts.username, departments.name AS department FROM (accounts INNER JOIN departments ON accounts.department = departments.id) WHERE accounts.id != "1"');

        return view('/system-management/index', compact('batches','docTypes','folders','departments','accounts'))->with('tab', '1');
    }



























    // ====================================================== B A T C H ======================================================

        public function getBatch(Request $request){
            $deptID = $request->deptBatch;

            $deptBatches = DB::table('batches')->where('dept_id', $deptID)->orderBy('name', 'asc')->get();

            if($deptBatches->count() > 0){
                $output =   '';
            }else{
                $output =   '
                                <tr class="bg-white border-b">
                                    <td colspan="4" class="py-4 px-6 text-center">No data.</td>
                                </tr>
                            ';
            }
            $x = 1;

            foreach ($deptBatches as $deptBatch){
                $output .=  '
                            <tr class="bg-white border-b">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                    '.$x++.'
                                </th>
                                <td class="py-4 px-6">
                                    '.$deptBatch->name.'
                                </td>
                                <td class="py-4 px-6">
                                    <a type="button" data-id="'.$deptBatch->id.'" data-name="'.$deptBatch->name.'" class="btnEditThisBatch font-medium text-blue-600 hover:underline cursor-pointer">Edit</a>
                                    <span class="mx-2">|</span>
                                    <a type="submit" data-id="'.$deptBatch->id.'" data-name="'.$deptBatch->name.'" class="btnDeleteThisBatch font-medium text-red-600 hover:underline cursor-pointer">Delete</a>
                                </td>
                            </tr>
                            ';
            }

            echo $output;
        }

        public function batchAdd(Request $request){
            $batchDeptID = $request->batchDeptId;

            $request->validate([
                'batchName' => 'required',
            ]);

            $batch = New Batch();
            $batch->dept_id = $batchDeptID;
            $batch->name = strtoupper($request->batchName);
            $batch->save();

            $lastBatch = DB::table('batches')->get()->last();

            $folder = New FolderList();
            $folder->dept_id = $batchDeptID;
            $folder->batch_id = $lastBatch->id;
            $folder->name = '1';
            $folder->save();

            $dirDoc = public_path().'/documents';
            if (!file_exists($dirDoc)) {
                File::makeDirectory($dirDoc);
            }

            $dirDept = $dirDoc.'/'.$batchDeptID;
            if (!file_exists($dirDept)) {
                File::makeDirectory($dirDept);
            }

            $dir2 = $dirDept.'/'.$lastBatch->id;
            File::makeDirectory($dir2);

            $dir3 = $dir2.'/1';
            File::makeDirectory($dir3);

            return Redirect::back()->with('tab', '1');
        }

        public function batchEdit(Request $request, $id){
            $batchName = $request->batchName;

            $request->validate([
                'batchName' => 'required',
            ]);

            DB::update('update batches SET name = ? WHERE id = ?', [$batchName, $id]);

            return Redirect::back()->with('tab', '1');
        }

        public function batchDelete(Request $request){
            $deleteId = $request->hdnDeleteId;
            $deptID = $request->hdnSelected1;

            $batchRow = DB::table('batches')->where('id', $deleteId)->get();

            $batchName = $batchRow[0]->name;

            $delBatch = New DeletedBatch();
            $delBatch->prev_id = $deleteId;
            $delBatch->name = $batchName;
            $delBatch->save();

            Batch::where('id',$deleteId)->delete();

            $deptBatches = DB::table('batches')->where('dept_id', $deptID)->orderBy('name', 'asc')->get();

            if($deptBatches->count() > 0){
                $output =   '';
            }else{
                $output =   '
                                <tr class="bg-white border-b">
                                    <td colspan="4" class="py-4 px-6 text-center">No data.</td>
                                </tr>
                            ';
            }
            $x = 1;

            foreach ($deptBatches as $deptBatch){
                $output .=  '
                            <tr class="bg-white border-b">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                    '.$x++.'
                                </th>
                                <td class="py-4 px-6">
                                    '.$deptBatch->name.'
                                </td>
                                <td class="py-4 px-6">
                                    <a type="button" data-id="'.$deptBatch->id.'" data-name="'.$deptBatch->name.'" class="btnEditThisBatch font-medium text-blue-600 hover:underline cursor-pointer">Edit</a>
                                    <span class="mx-2">|</span>
                                    <a type="submit" data-id="'.$deptBatch->id.'" data-name="'.$deptBatch->name.'" class="btnDeleteThisBatch font-medium text-red-600 hover:underline cursor-pointer">Delete</a>
                                </td>
                            </tr>
                            ';
            }

            echo $output;
        }
    // BATCH END






























    // ====================================================== D O C - T Y P E ======================================================

        public function getdoctype(Request $request){
            $deptID = $request->dept;

            // echo $deptID;

            $deptDocTypes = DB::table('doc_types')->where('dept_id', $deptID)->orderBy('id', 'asc')->get();

            if($deptDocTypes->count() > 0){
                $output =   '';
            }else{
                $output =   '
                                <tr class="bg-white border-b">
                                    <td colspan="4" class="py-4 px-6 text-center">No data.</td>
                                </tr>
                            ';
            }
            $x = 1;

            foreach ($deptDocTypes as $deptDocType){
                $output .=  '
                            <tr class="bg-white border-b">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                    '.$x++.'
                                </th>
                                <td class="py-4 px-6">
                                    '.$deptDocType->name.'
                                </td>
                                <td class="py-4 px-6">
                                    <a type="button" data-id="'.$deptDocType->id.'" data-name="'.$deptDocType->name.'" data-modal-toggle="docTypeModal" class="btnEditDocType font-medium text-blue-600 hover:underline cursor-pointer">Edit</a>
                                    <span class="mx-2">|</span>
                                    <a type="submit" data-id="'.$deptDocType->id.'" data-name="'.$deptDocType->name.'" data-modal-toggle="deleteModal" class="btnDeleteDocType font-medium text-red-600 hover:underline cursor-pointer">Delete</a>
                                </td>
                            </tr>
                            ';
            }

            echo $output;
        }
        
        public function doctypeAdd(Request $request){
            $deptID = $request->deptId;

            $request->validate([
                'docTypeName' => 'required',
            ]);

            $docType = New DocType();
            $docType->dept_id = $deptID;
            $docType->name = strtoupper($request->docTypeName);
            $docType->save();

            return Redirect::back()->with('tab', '2');
        }

        public function doctypeEdit(Request $request, $id){
            $docTypeName = $request->docTypeName;

            $request->validate([
                'docTypeName' => 'required',
            ]);

            DB::update('update doc_types SET name = ? WHERE id = ?', [$docTypeName, $id]);

            return Redirect::back()->with('tab', '2');
        }

        public function doctypeDelete($id){
            DocType::where('id',$id)->delete();
            return Redirect::back()->with('tab', '2');
        }
    // DOC TYPE END



































    // ===================================================== D O C T Y P E - F O R M =====================================================

    public function getType(Request $request){
        $deptID = $request->formDept;

        $docTypes = DB::table('doc_types')->where('dept_id', $deptID)->orderBy('name', 'asc')->get();

        $output =   '<option style="display: none;" selected>Choose a Document Type</option>';

        foreach($docTypes as $docType){
            $output .= '
                            <option value="'.$docType->id.'">'.$docType->name.'</option>
                        ';
        }

        echo $output;
    }


    public function getforms(Request $request){
        $formType = $request->formType;

        $docTypeForms = DB::table('encode_forms')->where('doctype_id', $formType)->orderBy('id', 'asc')->get();

        if($docTypeForms->count() > 0){
            $output =   '';
        }else{
            $output =   '
                            <tr class="bg-white border-b">
                                <td colspan="4" class="py-4 px-6 text-center">No data.</td>
                            </tr>
                        ';
        }

        $x = 1;

        foreach ($docTypeForms as $docTypeForm){
            $output .=  '
                            <tr class="bg-white border-b">
                                <td class="py-4 px-6">'.$x++.'</td>
                                <td class="py-4 px-6">'.$docTypeForm->name.'</td>
                                <td class="py-4 px-6">'.strtoupper($docTypeForm->type).'</td>
                                <td class="py-4 px-6">
                                    <a type="button" data-id="'.$docTypeForm->id.'" data-name="'.$docTypeForm->name.'" data-type="'.$docTypeForm->type.'" data-modal-toggle="docTypeFormIndexModal" class="btnEditIndex font-medium text-blue-600 hover:underline cursor-pointer">Edit</a>
                                    <span> | </span>
                                    <a type="button" data-id="'.$docTypeForm->id.'" data-name="'.$docTypeForm->name.'" data-type="'.$docTypeForm->type.'" data-modal-toggle="deleteModal" class="btnDeleteIndex font-medium text-red-600 hover:underline cursor-pointer">Delete</a>
                                </td>
                            </tr>
                        ';
        }

        echo $output;
    }
        
    public function indexAdd(Request $request){
        $formType = $request->hdnFormType;
        $IndexName = $request->docTypeFormIndexName;
        $IndexType = $request->docTypeFormIndexType;

        $request->validate([
            'docTypeFormIndexName' => 'required',
            'docTypeFormIndexType' => 'required',
        ]);

        $typeForm = New EncodeForm();
        $typeForm->doctype_id = $formType;
        $typeForm->name = strtoupper($IndexName);
        $typeForm->name_nospace = preg_replace('/[^\p{L}\p{N}\s]/u', '', strtolower(str_replace(' ', '', $IndexName)));
        $typeForm->type = $IndexType;
        $typeForm->save();

        $docTypeForms = DB::table('encode_forms')->where('doctype_id', $formType)->orderBy('id', 'asc')->get();

        if($docTypeForms->count() > 0){
            $output =   '';
        }else{
            $output =   '
                            <tr class="bg-white border-b">
                                <td colspan="4" class="py-4 px-6 text-center">No data.</td>
                            </tr>
                        ';
        }

        $x = 1;

        foreach ($docTypeForms as $docTypeForm){
            $output .=  '
                            <tr class="bg-white border-b">
                                <td class="py-4 px-6">'.$x++.'</td>
                                <td class="py-4 px-6">'.$docTypeForm->name.'</td>
                                <td class="py-4 px-6">'.strtoupper($docTypeForm->type).'</td>
                                <td class="py-4 px-6">
                                    <a type="button" data-id="'.$docTypeForm->id.'" data-name="'.$docTypeForm->name.'" data-type="'.$docTypeForm->type.'" data-modal-toggle="docTypeFormIndexModal" class="btnEditIndex font-medium text-blue-600 hover:underline cursor-pointer">Edit</a>
                                    <span> | </span>
                                    <a type="button" data-id="'.$docTypeForm->id.'" data-name="'.$docTypeForm->name.'" data-type="'.$docTypeForm->type.'" data-modal-toggle="deleteModal" class="btnDeleteIndex font-medium text-red-600 hover:underline cursor-pointer">Delete</a>
                                </td>
                            </tr>
                        ';
        }

        echo $output;
    }

    public function indexEdit(Request $request){
        $editId = $request->hdnFormId;
        $formType = $request->hdnFormType;
        $IndexName = $request->docTypeFormIndexName;
        $IndexType = $request->docTypeFormIndexType;

        $request->validate([
            'docTypeFormIndexName' => 'required',
            'docTypeFormIndexType' => 'required',
        ]);

        DB::update('UPDATE encode_forms SET name = ? , type = ? WHERE id = ?', [$IndexName, $IndexType, $editId]);

        $docTypeForms = DB::table('encode_forms')->where('doctype_id', $formType)->orderBy('id', 'asc')->get();

        $output = '';

        $x = 1;

        foreach ($docTypeForms as $docTypeForm){
            $output .=  '
                            <tr class="bg-white border-b">
                                <td class="py-4 px-6">'.$x++.'</td>
                                <td class="py-4 px-6">'.$docTypeForm->name.'</td>
                                <td class="py-4 px-6">'.strtoupper($docTypeForm->type).'</td>
                                <td class="py-4 px-6">
                                    <a type="button" data-id="'.$docTypeForm->id.'" data-name="'.$docTypeForm->name.'" data-type="'.$docTypeForm->type.'" data-modal-toggle="docTypeFormIndexModal" class="btnEditIndex font-medium text-blue-600 hover:underline cursor-pointer">Edit</a>
                                    <span> | </span>
                                    <a type="button" data-id="'.$docTypeForm->id.'" data-name="'.$docTypeForm->name.'" data-type="'.$docTypeForm->type.'" data-modal-toggle="deleteModal" class="btnDeleteIndex font-medium text-red-600 hover:underline cursor-pointer">Delete</a>
                                </td>
                            </tr>
                        ';
        }

        echo $output;
    }

    public function indexDelete(Request $request){
        $deleteId = $request->hdnDeleteId;
        $formType = $request->hdnSelected1;

        EncodeForm::where('id',$deleteId)->delete();

        $docTypeForms = DB::table('encode_forms')->where('doctype_id', $formType)->orderBy('id', 'asc')->get();

        $output = '';

        $x = 1;

        foreach ($docTypeForms as $docTypeForm){
            $output .=  '
                            <tr class="bg-white border-b">
                                <td class="py-4 px-6">'.$x++.'</td>
                                <td class="py-4 px-6">'.$docTypeForm->name.'</td>
                                <td class="py-4 px-6">'.strtoupper($docTypeForm->type).'</td>
                                <td class="py-4 px-6">
                                    <a type="button" data-id="'.$docTypeForm->id.'" data-name="'.$docTypeForm->name.'" data-type="'.$docTypeForm->type.'" data-modal-toggle="docTypeFormIndexModal" class="btnEditIndex font-medium text-blue-600 hover:underline cursor-pointer">Edit</a>
                                    <span> | </span>
                                    <a type="button" data-id="'.$docTypeForm->id.'" data-name="'.$docTypeForm->name.'" data-type="'.$docTypeForm->type.'" data-modal-toggle="deleteModal" class="btnDeleteIndex font-medium text-red-600 hover:underline cursor-pointer">Delete</a>
                                </td>
                            </tr>
                        ';
        }

        echo $output;
    }












































    // ====================================================== F O L D E R ======================================================

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

















    
    // ====================================================== D E P A R T M E N T S ======================================================

    public function deptAdd(Request $request){
        $request->validate([
            'deptName' => 'required',
        ]);

        $dept = New Department();
        $dept->name = strtoupper($request->deptName);
        $dept->save();

        return Redirect::back()->with('tab', '5');
    }

    public function deptEdit(Request $request, $id){
        $deptName = $request->deptName;

        $request->validate([
            'deptName' => 'required',
        ]);

        DB::update('update departments SET name = ? WHERE id = ?', [$deptName, $id]);

        return Redirect::back()->with('tab', '5');
    }

    public function deptDelete($id){

        Department::where('id',$id)->delete();
        return Redirect::back()->with('tab', '5');
    }


}
