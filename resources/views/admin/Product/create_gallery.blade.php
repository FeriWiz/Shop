
@extends('admin.layouts.master')
@section('content')
    <main class="main-content">
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">ایجاد لیست تصاویر {{$product->title}}</h6>
                    <form method="POST" action="{{route('product.gallery.store', $product->id)}}" class="dropzone border border-primary">
                        @csrf
                        <div class="form-group row">
                            <div class="fallback">
                                <input type="file" name="file" multiple>
                            </div>
                        </div>
                    </form>
                    <livewire:admin.galleries/>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>

    </script>
@endsection
