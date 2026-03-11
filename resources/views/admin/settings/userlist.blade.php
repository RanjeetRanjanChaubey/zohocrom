@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->


<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">list</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">User List</h4>
                        </div>
                        <div class="card-body">
                            <div class="listjs-table" id="customerlist">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add</button>
                                            <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control search" placeholder="Search...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:50px;"></th>
                                                <th>Sn No.</th>
                                                <th>Full Name</th>
                                                <th>Designation</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                            </tr>
                                            </thead>
                                        <tbody class="list form-check-all">
                                            @foreach($users as $list)
                                            <tr>
                                               <td>
                                                    <a data-bs-toggle="collapse" href="#user{{$list->id}}" role="button" aria-expanded="false" class="toggle-icon">
                                                        <span class="plus-icon">+</span>
                                                        <span class="minus-icon" style="display:none;">-</span>
                                                    </a>
                                                </td>

                                                <td>{{ $list->id }}</td>
                                                <td>{{ $list->name }}</td>
                                                <td>{{ $list->designation }}</td>
                                                <td>{{ $list->email }}</td>
                                                <td>{{ $list->username }}</td>
                                            </tr>

                                            <tr class="collapse bg-light" id="user{{$list->id}}">
                                                <td colspan="6">

                                                    <div class="row p-3">

                                                        <div class="col-md-4">
                                                            <strong>Login Password</strong><br>
                                                           -
                                                        </div>

                                                        <div class="col-md-4">
                                                            <strong>Two Factor</strong><br>
                                                            @if($list->two_step_enabled)
                                                                <span class="text-success">Enabled</span>
                                                            @else
                                                                <span class="text-danger">Disabled</span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-4">
                                                            <strong>Device Check</strong><br>
                                                            @if($list->device_check_enabled)
                                                                <span class="text-success">Enabled</span>
                                                            @else
                                                                <span class="text-danger">Disabled</span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-4 mt-3">
                                                            <strong>Created ON</strong><br>
                                                            {{ $list->created_at }}
                                                        </div>

                                                        <div class="col-md-4 mt-3">
                                                            <strong>Status</strong><br>
                                                            @if($list->is_active == 1)
                                                                <span class="badge bg-success">Active</span>
                                                            @else
                                                                <span class="badge bg-danger">Inactive</span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-4 mt-3">
                                                            <strong>Action</strong><br>

                                                            <button class="btn btn-primary btn-sm">
                                                                Reset Google Key
                                                            </button>

                                                            <button class="btn btn-danger btn-sm">
                                                                Signout All Device
                                                            </button>
                                                        </div>

                                                    </div>

                                                </td>
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any orders for you search.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                                            Previous
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0"></ul>
                                        <a class="page-item pagination-next" href="javascript:void(0);">
                                            Next
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- <script>
$(document).ready(function() {

    $('a[data-bs-toggle="collapse"]').on('click', function(e) {
        e.preventDefault();

        const icon = $(this).find('.plus-icon, .minus-icon');
        const plus = $(this).find('.plus-icon');
        const minus = $(this).find('.minus-icon');

        // Toggle the icons
        if(plus.is(':visible')){
            plus.hide();
            minus.show();
        } else {
            plus.show();
            minus.hide();
        }

        // Bootstrap collapse toggle
        const targetSelector = $(this).attr('href');
        const target = $(targetSelector);
        target.collapse('toggle');

    });

});
</script> -->