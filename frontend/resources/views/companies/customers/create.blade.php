@extends('admin')
@section('title', "Create customer for $company->name")

@section('breadcrumbs')
  <li class="breadcrumb-item active"><a href="{{ route('companies.index') }}">Companies</a></li>
  <li class="breadcrumb-item active"><a href="{{ route('companies.show', $company->id) }}">{{ $company->name }}</a></li>
  <li class="breadcrumb-item">Customers</li>
  <li class="breadcrumb-item">Create customer</li>
@endsection

@section('content')
<form action="{{ route('companies.customers.store', $company->id) }}" method="POST">
  @csrf
  <div class="row">
    <div class="col-12">
      <div class="card card-gray">
        <div class="card-header">
          <h3 class="card-title">Create customer</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>Company name</label>
            <input type="text" class="form-control" value="{{ $company->name }}" disabled>
          </div>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', '') }}">
            @if ($errors->has('name'))
              @foreach ($errors->get('name') as $error)
                <div class="text-sm" style="color:red;">{{ $error }}</div>
              @endforeach
            @endif
          </div>
          <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text" id="email" name="email" class="form-control" value="{{ old('email', '') }}">
            @if ($errors->has('email'))
              @foreach ($errors->get('email') as $error)
                <div class="text-sm" style="color:red;">{{ $error }}</div>
              @endforeach
            @endif
          </div>
          <div class="form-group">
            <label for="phone">Phone number</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', '') }}">
            @if ($errors->has('phone'))
              @foreach ($errors->get('phone') as $error)
                <div class="text-sm" style="color:red;">{{ $error }}</div>
              @endforeach
            @endif
          </div>
          <div class="row pt-2">
            <div class="col-12">
              <a href="{{ route('companies.customers.index', $company->id) }}" class="btn btn-danger fixed-btn">Cancel</a>
              <input type="submit" value="Submit" class="btn btn-success float-right fixed-btn">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection
