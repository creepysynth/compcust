@extends('admin')
@section('title', 'Companies')

@section('breadcrumbs')
  <li class="breadcrumb-item active">Companies</li>
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
          @if ($companies->count())
            <div class="row">

              <div class="col-md-3 d-none d-md-block ">
                <div class="dataTables_info" role="status">Showing {{ $companies->firstItem() }} to {{ $companies->lastItem() }} of {{ $companies->total() }} entries</div>
              </div>

              <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                  @if ($companies->hasPages())
                    <ul class="pagination">
                      <li class="paginate_button page-item previous {{ $companies->onFirstPage() ? 'disabled' : '' }}">
                        <a href="{{ $companies->firstPageUrl() }}" class="page-link">First</a>
                      </li>

                      <li class="paginate_button page-item previous {{ $companies->previousPageUrl() ? '' : 'disabled' }}">
                        <a href="{{ $companies->previousPageUrl() }}" class="page-link">&laquo;</a>
                      </li>

                      @foreach($companies->getUrlRange($companies->pageFrom(), $companies->pageTo()) as $page => $url)
                        <li class="paginate_button page-item {{ $companies->isCurrentPage($page) ? 'active' : '' }}">
                          <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                        </li>
                      @endforeach

                      <li class="paginate_button page-item next {{ $companies->nextPageUrl() ? '' : 'disabled' }}">
                        <a href="{{ $companies->nextPageUrl() }}" class="page-link">&raquo;</a>
                      </li>

                      <li class="paginate_button page-item next {{ $companies->onLastPage() ? 'disabled' : '' }}">
                        <a href="{{ $companies->lastPageUrl() }}" class="page-link">Last</a>
                      </li>
                    </ul>
                  @endif
                </div>
              </div>

              <div class="col-md-3 col-sm-12 d-flex justify-content-md-end justify-content-sm-center">
                <a class="btn btn-primary fixed-btn" href="{{ route('companies.create') }}" >
                  <i class="fas fa-plus"></i>
                  Create company
                </a>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <table class="table table-bordered table-hover dataTable dtr-inline" role="grid">
                  <thead>
                    <!-- styling for th is in custom.css -->
                    <tr role="row">
                      <th class="column {{ $columns->id->class }} sortable" href="{{ $columns->id->link }}">
                        ID
                      </th>
                      <th class="column {{ $columns->name->class }} sortable" href="{{ $columns->name->link }}">
                        Name
                      </th>
                      <th class="column {{ $columns->address->class }} sortable" href="{{ $columns->address->link }}">
                        Address
                      </th>
                      <th class="column {{ $columns->phone->class }} sortable" href="{{ $columns->phone->link }}">
                        Phone
                      </th>
                      <th class="column {{ $columns->created_at->class }} sortable" href="{{ $columns->created_at->link }}">
                        Entry created
                      </th>
                       <th class="column {{ $columns->updated_at->class }} sortable" href="{{ $columns->updated_at->link }}">
                        Entry updated
                      </th>
                      <th class="column"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($companies as $company)
                      <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->address }}</td>
                        <td>{{ $company->phone }}</td>
                        <td>{{ \Carbon\Carbon::parse($company->created_at)->format('Y-m-d H:i:s') }}</td>
                        <td>{{ \Carbon\Carbon::parse($company->updated_at)->format('Y-m-d H:i:s')  }}</td>
                        <td>
                          <a class="btn btn-primary btn-sm" href="{{ route('companies.show', $company->id) }}">
                              <i class="fas fa-eye"></i>
                              View
                          </a>

                          <a class="btn btn-success btn-sm" href="{{ route('companies.edit', $company->id) }}">
                              <i class="fas fa-pencil-alt"></i>
                              Edit
                          </a>

                          <form class="entry-delete" style="display:inline;" action="{{ route('companies.destroy', $company->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm" type="submit">
                              <i class="fas fa-trash"></i>
                              Delete
                            </button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

            <div class="row">

              <div class="col-md-3 d-none d-md-block ">
                <div class="dataTables_info" role="status">Showing {{ $companies->firstItem() }} to {{ $companies->lastItem() }} of {{ $companies->total() }} entries</div>
              </div>

              <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                  @if ($companies->hasPages())
                    <ul class="pagination">
                      <li class="paginate_button page-item previous {{ $companies->onFirstPage() ? 'disabled' : '' }}">
                        <a href="{{ $companies->firstPageUrl() }}" class="page-link">First</a>
                      </li>

                      <li class="paginate_button page-item previous {{ $companies->previousPageUrl() ? '' : 'disabled' }}">
                        <a href="{{ $companies->previousPageUrl() }}" class="page-link">&laquo;</a>
                      </li>

                      @foreach($companies->getUrlRange($companies->pageFrom(), $companies->pageTo()) as $page => $url)
                        <li class="paginate_button page-item {{ $companies->isCurrentPage($page) ? 'active' : '' }}">
                          <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                        </li>
                      @endforeach

                      <li class="paginate_button page-item next {{ $companies->nextPageUrl() ? '' : 'disabled' }}">
                        <a href="{{ $companies->nextPageUrl() }}" class="page-link">&raquo;</a>
                      </li>

                      <li class="paginate_button page-item next {{ $companies->onLastPage() ? 'disabled' : '' }}">
                        <a href="{{ $companies->lastPageUrl() }}" class="page-link">Last</a>
                      </li>
                    </ul>
                  @endif

                </div>
              </div>

              <div class="col-md-3 col-sm-12 d-flex justify-content-md-end justify-content-sm-center">
                <a class="btn btn-primary fixed-btn" href="{{ route('companies.create') }}" >
                  <i class="fas fa-plus"></i>
                  Create company
                </a>
              </div>
            </div>

          @else
            <div class="row mb-3">
              <div class="col-12 d-flex justify-content-center">
                <h4>No companies created yet</h4>
              </div>
            </div>
            <div class="row">
              <div class="col-12 d-flex justify-content-center">
                <a class="btn btn-primary fixed-btn" href="{{ route('companies.create') }}">
                  <i class="fas fa-plus"></i>
                  Create company
                </a>
              </div>
            </div>
          @endif
        </div>

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
@endsection
