@extends('admin')
@section('title', 'Edit company ' . $company->name)

@section('breadcrumbs')
  <li class="breadcrumb-item active"><a href="{{ route('companies.index') }}">Companies</a></li>
  <li class="breadcrumb-item"><a href="{{ route('companies.show', $company->id) }}">{{ $company->name }}</a></li>
  <li class="breadcrumb-item">Edit</li>
@endsection

@section('content')
<form action="{{ route('companies.update', $company->id) }}" method="POST">
  @method('put')
  @csrf
  <div class="row">
    <div class="col-12">
      <div class="card card-gray">
        <div class="card-header">
          <h3 class="card-title">Edit Company</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $company->name) }}">
            @if ($errors->has('name'))
              @foreach ($errors->get('name') as $error)
                <div class="text-sm" style="color:red;">{{ $error }}</div>
              @endforeach
            @endif
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" rows="4">{{ old('description', $company->description) }}</textarea>
            @if ($errors->has('description'))
              @foreach ($errors->get('description') as $error)
                <div class="text-sm" style="color:red;">{{ $error }}</div>
              @endforeach
            @endif
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $company->address) }}">
            @if ($errors->has('address'))
              @foreach ($errors->get('address') as $error)
                <div class="text-sm" style="color:red;">{{ $error }}</div>
              @endforeach
            @endif
          </div>
          <div class="form-group">
            <label for="phone">Phone number</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $company->phone) }}">
            @if ($errors->has('phone'))
              @foreach ($errors->get('phone') as $error)
                <div class="text-sm" style="color:red;">{{ $error }}</div>
              @endforeach
            @endif
          </div>

          <div class="row pt-2">
            <div class="col-4">
              <a class="btn btn-danger fixed-btn" href="{{ route('companies.show', $company->id) }}">
                Cancel
              </a>
            </div>
            <div class="col-4 d-flex justify-content-center">
              <a class="btn btn-primary" href="{{ route('companies.customers.index', $company->id) }}">
                <i class="fas fa-pencil-alt"></i> Edit customer list
              </a>
            </div>
            <div class="col-4 d-flex justify-content-end">
              <input type="submit" value="Submit" class="btn btn-success float-right fixed-btn" >
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection
