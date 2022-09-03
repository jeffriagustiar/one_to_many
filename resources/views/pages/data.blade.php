@extends('layouts.home')

@push('')
    
@endpush

@section('title')
    CRUD
@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tables</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">CRUD</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <svg class="svg-inline--fa fa-table me-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M448 32C483.3 32 512 60.65 512 96V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V96C0 60.65 28.65 32 64 32H448zM224 256V160H64V256H224zM64 320V416H224V320H64zM288 416H448V320H288V416zM448 256V160H288V256H448z"></path></svg><!-- <i class="fas fa-table me-1"></i> Font Awesome fontawesome.com -->
                DataTable CRUD
            </div>
            <div class="card-body">
                {{-- <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns"> --}}
                    {{-- <div class="dataTable-container"> --}}
                        <table id="datacrud" class="dataTable-table">
                            <thead>
                                <tr>
                                    <th>Name</a></th>
                                    <th>Position</a></th>
                                    <th>Office</a></th>
                                    <th>Age</a></th>
                                    <th>Start date</a></th>
                                    <th>Salary</a></th></tr>
                            </thead>
                        </table>
                    {{-- </div> --}}
                {{-- </div> --}}
            </div>
        </main>
@endsection

@push('after-script')
        <script>
            var table = $('#datacrud').DataTable()
        </script>
@endpush