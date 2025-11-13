@extends('Admin.layouts.app')
@section('title', 'Tax Formula')
@section('content')
<div class="row">
    <div class="col-12">
        <h1>Tax Formula</h1>
        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb"></nav>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="separator mb-5"></div>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4 font-weight-bold">Manage Tax Formula</h5>
                <form action="{{ url('tsfy-admin/tax-formula') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="txn_value" class="font-weight-bold">Txn Value</label>
                        <input type="number" step="0.01" min="0" class="form-control" id="txn_value" name="txn_value"
                               value="{{ old('txn_value', optional($taxFormula)->txn_value) }}" required>
                        <small class="form-text text-muted">Enter the tax value (e.g., 18 for 18%).</small>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary px-4">
                            {{ $taxFormula ? 'Update Value' : 'Save Value' }}
                        </button>
                    </div>
                </form>
                @if($taxFormula)
                    <div class="mt-4">
                        <h6 class="font-weight-bold">Current Value</h6>
                        <p class="mb-0">Txn Value: <strong>{{ $taxFormula->txn_value }}</strong></p>
                        <p class="text-muted">Last updated: {{ $taxFormula->updated_at->format('d-m-Y H:i') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
