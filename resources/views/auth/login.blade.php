@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="mb-3">Sign in to your account</h3>

                @if($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input name="password" type="password" class="form-control">
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
        <p class="text-center mt-3">Don't have an account? <a href="{{ route('register') }}">Register</a></p>
    </div>
</div>
@endsection
