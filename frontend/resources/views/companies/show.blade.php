@extends('admin')
@section('title', $company->name)

@section('breadcrumbs')
  <li class="breadcrumb-item active"><a href="{{ route('companies.index') }}">Companies</a></li>
  <li class="breadcrumb-item">{{ $company->name }}</li>
@endsection

@section('content')
<div class="card card-gray">
  <div class="card-header">
    <h3 class="card-title">Company's info</h3>
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
                <h2 ><b>{{ $company->name }}</b></h2>
                <ul class="ml-4 mb-0 fa-ul ">
                  <li class="pt-3"><span class="fa-li"><i class="fas fa-lg fa-building text-muted"></i></span> {{ $company->address }}</li>
                  <li class="pt-1"><span class="fa-li"><i class="fas fa-lg fa-phone text-muted"></i></span> {{ $company->phone }}</li>
                </ul>
                <p class="pt-4"><b class="text-muted">About: </b> {{ $company->description }} </p>
              </div>
{{--              <div class="col-2 text-center">--}}
{{--                <img src="../../dist/img/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">--}}
{{--              </div>--}}
            </div>
          </div>
          <div class="card-footer">
            <div class="text-right">
              <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-primary fixed-btn">
                <i class="fas fa-pencil-alt"></i> Edit Company
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
    <h3 class="card-title">Company's customers</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body">
    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
      @if ($customers->count())
        <div class="row">
          <div class="col-md-3 d-none d-md-block">
            <div class="dataTables_info" role="status">Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }} entries</div>
          </div>
          <div class="col-md-6 col-sm-6 d-flex justify-content-center">
            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">

              @if ($customers->hasPages())
                <ul class="pagination">
                  <li class="paginate_button page-item previous {{ $customers->onFirstPage() ? 'disabled' : '' }}">
                    <a href="{{ $customers->firstPageUrl() }}" class="page-link">First</a>
                  </li>

                  <li class="paginate_button page-item previous {{ $customers->previousPageUrl() ? '' : 'disabled' }}">
                    <a href="{{ $customers->previousPageUrl() }}" class="page-link">&laquo;</a>
                  </li>

                  @foreach($customers->getUrlRange($customers->pageFrom(), $customers->pageTo()) as $page => $url)
                    <li class="paginate_button page-item {{ $customers->currentPage() == $page ? 'active' : '' }}">
                      <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                    </li>
                  @endforeach

                  <li class="paginate_button page-item next {{ $customers->nextPageUrl() ? '' : 'disabled' }}">
                    <a href="{{ $customers->nextPageUrl() }}" class="page-link">&raquo;</a>
                  </li>

                  <li class="paginate_button page-item next {{ $customers->onLastPage() ? 'disabled' : '' }}">
                    <a href="{{ $customers->lastPageUrl() }}" class="page-link">Last</a>
                  </li>
                </ul>
              @endif

            </div>
          </div>
          <div class="col-md-3 col-sm-6 d-flex justify-content-end">
            <a href="{{ route('companies.customers.index', $company->id) }}" class="btn btn-primary fixed-btn">
              <i class="fas fa-list-ol"></i> Edit customer list
            </a>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <table class="table table-bordered table-hover dataTable dtr-inline" role="grid">
              <thead>
                <!-- styling for th is in custom.css -->
                <tr role="row">
                  <th class="column {{ $customersColumns->id->class }} sortable" href="{{ $customersColumns->id->link }}">
                    ID
                  </th>
                  <th class="column {{ $customersColumns->name->class }} sortable" href="{{ $customersColumns->name->link }}">
                    Name
                  </th>
                  <th class="column {{ $customersColumns->email->class }} sortable" href="{{ $customersColumns->email->link }}">
                    E-mail
                  </th>
                  <th class="column {{ $customersColumns->phone->class }} sortable" href="{{ $customersColumns->phone->link }}">
                    Phone
                  </th>
                  <th class="column {{ $customersColumns->created_at->class }} sortable" href="{{ $customersColumns->created_at->link }}">
                    Entry created
                  </th>
                   <th class="column {{ $customersColumns->updated_at->class }} sortable" href="{{ $customersColumns->updated_at->link }}">
                    Entry updated
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($customers as $customer)
                  <tr class="clickable-row" href="{{ route('customers.show', $customer->id) }}">
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ \Carbon\Carbon::parse($customer->created_at)->format('Y-m-d H:i:s') }}</td>
                    <td>{{ \Carbon\Carbon::parse($customer->updated_at)->format('Y-m-d H:i:s') }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3 d-none d-md-block">
            <div class="dataTables_info" role="status">Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }} entries</div>
          </div>

          <div class="col-md-6 col-sm-6 d-flex justify-content-center">
            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">

              @if ($customers->hasPages())
                <ul class="pagination">
                  <li class="paginate_button page-item previous {{ $customers->onFirstPage() ? 'disabled' : '' }}">
                    <a href="{{ $customers->firstPageUrl() }}" class="page-link">First</a>
                  </li>

                  <li class="paginate_button page-item previous {{ $customers->previousPageUrl() ? '' : 'disabled' }}">
                    <a href="{{ $customers->previousPageUrl() }}" class="page-link">&laquo;</a>
                  </li>

                  @foreach($customers->getUrlRange($customers->pageFrom(), $customers->pageTo()) as $page => $url)
                    <li class="paginate_button page-item {{ $customers->currentPage() == $page ? 'active' : '' }}">
                      <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                    </li>
                  @endforeach

                  <li class="paginate_button page-item next {{ $customers->nextPageUrl() ? '' : 'disabled' }}">
                    <a href="{{ $customers->nextPageUrl() }}" class="page-link">&raquo;</a>
                  </li>

                  <li class="paginate_button page-item next {{ $customers->onLastPage() ? 'disabled' : '' }}">
                    <a href="{{ $customers->lastPageUrl() }}" class="page-link">Last</a>
                  </li>
                </ul>
              @endif

            </div>
          </div>

          <div class="col-md-3 col-sm-6 d-flex justify-content-end">
            <a href="{{ route('companies.customers.index', $company->id) }}" class="btn btn-primary fixed-btn">
              <i class="fas fa-list-ol"></i> Edit customer list
            </a>
          </div>
        </div>
      @else
        <div class="row mb-3">
          <div class="col-md-12 col-sm-12 d-flex justify-content-center">
            <h4>No customers added yet</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12 d-flex justify-content-center">
            <a class="btn btn-primary fixed-btn" href="{{ route('companies.customers.index', $company->id) }}">
              <i class="fas fa-plus"></i>
              Add customer(s)
            </a>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
