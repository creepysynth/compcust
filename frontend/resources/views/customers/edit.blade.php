@extends('admin')
@section('title', 'Edit customer ' . $customer->name)

@section('breadcrumbs')
  <li class="breadcrumb-item active"><a href="{{ route('customers.index') }}">Customers</a></li>
  <li class="breadcrumb-item">Edit customer</li>
  <li class="breadcrumb-item">{{ $customer->name }}</li>
@endsection

@section('content')
<form action="{{ route('customers.update', $customer->id) }}" method="post">
  @method('put')
  @csrf
  <div class="row">
    <div class="col-12">
      <div class="card card-gray">
        <div class="card-header">
          <h3 class="card-title">Edit Customer</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $customer->name) }}">
            @if ($errors->has('name'))
              @foreach ($errors->get('name') as $error)
                <div class="text-sm" style="color:red;">{{ $error }}</div>
              @endforeach
            @endif
          </div>
          <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text" id="email" name="email" class="form-control" value="{{ old('email', $customer->email) }}">
            @if ($errors->has('email'))
              @foreach ($errors->get('email') as $error)
                <div class="text-sm" style="color:red;">{{ $error }}</div>
              @endforeach
            @endif
          </div>
          <div class="form-group">
            <label for="phone">Phone number</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $customer->phone) }}">
            @if ($errors->has('phone'))
              @foreach ($errors->get('phone') as $error)
                <div class="text-sm" style="color:red;">{{ $error }}</div>
              @endforeach
            @endif
          </div>
          <div class="row pt-2">
            <div class="col-12">
              <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-danger fixed-btn">Cancel</a>
              <input type="submit" value="Submit" class="btn btn-success float-right fixed-btn">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection
