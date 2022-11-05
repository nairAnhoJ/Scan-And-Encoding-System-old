<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(){

        $batches = DB::table('batches')->get();
        $docTypes = DB::table('doc_types')->get();
        $users = DB::table('accounts')->get();
        
        $documents = DB::select('SELECT departments.name AS department, batches.name AS batch, doc_types.name AS docType, documents.name, documents.created_at, accounts.name AS uploader FROM ((((documents INNER JOIN departments ON documents.dept_id = departments.id) INNER JOIN batches ON documents.batch_id = batches.id) INNER JOIN doc_types ON documents.doctype_id = doc_types.id) INNER JOIN accounts ON documents.uploader = accounts.id) WHERE documents.uploader LIKE "%" AND documents.batch_id LIKE "%" AND documents.doctype_id LIKE "%" AND documents.created_at BETWEEN "2022-11-01" AND "2022-11-05"');

        return view('reports/index', compact('batches', 'docTypes', 'users', 'documents'));
    }
}
