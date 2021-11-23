@extends('admin')
@section('title', $customer->name)

@section('breadcrumbs')
  <li class="breadcrumb-item active"><a href="{{ route('customers.index') }}">Customers</a></li>
  <li class="breadcrumb-item">{{ $customer->name }}</li>
@endsection

@section('content')
<div class="card card-gray">
  <div class="card-header">
    <h3 class="card-title">Customer's info</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body pb-0">
    <div class="row">
      <div class="col-12 ">
        <div class="card bg-light d-flex flex-fill">
          <div class="card-body mp-5">
            <div class="row">
              <div class="col-12">
                <h2 ><b>{{ $customer->name }}</b></h2>
                <ul class="ml-4 mb-0 fa-ul ">
                  <li class="pt-3"><span class="fa-li"><i class="fas fa-lg fa-building text-muted"></i></span> {{ $customer->email }}</li>
                  <li class="pt-1"><span class="fa-li"><i class="fas fa-lg fa-phone text-muted"></i></span> {{ $customer->phone }}</li>
                </ul>
              </div>
{{--              <div class="col-2 text-center">--}}
{{--                <img src="../../dist/img/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">--}}
{{--              </div>--}}
            </div>
          </div>
          <div class="card-footer">
            <div class="text-right">
              <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary fixed-btn">
                <i class="fas fa-pencil-alt"></i> Edit Customer
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 <div class="card card-gray">
  <div class="card-header">
    <h3 class="card-title">Customer's companies</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body">
    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
      @if ($companies->count())
        <div class="row">
          <div class="col-md-3 col-sm-12">
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
                    <li class="paginate_button page-item {{ $companies->currentPage() == $page ? 'active' : '' }}">
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
          <div class="col-md-3"></div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <table class="table table-bordered table-hover dataTable dtr-inline" role="grid">
              <thead>
                <!-- styling for th is in custom.css -->
                <tr role="row">
                  <th class="column {{ $companiesColumns->id->class }} sortable" href="{{ $companiesColumns->id->link }}">
                    ID
                  </th>
                  <th class="column {{ $companiesColumns->name->class }} sortable" href="{{ $companiesColumns->name->link }}">
                    Name
                  </th>
                  <th class="column {{ $companiesColumns->address->class }} sortable" href="{{ $companiesColumns->address->link }}">
                    E-mail
                  </th>
                  <th class="column {{ $companiesColumns->phone->class }} sortable" href="{{ $companiesColumns->phone->link }}">
                    Phone
                  </th>
                  <th class="column {{ $companiesColumns->created_at->class }} sortable" href="{{ $companiesColumns->created_at->link }}">
                    Entry created
                  </th>
                   <th class="column {{ $companiesColumns->updated_at->class }} sortable" href="{{ $companiesColumns->updated_at->link }}">
                    Entry updated
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($companies as $company)
                  <tr class="clickable-row" href="{{ route('companies.show', $company->id) }}">
                    <td>{{ $company->id }}</td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->address }}</td>
                    <td>{{ $company->phone }}</td>
                    <td>{{ \Carbon\Carbon::parse($company->created_at)->format('Y-m-d H:i:s') }}</td>
                    <td>{{ \Carbon\Carbon::parse($company->updated_at)->format('Y-m-d H:i:s') }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3 col-sm-12">
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
                    <li class="paginate_button page-item {{ $companies->currentPage() == $page ? 'active' : '' }}">
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
          <div class="col-md-3"></div>
        </div>
      @else
        <div class="row mb-3">
          <div class="col-md-12 col-sm-12 d-flex justify-content-center">
            <h4>No company added this customer yet</h4>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
