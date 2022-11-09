@extends('layouts.app')

@section('title')
    Scan And Encoding System - Encode
@endsection



@section('content')
    <div class="p-5 h-full">
        @if (auth()->user()->role == '1')
        <h1 class="text-sky-600 text-xl font-bold mb-3 text-center">System Management</h1>

        {{-- ================================== DELETE MODAL ================================== --}}
        <div id="deleteModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="deleteModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <form action="" id="frmDeleteModal" method="POST" enctype="multipart/form-data" class=" p-6 text-center">
                        @csrf
                        <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 id="deleteMessage" class="text-lg font-normal text-gray-500"></h3>
                        <h3 id="deleteName" class="mb-8 text-lg font-normal text-gray-500"></h3>
                        <button type="submit" id="deleteAccept" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button>
                        <button data-modal-toggle="deleteModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">No, cancel</button>
                    </form>
                </div>
            </div>
        </div>
        
        {{-- ================================== MENU ================================== --}}
        <div class="mb-4 border-b border-gray-200">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    @if(session()->has('tab'))
                        @if(session()->get('tab') == '1')
                        <button class="inline-block p-4 rounded-t-lg border-b-2 text-blue-600 hover:text-blue-600 border-blue-600" id="batch-tab" data-tabs-target="#batch" type="button" role="tab" aria-controls="batch" aria-selected="true">
                        @else 
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 text-gray-500 border-gray-100" id="batch-tab" data-tabs-target="#batch" type="button" role="tab" aria-controls="batch" aria-selected="false">
                        @endif
                    @else
                        <button class="inline-block p-4 rounded-t-lg border-b-2 text-blue-600 hover:text-blue-600 border-blue-600" id="batch-tab" data-tabs-target="#batch" type="button" role="tab" aria-controls="batch" aria-selected="true">
                    @endif
                    Batch</button>
                </li>
                <li class="mr-2" role="presentation">
                    @if(session()->has('tab'))
                        @if(session()->get('tab') == '2')
                        <button class="inline-block p-4 rounded-t-lg border-b-2 text-blue-600 hover:text-blue-600 border-blue-600" id="docType-tab" data-tabs-target="#docType" type="button" role="tab" aria-controls="docType" aria-selected="true">
                        @else 
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 text-gray-500 border-gray-100" id="docType-tab" data-tabs-target="#docType" type="button" role="tab" aria-controls="docType" aria-selected="false">
                        @endif
                    @else
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 text-gray-500 border-gray-100" id="docType-tab" data-tabs-target="#docType" type="button" role="tab" aria-controls="docType" aria-selected="false">
                    @endif
                    Document Type</button>
                </li>
                <li class="mr-2" role="presentation">
                    @if(session()->has('tab'))
                        @if(session()->get('tab') == '2')
                        <button class="inline-block p-4 rounded-t-lg border-b-2 text-blue-600 hover:text-blue-600 border-blue-600" id="docTypeFormIndex-tab" data-tabs-target="#docTypeFormIndex" type="button" role="tab" aria-controls="docTypeFormIndex" aria-selected="true">
                        @else 
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 text-gray-500 border-gray-100" id="docTypeFormIndex-tab" data-tabs-target="#docTypeFormIndex" type="button" role="tab" aria-controls="docTypeFormIndex" aria-selected="false">
                        @endif
                    @else
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 text-gray-500 border-gray-100" id="docTypeFormIndex-tab" data-tabs-target="#docTypeFormIndex" type="button" role="tab" aria-controls="docTypeFormIndex" aria-selected="false">
                    @endif
                    Document Type Form</button>
                </li>
                <li class="mr-2" role="presentation">
                    @if(session()->has('tab'))
                        @if(session()->get('tab') == '3')
                        <button class="inline-block p-4 rounded-t-lg border-b-2 text-blue-600 hover:text-blue-600 border-blue-600" id="folder-tab" data-tabs-target="#folder" type="button" role="tab" aria-controls="folder" aria-selected="true">
                        @else 
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 text-gray-500 border-gray-100" id="folder-tab" data-tabs-target="#folder" type="button" role="tab" aria-controls="folder" aria-selected="false">
                        @endif
                    @else
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 text-gray-500 border-gray-100" id="folder-tab" data-tabs-target="#folder" type="button" role="tab" aria-controls="folder" aria-selected="false">
                    @endif
                    Folder</button>
                </li>
                <li role="presentation">
                    @if(session()->has('tab'))
                        @if(session()->get('tab') == '4')
                        <button class="inline-block p-4 rounded-t-lg border-b-2 text-blue-600 hover:text-blue-600 border-blue-600" id="department-tab" data-tabs-target="#department" type="button" role="tab" aria-controls="department" aria-selected="true">
                        @else 
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 text-gray-500 border-gray-100" id="department-tab" data-tabs-target="#department" type="button" role="tab" aria-controls="department" aria-selected="false">
                        @endif
                    @else
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 text-gray-500 border-gray-100" id="department-tab" data-tabs-target="#department" type="button" role="tab" aria-controls="department" aria-selected="false">
                    @endif
                    Department</button>
                </li>
            </ul>
        </div>

        <div id="myTabContent" class="w-full">
            {{-- ===================================== BATCH TAB ===================================== --}}
            <div class="w-full p-4 bg-gray-50 rounded-lg" id="batch" role="tabpanel" aria-labelledby="batch-tab">

                {{-- ---------------------------------- Add/Edit Modal ---------------------------------- --}}
                <div id="batchModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                        <!-- Modal content -->
                        <form method="POST" action="" id="batchForm" class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            @csrf
                            <div class="flex justify-between items-start p-4 rounded-t border-b">
                                <h3 id="batchModalTitle" class="text-xl font-semibold text-gray-900"></h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="batchModal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6">
                                <div class="mb-2">
                                    <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900">Batch Name</label>
                                    <input type="text" id="batch-name" name="batchName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200">
                                <button data-modal-toggle="batchModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save</button>
                                <button data-modal-toggle="batchModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- ---------------------------------- Modal End ---------------------------------- --}}

                {{-- ---------------------------------- Modal Button ---------------------------------- --}}
                <div class="w-full h-10">
                    <button id="btnAddBatch" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center float-right" type="button" data-modal-toggle="batchModal">
                        Add
                    </button>
                </div>
                {{-- ---------------------------------- Modal Button End ---------------------------------- --}}

                <div class="overflow-x-auto relative shadow-md sm:rounded-lg w-full mt-3 border-t-2">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    #
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Batch Name
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @foreach ($batches as $batch)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $x++ }}
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ $batch->name }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <a type="button" data-id="{{ $batch->id }}" data-name="{{ $batch->name }}" data-modal-toggle="batchModal" class="btnEditBatch font-medium text-blue-600 hover:underline cursor-pointer">Edit</a>
                                        <span class="mx-2">|</span>
                                        <a type="submit" data-id="{{ $batch->id }}" data-name="{{ $batch->name }}" data-modal-toggle="deleteModal" class="btnDeleteBatch font-medium text-red-600 hover:underline cursor-pointer">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            {{-- ===================================== DOCUMENT TYPES TAB ===================================== --}}
            <div class="hidden p-4 bg-gray-50 rounded-lg" id="docType" role="tabpanel" aria-labelledby="docType-tab">

                {{-- ---------------------------------- Add Modal ---------------------------------- --}}
                <div id="docTypeModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                        <!-- Modal content -->
                        <form method="POST" action="" id="docTypeForm" class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            @csrf
                            <div class="flex justify-between items-start p-4 rounded-t border-b">
                                <h3 id="docTypeModalTitle" class="text-xl font-semibold text-gray-900"></h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="docTypeModal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6">
                                <div class="mb-2">
                                    <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900">Document Type Name</label>
                                    <input type="text" id="docType-name" name="docTypeName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200">
                                <button data-modal-toggle="docTypeModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save</button>
                                <button data-modal-toggle="docTypeModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- ---------------------------------- Modal End ---------------------------------- --}}
                {{-- ---------------------------------- Modal Button ---------------------------------- --}}
                <div class="w-full h-10">
                    <button id="btnAddType" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center float-right" type="button" data-modal-toggle="docTypeModal">
                        Add
                    </button>
                </div>
                {{-- ---------------------------------- Modal Button End ---------------------------------- --}}
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg w-full mt-3 border-t-2">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    #
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Document Type Name
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @foreach ($docTypes as $docType)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $x++ }}
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ $docType->name }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <a type="button" data-id="{{ $docType->id }}" data-name="{{ $docType->name }}" data-modal-toggle="docTypeModal" class="btnEditDocType font-medium text-blue-600 hover:underline cursor-pointer">Edit</a>
                                        <span class="mx-2">|</span>
                                        <a type="submit" data-id="{{ $docType->id }}" data-name="{{ $docType->name }}" data-modal-toggle="deleteModal" class="btnDeleteDocType font-medium text-red-600 hover:underline cursor-pointer">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            {{-- ===================================== DOCUMENT TYPES FORM TAB ===================================== --}}
            <div class="hidden p-4 bg-gray-50 rounded-lg" id="docTypeFormIndex" role="tabpanel" aria-labelledby="docTypeFormIndex-tab">

                {{-- ---------------------------------- Add Modal ---------------------------------- --}}
                <div id="docTypeFormIndexModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                        <!-- Modal content -->
                        <form method="POST" action="" id="docTypeFormIndex" class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            @csrf
                            <div class="flex justify-between items-start p-4 rounded-t border-b">
                                <h3 id="docTypeFormIndexModalTitle" class="text-xl font-semibold text-gray-900"></h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="docTypeFormIndexModal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6">
                                <div class="mb-2">
                                    <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900">Document Type Name</label>
                                    <input type="text" id="docTypeFormIndex-name" name="docTypeFormIndexName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200">
                                <button data-modal-toggle="docTypeFormIndexModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save</button>
                                <button data-modal-toggle="docTypeFormIndexModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- ---------------------------------- Modal End ---------------------------------- --}}
                {{-- ---------------------------------- Modal Button ---------------------------------- --}}
                <div class="w-full h-16 flex">
                    <form id="selectDocTypeForm" enctype="multipart/form-data" class="w-2/5">
                        @csrf
                        <label for="slcDocType" class="block mb-1 text-sm font-medium text-gray-900">Select a Document Type</label>
                        <select id="slcDocType" name="docType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option style="display: none;" selected>Choose a Document Type</option>
                            @foreach ($docTypes as $docType)
                            <option value="{{ $docType->id }}">{{ $docType->name }}</option>
                            @endforeach
                        </select>
                    </form>
                    <div class="w-3/5 self-end">
                        <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center h-10 border border-blue-700 float-right" type="button" data-modal-toggle="folderModal">
                            Add
                        </button>
                    </div>
                </div>
                {{-- ---------------------------------- Modal Button End ---------------------------------- --}}
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg w-full mt-3 border-t-2">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    #
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Document Type Name
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody id="docTypeFormTableBody">
                            <tr>
                                <td colspan="3" class="text-center p-5 text-lg">Please Select a Document Type</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            {{-- ===================================== FOLDER TAB ===================================== --}}
            <div class="hidden p-4 bg-gray-50 rounded-lg" id="folder" role="tabpanel" aria-labelledby="folder-tab">

                {{-- ---------------------------------- Add Modal ---------------------------------- --}}
                <div id="folderModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            <div class="flex justify-between items-start p-4 rounded-t border-b">
                                <h3 class="text-xl font-semibold text-gray-900">
                                    Terms of Service folder
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="folderModal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6 space-y-6">
                                <p class="text-base leading-relaxed text-gray-500">
                                    With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                                </p>
                                <p class="text-base leading-relaxed text-gray-500">
                                    The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
                                </p>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200">
                                <button data-modal-toggle="folderModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">I accept</button>
                                <button data-modal-toggle="folderModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Decline</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ---------------------------------- Modal End ---------------------------------- --}}
                {{-- ---------------------------------- Modal Button ---------------------------------- --}}
                <div class="w-full h-16 flex">
                    <form id="selectBatchForm" enctype="multipart/form-data" class="w-2/5">
                        @csrf
                        <label for="slcBatch" class="block mb-1 text-sm font-medium text-gray-900">Select a Batch</label>
                        <select id="slcBatch" name="batch" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option style="display: none;" selected>Choose a Batch</option>
                            @foreach ($batches as $batch)
                            <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                            @endforeach
                        </select>
                    </form>
                    <div class="w-3/5 self-end">
                        <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center h-10 border border-blue-700 float-right" type="button" data-modal-toggle="folderModal">
                            Add
                        </button>
                    </div>
                </div>
                {{-- ---------------------------------- Modal Button End ---------------------------------- --}}
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg w-full mt-3 border-t-2">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Folder Name
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody id="folderTableBody">
                            <tr>
                                <td colspan="2" class="text-center p-5 text-lg">Please Select a Batch</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            {{-- ===================================== DEPARTMENT TAB ===================================== --}}
            <div class="hidden p-4 bg-gray-50 rounded-lg" id="department" role="tabpanel" aria-labelledby="department-tab">

                {{-- ---------------------------------- Add Modal ---------------------------------- --}}
                <div id="deptModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            <div class="flex justify-between items-start p-4 rounded-t border-b">
                                <h3 class="text-xl font-semibold text-gray-900">
                                    Terms of Service Dept
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="deptModal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6 space-y-6">
                                <p class="text-base leading-relaxed text-gray-500">
                                    With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                                </p>
                                <p class="text-base leading-relaxed text-gray-500">
                                    The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
                                </p>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200">
                                <button data-modal-toggle="deptModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">I accept</button>
                                <button data-modal-toggle="deptModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Decline</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ---------------------------------- Modal End ---------------------------------- --}}
                {{-- ---------------------------------- Modal Button ---------------------------------- --}}
                <div class="w-full h-10">
                    <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center float-right" type="button" data-modal-toggle="deptModal">
                        Add
                    </button>
                </div>
                {{-- ---------------------------------- Modal Button End ---------------------------------- --}}
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg w-full mt-3 border-t-2">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    #
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Department Name
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @foreach ($departments as $department)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $x++ }}
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ $department->name }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                                        <span> | </span>
                                        <a href="#" class="font-medium text-red-600 hover:underline">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>



    <script type="text/javascript">
        $(document).ready( function () {

            // ========================================================== B A T C H ==========================================================

            $('#btnAddBatch').click(function(){
                var action = window.location.origin + '/batch-add';
                $('#batchForm').prop('action', action);
                $('#batchModalTitle').html('Add New Batch');
                $('#batch-name').val('');
            });

            $('.btnEditBatch').click(function(){
                var batchId = $(this).data('id');
                var batchName = $(this).data('name');
                var action = window.location.origin + '/batch-edit/' + batchId;
                $('#batchForm').prop('action', action);
                $('#batchModalTitle').html('Edit Batch');
                $('#batch-name').val(batchName);
            });

            $('.btnDeleteBatch').click(function(){
                var batchId = $(this).data('id');
                var batchName = $(this).data('name');
                var action = window.location.origin + '/batch-delete/' + batchId;
                $('#frmDeleteModal').prop('action', action);
                $('#deleteMessage').html('Are you sure you want to delete this batch?');
                $('#deleteName').html(batchName);
            });
            
            // ========================================================== D O C - T Y P E ==========================================================
            
            $('#btnAddType').click(function(){
                var action = window.location.origin + '/doctype-add';
                $('#docTypeForm').prop('action', action);
                $('#docTypeModalTitle').html('Add New Document Type');
                $('#docType-name').val('');
            });

            $('.btnEditDocType').click(function(){
                var docTypeId = $(this).data('id');
                var docTypeName = $(this).data('name');
                var action = window.location.origin + '/doctype-edit/' + docTypeId;
                $('#docTypeForm').prop('action', action);
                $('#docTypeModalTitle').html('Edit Document Type');
                $('#docType-name').val(docTypeName);
            });

            $('.btnDeleteDocType').click(function(){
                var docTypeId = $(this).data('id');
                var docTypeName = $(this).data('name');
                var action = window.location.origin + '/doctype-delete/' + docTypeId;
                $('#frmDeleteModal').prop('action', action);
                $('#deleteMessage').html('Are you sure you want to delete this document type?');
                $('#deleteName').html(docTypeName);
            });

            // ===================================================== D O C T Y P E - F O R M =====================================================

            $('#slcDocType').change(function(){
                $.ajax({
                    url:"{{ route('system.getform') }}",
                    method:"POST",
                    data: $('#selectDocTypeForm').serialize(),
                    success:function(result){
                        $('#docTypeFormTableBody').html(result);
                    }
                })
            });

            // ========================================================== F O L D E R ==========================================================

            $('#slcBatch').change(function(){
                $.ajax({
                    url:"{{ route('system.getfolder') }}",
                    method:"POST",
                    data: $('#selectBatchForm').serialize(),
                    success:function(result){
                        $('#folderTableBody').html(result);
                    }
                })
            });
        } );
    </script>













    @else
    Page Not Found. Redirecting...
    <script type="text/javascript">   
        function is_jquery_here(){
            setTimeout(function(){
                if(window.jQuery){
                    var loc = window.location.origin;
                    window.location = loc;
                }
            }, 300);
        }
        is_jquery_here();
    
    </script>
    @endif
@endsection