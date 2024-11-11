
@extends('admin.layouts.master')
@section('content')
    <main class="main-content">
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">ویرایش محصول</h6>
                    <form method="POST" action="{{route('products.update', $product->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div>
                            <figure class="avatar avatar">
                                <img src="{{url('images/admin/products/big/'.$product->image)}}" class="rounded-circle" alt="">
                            </figure>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">نام محصول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="title" value="{{$product->title}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">نام انگلیسی محصول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="title_en" value="{{$product->title_en}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">ثیمت محصول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="price" value="{{$product->price}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">تعداد محصول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="count" value="{{$product->count}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">گاراانتی محصول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="guarantee" value="{{$product->guarantee}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">تخفیف محصول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="discount" value="{{$product->discount}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">توضیحات محصول</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10">
                                    {{$product->description}}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">فروش ویژه</label>
                            <div class="col-sm-10">
                                <input type="checkbox" @if($product->is_special) checked @endif name="is_special" id="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">تاریخ اعتبار فروش ویژه</label>
                            <div class="col-sm-10">
                                <input value="{{Verta::instance($product->special_expiration)->format('Y/m/d')}}" type="text" name="special_expiration" id="special_expiration" v>
                            </div>
                        </div>
                        <div class="form-group row" >
                            <label class="col-sm-2 col-form-label">دسته بندی</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="category_id" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    @foreach($categories as $key => $value)
                                        @if($product->category_id == $key)
                                            <option selected="selected" value="{{$key}}">{{$value}}</option>
                                        @endif
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" >
                            <label class="col-sm-2 col-form-label">برند</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="brand_id" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    @foreach($brands as $key => $value)
                                        @if($product->brand_id == $key)
                                            <option selected="selected" value="{{$key}}">{{$value}}</option>
                                        @endif
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">انتخاب رنگ</label>
                            <div class="col-sm-10">
                                <select class="form-select select2-multiple" multiple name="colors[]" style="width: 100%; text-align: right;">
                                    @foreach($colors as $key => $value)
                                        @if(in_array($key, $product->colors()->pluck('id')->toArray()))
                                            <option selected value="{{$key}}">{{$value}}</option>
                                        @else
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="file"> آپلود عکس </label>
                            <input  class="col-sm-10" type="file" class="form-control-file" id="file" name="file">
                        </div>
                        <div class="form-group row">
                            <button name="submit" type="submit" class="btn btn-success btn-uppercase">
                                <i class="ti-check-box m-r-5"></i> ذخیره
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        $('form-select').select2();

        $(document).ready(function() {
            $('.form-select').select2(); // فعال‌سازی Select2 برای همه‌ی عناصر با کلاس form-select
        });
        var customOptions = {
            placeholder: "روز / ماه / سال"
            , twodigit: false
            , closeAfterSelect: true
            , nextButtonIcon: "fa fa-arrow-circle-right"
            , previousButtonIcon: "fa fa-arrow-circle-left"
            , buttonsColor: "#5867dd"
            , markToday: true
            , markHolidays: true
            , highlightSelectedDay: true
            , sync: true
            , gotoToday: true
        }
        kamaDatepicker('special_expiration', customOptions);

        if($('#description').length) {
            CKEDITOR.replace('description');
        }
    </script>
@endsection
