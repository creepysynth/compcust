@extends('admin')
@section('title', 'Customers')

@section('breadcrumbs')
  <li class="breadcrumb-item active">Customers</li>
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
          @if ($customers->count())
            <div class="row">
              <div class="col-md-3 col-sm-12">
                <div class="dataTables_info" role="status">Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }} entries</div>
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
                <a class="btn btn-primary fixed-btn" href="{{ route('customers.create') }}">
                  <i class="fas fa-plus"></i>
                  Create customer
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
                      <th class="column"></th>
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
                        <td>
                          <a class="btn btn-primary btn-sm" href="{{ route('customers.show', $customer->id) }}">
                              <i class="fas fa-eye"></i>
                              View
                          </a>

                          <a class="btn btn-success btn-sm" href="{{ route('customers.edit', $customer->id) }}">
                              <i class="fas fa-pencil-alt"></i>
                              Edit
                          </a>

                          <form class="entry-delete" style="display:inline;" action="{{ route('customers.destroy', $customer->id) }}" method="POST">
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
              <div class="col-md-3 col-sm-12">
                <div class="dataTables_info" role="status">Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }} entries</div>
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
                <a class="btn btn-primary fixed-btn" href="{{ route('customers.create') }}">
                  <i class="fas fa-plus"></i>
                  Create customer
                </a>
              </div>
            </div>

          @else
            <div class="row mb-3">
              <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                <h4>No customers created yet</h4>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                <a class="btn btn-primary fixed-btn" href="{{ route('customers.create') }}">
                  <i class="fas fa-plus"></i>
                  Create customer
                </a>
              </div>
            </div>
          @endif
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
