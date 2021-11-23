@extends('admin')
@section('title', "Edit $company->name's customers")

@section('breadcrumbs')
  <li class="breadcrumb-item active"><a href="{{ route('companies.index') }}">Companies</a></li>
  <li class="breadcrumb-item active"><a href="{{ route('companies.show', $company->id) }}">{{ $company->name }}</a></li>
  <li class="breadcrumb-item ">Customer List edit</li>
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card card-gray">
      <div class="card-header">
        <h3 class="card-title">Edit {{ $company->name }}'s customer list</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <form style="display:inline;" action="{{ route('companies.customers.update', $company->id) }}" method="post">
          @csrf
          @method('put')

          <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
            @if ($customers)
              <div class="row">
                <div class="col-md-3 col-sm-12 d-flex justify-content-md-start justify-content-sm-center">
                  <a class="btn btn-success fixed-btn" href="{{ route('companies.customers.create', $company->id) }}">
                    <i class="fas fa-plus"></i>
                    Create customer
                  </a>
                </div>
                <div class="col-md-6 col-sm-12 d-flex justify-content-center">
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
                          <li class="paginate_button page-item {{ $customers->isCurrentPage($page) ? 'active' : '' }}">
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
                <div class="col-md-3 col-sm-12 d-flex justify-content-md-end justify-content-sm-center">
                  <button class="btn btn-primary fixed-btn" type="submit" style="height: 38px">
                    Submit
                  </button>
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
                        <th class="column {{ $columns->email->class }} sortable" href="{{ $columns->email->link }}">
                          E-mail
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
                        <th class="column">
                          Related
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($customers as $customer)
                        <tr>
                          <td>{{ $customer->id }}</td>
                          <td>{{ $customer->name }}</td>
                          <td>{{ $customer->email }}</td>
                          <td>{{ $customer->phone }}</td>
                          <td>{{ \Carbon\Carbon::parse($customer->created_at)->format('Y-m-d H:i:s') }}</td>
                          <td>{{ \Carbon\Carbon::parse($customer->updated_at)->format('Y-m-d H:i:s') }}</td>
                          <td class="d-flex justify-content-center">
                            <input type="hidden" value="{{ $customer->id }}" name="ids[]">
                            <input type="checkbox" value="{{ $customer->id }}" name="checked[]" {{ $customer->related ? 'checked' : '' }}>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="row">
                <div class="col-md-3 col-sm-12">
                  <a class="btn btn-success fixed-btn" href="{{ route('companies.customers.create', $company->id) }}">
                    <i class="fas fa-plus"></i>
                    Create customer
                  </a>
                </div>

                <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                  <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">

                    <ul class="pagination">
                      <li class="paginate_button page-item previous {{ $customers->onFirstPage() ? 'disabled' : '' }}">
                        <a href="{{ $customers->firstPageUrl() }}" class="page-link">First</a>
                      </li>

                      <li class="paginate_button page-item previous {{ $customers->previousPageUrl() ? '' : 'disabled' }}">
                        <a href="{{ $customers->previousPageUrl() }}" class="page-link">&laquo;</a>
                      </li>

                      @foreach($customers->getUrlRange($customers->pageFrom(), $customers->pageTo()) as $page => $url)
                        <li class="paginate_button page-item {{ $customers->isCurrentPage($page) ? 'active' : '' }}">
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

                  </div>
                </div>

                <div class="col-md-3 col-sm-12 d-flex justify-content-md-end justify-content-sm-center">
                  <button class="btn btn-primary fixed-btn" type="submit" style="height: 38px">
                    Submit
                  </button>
                </div>
              </div>
            @else
              <div class="row ">
                <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                  <h4>No customers created yet</h4>
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                  <a class="btn btn-primary" href="{{ route('companies.customers.create', $company->id) }}">
                    <i class="fas fa-plus"></i>
                    Create customer
                  </a>
                </div>
              </div>
            @endif
          </div>

        </form>

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
@endsection
