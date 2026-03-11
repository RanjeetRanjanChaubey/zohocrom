
@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">General Settings</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                <li class="breadcrumb-item active">General Settings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">General Settings</h4>
                        </div>
                        <div class="card-body">
                            <form class="row g-3" method="POST" action="{{ route('admin.settings.general.update') }}">
                                @csrf

                                <!-- SMTP Host -->
                                <div class="col-md-4">
                                    <label for="SMTP_Host" class="form-label">SMTP Host</label>
                                    <input type="text" class="form-control" id="smtp_Host" name="smtp_Host" placeholder="Enter SMTP Host" value="{{ old('smtp_host', $settings['smtp_host'] ?? '') }}" required>
                                </div>

                                <!-- SMTP Port -->
                                <div class="col-md-4">
                                    <label for="SMTP Port" class="form-label">SMTP Port</label>
                                    <input type="text" class="form-control" id="smtp_port" name="smtp_port" value="{{ old('smtp_port', $settings['smtp_port'] ?? '') }}" required>
                                </div>

                                <!-- SMTP Email -->
                                <div class="col-md-4">
                                    <label for="lastName" class="form-label">SMTP Email</label>
                                    <input type="text" class="form-control" id="smtp_email" name="smtp_email" value="{{ old('smtp_email', $settings['smtp_email'] ?? '') }}" required>
                                </div>

                                <!-- SMTP Password -->
                                <div class="col-md-4">
                                    <label for="lastName" class="form-label">SMTP Password</label>
                                    <input type="text" class="form-control" id="smtp_password" name="smtp_password" value="{{ old('smtp_password', $settings['smtp_password'] ?? '') }}" required>
                                </div>

                                <!-- Website Address -->
                                <div class="col-md-4">
                                    <label for="lastName" class="form-label">Website Address</label>
                                    <input type="text" class="form-control" id="smtp_website" name="smtp_website" value="{{ old('smtp_website', $settings['smtp_website'] ?? '') }}" required>
                                </div>

                                    
                                <!-- Project Name -->
                                <div class="col-md-4">
                                    <label class="form-label">Project Name</label>
                                    <input type="text" class="form-control" name="project_name" value="{{ old('project_name', $settings['project_name'] ?? '') }}">
                                </div>
                                
                                <!-- Project Logo -->
                                <div class="col-md-4">
                                    <label class="form-label">Project Logo</label>
                                    <input type="file" class="form-control" name="project_logo">
                                </div>

                                @if(!empty($settings['project_logo']))
                                <div class="col-md-4 mt-3">
                                    <img src="{{ asset('uploads/'.$settings['project_logo']) }}" height="60">
                                </div>
                                @endif

                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection