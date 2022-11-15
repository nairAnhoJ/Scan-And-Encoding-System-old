<?php $__env->startSection('title'); ?>
    System Management
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <div class="p-5 h-full">
        <?php if(auth()->user()->role == '1'): ?>
        <h1 class="text-sky-600 text-xl font-bold mb-3 text-center">System Management</h1>

        
        <div id="deleteModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="deleteModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <form id="frmDeleteModal" method="POST" enctype="multipart/form-data" class=" p-6 text-center">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" id="hdnDeleteId" name="hdnDeleteId">
                        <input type="hidden" id="hdnSelected1" name="hdnSelected1">
                        <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 id="deleteMessage" class="text-lg font-normal text-gray-500"></h3>
                        <h3 id="deleteName" class="mb-8 text-lg font-semibold text-gray-500"></h3>
                        <button type="button" id="deleteAccept" data-modal-toggle="deleteModal" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button>
                        <button data-modal-toggle="deleteModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">No, cancel</button>
                    </form>
                </div>
            </div>
        </div>
        
        
        <div class="mb-4 border-b border-gray-200">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <?php if(session()->has('tab')): ?>
                        <?php if(session()->get('tab') == '1'): ?>
                        <button class="inline-block p-4 rounded-t-lg border-b-2 text-blue-600 hover:text-blue-600 border-blue-600" id="batch-tab" data-tabs-target="#batch" type="button" role="tab" aria-controls="batch" aria-selected="true">
                        <?php else: ?> 
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 text-gray-500 border-gray-100" id="batch-tab" data-tabs-target="#batch" type="button" role="tab" aria-controls="batch" aria-selected="false">
                        <?php endif; ?>
                    <?php else: ?>
                        <button class="inline-block p-4 rounded-t-lg border-b-2 text-blue-600 hover:text-blue-600 border-blue-600" id="batch-tab" data-tabs-target="#batch" type="button" role="tab" aria-controls="batch" aria-selected="true">
                    <?php endif; ?>
                    Batch</button>
                </li>
                <li class="mr-2" role="presentation">
                    <?php if(session()->has('tab')): ?>
                        <?php if(session()->get('tab') == '2'): ?>
                        <button class="inline-block p-4 rounded-t-lg border-b-2 text-blue-600 hover:text-blue-600 border-blue-600" id="docType-tab" data-tabs-target="#docType" type="button" role="tab" aria-controls="docType" aria-selected="true">
                        <?php else: ?> 
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 text-gray-500 border-gray-100" id="docType-tab" data-tabs-target="#docType" type="button" role="tab" aria-controls="docType" aria-selected="false">
                        <?php endif; ?>
                    <?php else: ?>
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 text-gray-500 border-gray-100" id="docType-tab" data-tabs-target="#docType" type="button" role="tab" aria-controls="docType" aria-selected="false">
                    <?php endif; ?>
                    Document Types</button>
                </li>
                <li class="mr-2" role="presentation">
                    <?php if(session()->has('tab')): ?>
                        <?php if(session()->get('tab') == '3'): ?>
                        <button class="inline-block p-4 rounded-t-lg border-b-2 text-blue-600 hover:text-blue-600 border-blue-600" id="docTypeFormIndex-tab" data-tabs-target="#docTypeFormIndexTab" type="button" role="tab" aria-controls="docTypeFormIndexTab" aria-selected="true">
                        <?php else: ?> 
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 text-gray-500 border-gray-100" id="docTypeFormIndex-tab" data-tabs-target="#docTypeFormIndexTab" type="button" role="tab" aria-controls="docTypeFormIndexTab" aria-selected="false">
                        <?php endif; ?>
                    <?php else: ?>
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 text-gray-500 border-gray-100" id="docTypeFormIndex-tab" data-tabs-target="#docTypeFormIndexTab" type="button" role="tab" aria-controls="docTypeFormIndexTab" aria-selected="false">
                    <?php endif; ?>
                    Document Type Form</button>
                </li>
                
                <li class="mr-2" role="presentation">
                    <?php if(session()->has('tab')): ?>
                        <?php if(session()->get('tab') == '5'): ?>
                        <button class="inline-block p-4 rounded-t-lg border-b-2 text-blue-600 hover:text-blue-600 border-blue-600" id="department-tab" data-tabs-target="#department" type="button" role="tab" aria-controls="department" aria-selected="true">
                        <?php else: ?> 
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 text-gray-500 border-gray-100" id="department-tab" data-tabs-target="#department" type="button" role="tab" aria-controls="department" aria-selected="false">
                        <?php endif; ?>
                    <?php else: ?>
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 text-gray-500 border-gray-100" id="department-tab" data-tabs-target="#department" type="button" role="tab" aria-controls="department" aria-selected="false">
                    <?php endif; ?>
                    Departments</button>
                </li>
                <li role="presentation">
                    <?php if(session()->has('tab')): ?>
                        <?php if(session()->get('tab') == '6'): ?>
                        <button class="inline-block p-4 rounded-t-lg border-b-2 text-blue-600 hover:text-blue-600 border-blue-600" id="user-tab" data-tabs-target="#user" type="button" role="tab" aria-controls="user" aria-selected="true">
                        <?php else: ?> 
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 text-gray-500 border-gray-100" id="user-tab" data-tabs-target="#user" type="button" role="tab" aria-controls="user" aria-selected="false">
                        <?php endif; ?>
                    <?php else: ?>
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 text-gray-500 border-gray-100" id="user-tab" data-tabs-target="#user" type="button" role="tab" aria-controls="user" aria-selected="false">
                    <?php endif; ?>
                    Users</button>
                </li>
            </ul>
        </div>

















        <div id="myTabContent" class="w-full">




            
            <div class="w-full p-4 bg-gray-50 rounded-lg" id="batch" role="tabpanel" aria-labelledby="batch-tab">

                
                <div id="batchModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                        <!-- Modal content -->
                        <form method="POST" id="batchForm" class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            <?php echo csrf_field(); ?>
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
                                    <label for="batch-dept" class="block text-sm font-medium text-gray-900">Department</label>
                                    <input type="hidden" id="batchDeptId" name="batchDeptId">
                                    <input type="hidden" id="thisBatchId" name="thisBatchId">
                                    <h1 id="batchDeptName" class="mb-2 font-semibold"></h1>
                                </div>
                                <div class="mb-2">
                                    <label for="batch-name" class="block mb-2 text-sm font-medium text-gray-900">Batch Name</label>
                                    <input type="text" id="batch-name" name="batchName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200">
                                <button id="btnBatchAddEdit" data-modal-toggle="batchModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save</button>
                                <button data-modal-toggle="batchModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
                

                
                <div class="w-full h-16 flex">
                    <form id="selectDeptBatch" enctype="multipart/form-data" class="w-2/5">
                        <?php echo csrf_field(); ?>
                        <label for="slcDeptBatch" class="block mb-1 text-sm font-medium text-gray-900">Select a Department</label>
                        <select id="slcDeptBatch" name="deptBatch" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option style="display: none;" selected>Choose a Department</option>
                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </form>
                    <div class="w-3/5 self-end">
                        <button id="btnAddBatch" disabled class="disabled:bg-opacity-50 disabled:border-opacity-0 disabled:pointer-events-none block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center float-right" type="button" data-modal-toggle="batchModal">
                            Add
                        </button>
                        <button id="btnEditBatch" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center h-10 border border-blue-700 float-right" type="button" data-modal-toggle="batchModal">
                            Edit
                        </button>
                        <button id="btnDeleteBatch" data-modal-toggle="deleteModal" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center h-10 border border-blue-700 float-right" type="button">
                            Delete
                        </button>
                    </div>
                </div>

                

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
                        <tbody id="tblBatchBody">
                            <tr>
                                <td colspan="3" class="text-center p-5 text-lg">Please Select a Department</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>























            
            <div class="hidden p-4 bg-gray-50 rounded-lg" id="docType" role="tabpanel" aria-labelledby="docType-tab">

                
                <div id="docTypeModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                        <!-- Modal content -->
                        <form method="POST" id="docTypeForm" class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            <?php echo csrf_field(); ?>
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
                                    <input type="hidden" id="thisTypeId" name="thisTypeId">
                                    <label for="docType-dept" class="block text-sm font-medium text-gray-900">Department</label>
                                    <input type="hidden" id="deptId" name="deptId">
                                    <h1 id="deptName" class="mb-2 font-semibold"></h1>
                                    
                                </div>
                                <div class="mb-2">
                                    <label for="docType-name" class="block mb-2 text-sm font-medium text-gray-900">Document Type Name</label>
                                    <input type="text" id="docType-name" name="docTypeName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200">
                                <button id="btnTypeAddEdit" data-modal-toggle="docTypeModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save</button>
                                <button data-modal-toggle="docTypeModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                
                <div class="w-full h-16 flex">
                    <form id="selectDept" enctype="multipart/form-data" class="w-2/5">
                        <?php echo csrf_field(); ?>
                        <label for="slcDept" class="block mb-1 text-sm font-medium text-gray-900">Select a Department</label>
                        <select id="slcDept" name="dept" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option style="display: none;" selected>Choose a Department</option>
                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </form>
                    <div class="w-3/5 self-end">
                        <button id="btnAddType" disabled class="disabled:bg-opacity-50 disabled:border-opacity-0 disabled:pointer-events-none block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center h-10 border border-blue-700 float-right" type="button" data-modal-toggle="docTypeModal">
                            Add
                        </button>
                        <button id="btnEditType" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center h-10 border border-blue-700 float-right" type="button" data-modal-toggle="docTypeModal">
                            Edit
                        </button>
                        <button id="btnDeleteType" data-modal-toggle="deleteModal" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center h-10 border border-blue-700 float-right" type="button">
                            Delete
                        </button>
                    </div>
                </div>
                
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
                        <tbody id="tblDocTypeBody">
                            <tr>
                                <td colspan="3" class="text-center p-5 text-lg">Please Select a Department</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>





















            
            <div class="hidden p-4 bg-gray-50 rounded-lg" id="docTypeFormIndexTab" role="tabpanel" aria-labelledby="docTypeFormIndex-tab">

                
                <div id="docTypeFormIndexModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                        <!-- Modal content -->
                        <form id="docTypeFormIndex" enctype="multipart/form-data" class="relative bg-white rounded-lg shadow">
                            <?php echo csrf_field(); ?>
                            <!-- Modal header -->
                            <div class="flex justify-between items-start p-4 rounded-t border-b">
                                <h3 id="docTypeFormIndexModalTitle" class="text-xl font-semibold text-gray-900"></h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="docTypeFormIndexModal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6">
                                <input type="hidden" id="hdnFormType" name="hdnFormType">
                                <input type="hidden" id="hdnFormId" name="hdnFormId">
                                <label for="docType-dept" class="block text-sm font-medium text-gray-900">Department</label>
                                <h1 id="TypeDeptName" class="mb-2 font-semibold"></h1>
                                    
                                <label for="docType-dept" class="block text-sm font-medium text-gray-900">Document Type</label>
                                <h1 id="TypeDocTypeName" class="mb-2 font-semibold"></h1>

                                <div class="mb-2">
                                    <label for="docTypeFormIndex-name" class="block mb-2 text-sm font-medium text-gray-900">Index Name</label>
                                    <input type="text" id="docTypeFormIndex-name" name="docTypeFormIndexName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                                <div class="mb-2">
                                    <label for="docTypeFormIndex-type" class="block mb-1 text-sm font-medium text-gray-900">Select a Document Type</label>
                                    <select id="docTypeFormIndex-type" name="docTypeFormIndexType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="text">Text</option>
                                        <option value="date">Date</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200">
                                <button id="btnIndexAddEdit" data-modal-toggle="docTypeFormIndexModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save</button>
                                <button data-modal-toggle="docTypeFormIndexModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                
                <div class="w-full h-16 flex gap-10">
                    <form id="frmFormSelectDept" enctype="multipart/form-data" class="w-2/5">
                        <?php echo csrf_field(); ?>
                        <label for="formSelectDept" class="block mb-1 text-sm font-medium text-gray-900">Select a Department</label>
                        <select id="formSelectDept" name="formDept" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option style="display: none;" selected>Choose a Department</option>
                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </form>
                    <form id="selectDocTypeForm" enctype="multipart/form-data" class="w-2/5">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" id="selectedDeptId" name="selectedDeptId">
                        <label for="formSelectType" class="block mb-1 text-sm font-medium text-gray-900">Select a Document Type</label>
                        <select id="formSelectType" disabled name="formType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option style="display: none;" selected>Choose a Document Type</option>
                        </select>
                    </form>
                    <div class="w-1/5 self-end">
                        <button id="btnAddIndex" disabled class="disabled:bg-opacity-50 disabled:border-opacity-0 disabled:pointer-events-none block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center h-10 border border-blue-700 float-right" type="button" data-modal-toggle="docTypeFormIndexModal">
                            Add
                        </button>
                        <button id="btnEditIndex" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center h-10 border border-blue-700 float-right" type="button" data-modal-toggle="docTypeFormIndexModal">
                            Edit
                        </button>
                        <button id="btnDeleteType" data-modal-toggle="deleteModal" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center h-10 border border-blue-700 float-right" type="button">
                            Delete
                        </button>
                    </div>
                </div>
                
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg w-full mt-3 border-t-2">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    #
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Index Name
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Type
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody id="docTypeFormTableBody">
                            <tr>
                                <td colspan="4" class="text-center p-5 text-lg">Please Select a Department and Document Type</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>























            
            























            
            <div class="hidden p-4 bg-gray-50 rounded-lg" id="department" role="tabpanel" aria-labelledby="department-tab">

                
                <div id="deptModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                        <!-- Modal content -->
                        <form method="POST" id="deptForm" class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            <?php echo csrf_field(); ?>
                            <div class="flex justify-between items-start p-4 rounded-t border-b">
                                <h3 id="deptModalTitle" class="text-xl font-semibold text-gray-900"></h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="deptModal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6">
                                <div class="mb-2">
                                    <input type="hidden" id="thisDeptId" name="thisDeptId">
                                    <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900">Department Name</label>
                                    <input type="text" id="dept-name" name="deptName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200">
                                <button id="btnDeptAddEdit" data-modal-toggle="deptModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save</button>
                                <button data-modal-toggle="deptModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                
                <div class="w-full h-10">
                    <button id="btnAddDept" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center float-right" type="button" data-modal-toggle="deptModal">
                        Add
                    </button>
                    <button id="btnEditDept" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center h-10 border border-blue-700 float-right" type="button" data-modal-toggle="deptModal">
                        Edit
                    </button>
                    <button id="btnDeleteDept" data-modal-toggle="deleteModal" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center h-10 border border-blue-700 float-right" type="button">
                        Delete
                    </button>
                </div>
                
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
                        <tbody id="tblDepts">
                            <?php
                                $x = 1;
                            ?>
                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="bg-white border-b">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        <?php echo e($x++); ?>

                                    </th>
                                    <td class="py-4 px-6">
                                        <?php echo e($department->name); ?>

                                    </td>
                                    <td class="py-4 px-6">
                                        <a type="button" data-id="<?php echo e($department->id); ?>" data-name="<?php echo e($department->name); ?>" class="btnEditThisDept cursor-pointer font-medium text-blue-600 hover:underline">Edit</a>
                                        <span> | </span>
                                        <a type="submit" data-id="<?php echo e($department->id); ?>" data-name="<?php echo e($department->name); ?>" class="btnDeleteThisDept cursor-pointer font-medium text-red-600 hover:underline">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

            </div>


























            
            <div class="hidden p-4 bg-gray-50 rounded-lg" id="user" role="tabpanel" aria-labelledby="user-tab">

                
                <div id="userModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                        <!-- Modal content -->
                        <form method="POST" id="userForm" enctype="multipart/form-data" class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            <?php echo csrf_field(); ?>
                            <div class="flex justify-between items-start p-4 rounded-t border-b">
                                <h3 id="userModalTitle" class="text-xl font-semibold text-gray-900"></h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="userModal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6">
                                <input type="hidden" id="thisUserId" name="thisUserId">
                                <div class="mb-2">
                                    <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900">Full Name</label>
                                    <input type="text" id="user-fullname" name="userName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                                <div class="mb-2">
                                    <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                                    <input type="text" id="user-username" name="userUsername" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                                <div class="mb-2">
                                    <label for="user-slcDept" class="block mb-1 text-sm font-medium text-gray-900">Select a Department</label>
                                    <select id="user-slcDept" name="userDept" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option style="display: none;" selected>Choose a Department</option>
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                                    <input type="password" id="user-pass" name="userPass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                                <div class="mb-2">
                                    <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
                                    <input type="password" id="user-cpass" name="userPass_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200">
                                <button id="btnUserAddEdit" data-modal-toggle="userModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save</button>
                                <button data-modal-toggle="userModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                
                <div class="w-full h-10">
                    <button id="btnAddUser" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center float-right" type="button" data-modal-toggle="userModal">
                        Add
                    </button>
                </div>
                
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg w-full mt-3 border-t-2">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    #
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Full Name
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Username
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Department
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tblUsers">
                            <?php
                                $x = 1;
                            ?>
                            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="bg-white border-b">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        <?php echo e($x++); ?>

                                    </th>
                                    <td class="py-4 px-6">
                                        <?php echo e($account->name); ?>

                                    </td>
                                    <td class="py-4 px-6">
                                        <?php echo e($account->username); ?>

                                    </td>
                                    <td class="py-4 px-6">
                                        <?php echo e($account->department); ?>

                                    </td>
                                    <td class="py-4 px-6">
                                        <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                                        <span> | </span>
                                        <a href="#" class="font-medium text-red-600 hover:underline">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

            </div>















        </div>
    </div>



    <script type="text/javascript">
        $(document).ready( function () {

            // ========================================================== B A T C H ==========================================================
            
                $('#slcDeptBatch').change(function(){
                    $.ajax({
                        url:"<?php echo e(route('system.getbatch')); ?>",
                        method:"POST",
                        data: $('#selectDeptBatch').serialize(),
                        success:function(result){
                            $('#tblBatchBody').html(result);
                        }
                    })
                    $('#btnAddBatch').prop('disabled', false);
                });

                $('#btnAddBatch').click(function(){
                    var batchDeptId = $('#slcDeptBatch option:selected').val();
                    var batchDeptName = $('#slcDeptBatch option:selected').html();
                    $('#batchModalTitle').html('Add New Batch');
                    $('#batchDeptId').val(batchDeptId);
                    $('#batchDeptName').html(batchDeptName);
                    $('#btnBatchAddEdit').addClass('btnBatchAdd');
                    $('#btnBatchAddEdit').removeClass('btnBatchEdit');
                    $('#batch-name').val('');
                });

                $(document).on('click', '.btnBatchAdd', function(){
                    $.ajax({
                        url:"<?php echo e(route('system.batch.add')); ?>",
                        method:"POST",
                        data: $('#batchForm').serialize(),
                        success:function(result){
                            $('#tblBatchBody').html(result);
                        }
                    })
                });

                $(document).on('click', '.btnEditThisBatch', function(){
                    var thisBatchId = $(this).data('id');
                    var batchDeptName = $('#slcDeptBatch option:selected').html();
                    var batchDeptId = $('#slcDeptBatch option:selected').val();
                    var batchDeptVal = $(this).data('name');

                    $('#batchDeptId').val(batchDeptId);
                    $('#thisBatchId').val(thisBatchId);
                    $('#batchDeptName').html(batchDeptName);
                    $('#batchModalTitle').html('Edit Batch');
                    $('#btnBatchAddEdit').addClass('btnBatchEdit');
                    $('#btnBatchAddEdit').removeClass('btnBatchAdd');
                    $('#batch-name').val(batchDeptVal);
                    $('#btnEditBatch').click();
                });

                $(document).on('click', '.btnBatchEdit', function(){
                    $.ajax({
                        url:"<?php echo e(route('system.batch.edit')); ?>",
                        method:"POST",
                        data: $('#batchForm').serialize(),
                        success:function(result){
                            $('#tblBatchBody').html(result);
                        }
                    })
                });

                $(document).on('click', '.btnDeleteThisBatch', function(){
                    var batchDeptId = $(this).data('id');
                    var batchDeptName = $(this).data('name');
                    var selDeptId = $('#slcDeptBatch option:selected').val();

                    $('#deleteMessage').html('Are you sure you want to delete this batch?');
                    $('#deleteName').html(batchDeptName);

                    $('#btnDeleteType').click();
                    $('#deleteAccept').addClass('btnBatchDelete');
                    $('#deleteAccept').removeClass('btnTypeDelete');

                    $('#hdnDeleteId').val(batchDeptId);
                    $('#hdnSelected1').val(selDeptId);
                });

                $(document).on('click', '.btnBatchDelete', function(){
                    $.ajax({
                        url:"<?php echo e(route('system.batch.delete')); ?>",
                        method:"POST",
                        data: $('#frmDeleteModal').serialize(),
                        success:function(result){
                            $('#tblBatchBody').html(result);
                        }
                    })
                });

            // BATCH END
            

















            // ========================================================== D O C - T Y P E ==========================================================
            
                $('#slcDept').change(function(){
                    $.ajax({
                        url:"<?php echo e(route('system.getdoctype')); ?>",
                        method:"POST",
                        data: $('#selectDept').serialize(),
                        success:function(result){
                            $('#tblDocTypeBody').html(result);
                        }
                    })
                    $('#btnAddType').prop('disabled', false);
                });

                $('#btnAddType').click(function(){
                    var deptId = $('#slcDept option:selected').val();
                    var deptName = $('#slcDept option:selected').html();

                    $('#docTypeModalTitle').html('Add New Document Type');
                    $('#btnTypeAddEdit').addClass('btnTypeAdd');
                    $('#btnTypeAddEdit').removeClass('btnTypeEdit');

                    $('#deptId').val(deptId);
                    $('#deptName').html(deptName);
                    $('#docType-name').val('');
                });

                $(document).on('click', '.btnTypeAdd', function(){
                    $.ajax({
                        url:"<?php echo e(route('system.doctype.add')); ?>",
                        method:"POST",
                        data: $('#docTypeForm').serialize(),
                        success:function(result){
                            $('#tblDocTypeBody').html(result);
                        }
                    })
                });

                $(document).on('click', '.btnEditDocType', function(){
                    var docTypeId = $(this).data('id');
                    var deptName = $('#slcDept option:selected').html();
                    var deptId = $('#slcDept option:selected').val();
                    var docTypeName = $(this).data('name');

                    $('#thisTypeId').val(docTypeId);
                    $('#deptId').val(deptId);

                    $('#btnEditType').click();
                    $('#deptName').html(deptName);
                    $('#docTypeModalTitle').html('Edit Document Type');
                    $('#btnTypeAddEdit').removeClass('btnTypeAdd');
                    $('#btnTypeAddEdit').addClass('btnTypeEdit');
                    $('#docType-name').val(docTypeName);
                });

                $(document).on('click', '.btnTypeEdit', function(){
                    $.ajax({
                        url:"<?php echo e(route('system.doctype.edit')); ?>",
                        method:"POST",
                        data: $('#docTypeForm').serialize(),
                        success:function(result){
                            $('#tblDocTypeBody').html(result);
                        }
                    })
                });

                $(document).on('click', '.btnDeleteDocType', function(){
                    var docTypeId = $(this).data('id');
                    var docTypeName = $(this).data('name');
                    var deptId = $('#slcDept option:selected').val();

                    $('#deleteAccept').addClass('btnTypeDelete');
                    $('#deleteAccept').removeClass('btnBatchDelete');
                    $('#deleteAccept').removeClass('btnIndexDelete');

                    $('#hdnDeleteId').val(docTypeId);
                    $('#hdnSelected1').val(deptId);

                    $('#btnDeleteType').click();
                    $('#deleteMessage').html('Are you sure you want to delete this document type?');
                    $('#deleteName').html(docTypeName);
                });

                $(document).on('click', '.btnTypeDelete', function(){
                    $.ajax({
                        url:"<?php echo e(route('system.doctype.delete')); ?>",
                        method:"POST",
                        data: $('#frmDeleteModal').serialize(),
                        success:function(result){
                            $('#tblDocTypeBody').html(result);
                        }
                    })
                });

            // DOC TYPE END
















            // ===================================================== D O C T Y P E - F O R M =====================================================

            $('#formSelectDept').change(function(){
                var selDeptId = $(this).val();
                $('#selectedDeptId').val(selDeptId);

                $.ajax({
                    url:"<?php echo e(route('system.gettype')); ?>",
                    method:"POST",
                    data: $('#frmFormSelectDept').serialize(),
                    success:function(result){
                        $('#formSelectType').html(result);
                    }
                })
                $('#formSelectType').prop('disabled', false);
            });

            $('#formSelectType').change(function(){
                $.ajax({
                    url:"<?php echo e(route('system.getform')); ?>",
                    method:"POST",
                    data: $('#selectDocTypeForm').serialize(),
                    success:function(result){
                        $('#docTypeFormTableBody').html(result);
                    }
                })
                $('#btnAddIndex').prop('disabled', false);
            });

            $('#btnAddIndex').click(function(){
                var selDeptId = $('#formSelectDept option:selected').val();
                var selDeptName = $('#formSelectDept option:selected').html();
                var selTypeId = $('#formSelectType option:selected').val();
                var selTypeName = $('#formSelectType option:selected').html();
                $('#docTypeFormIndexModalTitle').html('Add Index');
                $('#TypeDeptName').html(selDeptName);
                $('#TypeDocTypeName').html(selTypeName);
                $('#hdnFormType').val(selTypeId);
                $('#btnIndexAddEdit').addClass('btnIndexAdd');
                $('#btnIndexAddEdit').removeClass('btnIndexEdit');
                $('#docTypeFormIndex-name').val('');
                $('#docTypeFormIndex-type').val('text').change();
            });

            $(document).on('click', '.btnIndexAdd', function(){
                $.ajax({
                    url:"<?php echo e(route('system.indexadd')); ?>",
                    method:"POST",
                    data: $('#docTypeFormIndex').serialize(),
                    success:function(result){
                        $('#docTypeFormTableBody').html(result);
                    }
                })
            });

            $(document).on('click', '.btnEditIndex', function(){
                var editIndexId = $(this).data('id');
                var editIndexName = $(this).data('name');
                var editIndexType = $(this).data('type');
                var selTypeId = $('#formSelectType option:selected').val();
                var indexSelDeptName = $('#formSelectDept option:selected').html();
                var indexSelTypeName = $('#formSelectType option:selected').html();
                
                $('#docTypeFormIndexModalTitle').html('Edit Index');
                $('#TypeDeptName').html(indexSelDeptName);
                $('#TypeDocTypeName').html(indexSelTypeName);
                $('#hdnFormId').val(editIndexId);
                $('#hdnFormType').val(selTypeId);
                $('#docTypeFormIndex-name').val(editIndexName);
                $('#docTypeFormIndex-type').val(editIndexType).change();
                
                $('#btnIndexAddEdit').addClass('btnIndexEdit');
                $('#btnIndexAddEdit').removeClass('btnIndexAdd');

                $('#btnEditIndex').click();
            });

            $(document).on('click', '.btnIndexEdit', function(){
                $.ajax({
                    url:"<?php echo e(route('system.indexedit')); ?>",
                    method:"POST",
                    data: $('#docTypeFormIndex').serialize(),
                    success:function(result){
                        $('#docTypeFormTableBody').html(result);
                    }
                })
            });

            $(document).on('click', '.btnDeleteIndex', function(){
                var deleteIndexId = $(this).data('id');
                var deleteIndexName = $(this).data('name');
                var selTypeId = $('#formSelectType option:selected').val();
                var indexSelDeptName = $('#formSelectDept option:selected').html();
                var indexSelTypeName = $('#formSelectType option:selected').html();
                    
                $('#deleteMessage').html('Are you sure you want to delete this index?');
                $('#deleteName').html(deleteIndexName);
                $('#hdnDeleteId').val(deleteIndexId);
                $('#hdnSelected1').val(selTypeId);
                $('#btnDeleteType').click();

                $('#deleteAccept').addClass('btnIndexDelete');
                $('#btnTypeAddEdit').removeClass('btnTypeEdit');
                $('#deleteAccept').removeClass('btnBatchDelete');
            });

            $(document).on('click', '.btnIndexDelete', function(){
                $.ajax({
                    url:"<?php echo e(route('system.indexdelete')); ?>",
                    method:"POST",
                    data: $('#frmDeleteModal').serialize(),
                    success:function(result){
                        $('#docTypeFormTableBody').html(result);
                    }
                })
            });





















            // ========================================================== F O L D E R ==========================================================

            // $('#slcBatch').change(function(){
            //     $.ajax({
            //         url:"<?php echo e(route('system.getfolder')); ?>",
            //         method:"POST",
            //         data: $('#selectBatchForm').serialize(),
            //         success:function(result){
            //             $('#folderTableBody').html(result);
            //         }
            //     })
            // });






















            // ========================================================== D E P A R T M E N T ==========================================================

            $('#btnAddDept').click(function(){
                $('#deptModalTitle').html('Add New Department');
                $('#dept-name').val('');
                $('#btnDeptAddEdit').addClass('btnDeptAdd');
                $('#btnDeptAddEdit').removeClass('btnDeptEdit');
            });

            $(document).on('click', '.btnDeptAdd', function(){
                $.ajax({
                    url:"<?php echo e(route('system.dept.add')); ?>",
                    method:"POST",
                    data: $('#deptForm').serialize(),
                    success:function(result){
                        $('#tblDepts').html(result);
                    }
                })
            });


            $(document).on('click', '.btnEditThisDept', function(){
                var deptId = $(this).data('id');
                var deptName = $(this).data('name');
                $('#deptModalTitle').html('Edit Batch');
                $('#dept-name').val(deptName);

                $('#btnEditDept').click();

                $('#thisDeptId').val(deptId);
                $('#btnDeptAddEdit').addClass('btnDeptEdit');
                $('#btnDeptAddEdit').removeClass('btnDeptAdd');
            });

            $(document).on('click', '.btnDeptEdit', function(){
                $.ajax({
                    url:"<?php echo e(route('system.dept.edit')); ?>",
                    method:"POST",
                    data: $('#deptForm').serialize(),
                    success:function(result){
                        $('#tblDepts').html(result);
                    }
                })
            });

            $(document).on('click', '.btnDeleteThisDept', function(){
                var deptId = $(this).data('id');
                var deptName = $(this).data('name');

                $('#hdnDeleteId').val(deptId);
                $('#deleteAccept').addClass('btnDeptDelete');
                $('#deleteMessage').html('Are you sure you want to delete this department?');
                $('#deleteName').html(deptName);

                $('#btnDeleteDept').click();
            });

            $(document).on('click', '.btnDeptDelete', function(){
                $.ajax({
                    url:"<?php echo e(route('system.dept.delete')); ?>",
                    method:"POST",
                    data: $('#frmDeleteModal').serialize(),
                    success:function(result){
                        $('#tblDepts').html(result);
                    }
                })
            });


            






















            // ========================================================== U S E R S ==========================================================

            $('#btnAddUser').click(function(){
                $('#userModalTitle').html('Add New User');
                $('#user-fullname').val('');
                $('#user-username').val('');
                $('#user-pass').val('');
                $('#user-cpass').val('');
                $('#btnUserAddEdit').addClass('btnUserAdd');
                $('#btnUserAddEdit').removeClass('btnUserEdit');
            });

            $(document).on('click', '.btnUserAdd', function(){
                $.ajax({
                    url:"<?php echo e(route('system.user.add')); ?>",
                    method:"POST",
                    data: $('#userForm').serialize(),
                    success:function(result){
                        $('#tblUsers').html(result);
                    }
                })
            });


            // $(document).on('click', '.btnEditThisDept', function(){
            //     var deptId = $(this).data('id');
            //     var deptName = $(this).data('name');
            //     $('#deptModalTitle').html('Edit Batch');
            //     $('#dept-name').val(deptName);

            //     $('#btnEditDept').click();

            //     $('#thisDeptId').val(deptId);
            //     $('#btnDeptAddEdit').addClass('btnDeptEdit');
            //     $('#btnDeptAddEdit').removeClass('btnDeptAdd');
            // });

            // $(document).on('click', '.btnDeptEdit', function(){
            //     $.ajax({
            //         url:"<?php echo e(route('system.dept.edit')); ?>",
            //         method:"POST",
            //         data: $('#deptForm').serialize(),
            //         success:function(result){
            //             $('#tblDepts').html(result);
            //         }
            //     })
            // });

            // $(document).on('click', '.btnDeleteThisDept', function(){
            //     var deptId = $(this).data('id');
            //     var deptName = $(this).data('name');

            //     $('#hdnDeleteId').val(deptId);
            //     $('#deleteAccept').addClass('btnDeptDelete');
            //     $('#deleteMessage').html('Are you sure you want to delete this department?');
            //     $('#deleteName').html(deptName);
                
            //     $('#btnDeleteDept').click();
            // });

            // $(document).on('click', '.btnDeptDelete', function(){
            //     $.ajax({
            //         url:"<?php echo e(route('system.dept.delete')); ?>",
            //         method:"POST",
            //         data: $('#frmDeleteModal').serialize(),
            //         success:function(result){
            //             $('#tblDepts').html(result);
            //         }
            //     })
            // });
















        } );
    </script>













    <?php else: ?>
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
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Scan-And-Encoding-System\resources\views//system-management/index.blade.php ENDPATH**/ ?>