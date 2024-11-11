<div class="table overflow-auto" tabindex="8">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">عنوان جستجو</label>
        <div class="col-sm-10">
            <input type="text" class="form-control text-left" dir="rtl" wire:model="search">
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead class="thead-light">
        <tr>
            <th class="text-center align-middle text-primary">ردیف</th>
            <th class="text-center align-middle text-primary">نام دسته بندی</th>
            <th class="text-center align-middle text-primary"> گروه ویژگی ها</th>
            <th class="text-center align-middle text-primary">ویرایش</th>
            <th class="text-center align-middle text-primary">حذف</th>
            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
        </tr>
        </thead>
        <tbody>
        @foreach($properties as $index => $property)
            <tr>
                <td class="text-center align-middle">{{$properties->firstItem() + $index}}</td>
                <td class="text-center align-middle">{{$property->title}}</td>
                <td class="text-center align-middle">{{$property->property_group->title}}</td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-info" href="{{route('properties.edit', $property->id)}}">
                        ویرایش
                    </a>
                </td>
                <td class="text-center align-middle">
                    <form action="{{ route('category.destroy', $property->id) }}" method="POST" onsubmit="return confirm('آیا مطمئن هستید؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">حذف</button>
                    </form>
                </td>

                <td class="text-center align-middle">
                    {{Verta::instance($property->created_at)->format('%d, %B, %Y')}}
                </td>
            </tr>
        @endforeach
    </table>
    <div style="margin: 40px !important;"
         class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
        {{$properties->appends(Request::except('page'))->links()}}
    </div>
</div>
@section('scripts')
    <script>
        window.addEventListener('deleteCategory', event=>{
            Swal.fire({
                text: "آیا از حذف دسته بندی مطمئن هستید؟",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "بله حذف کن",
                cancelButtonText: 'خیر'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'دسته بندی با موفقیت حذف شد '
                    );
                }
            });
        })
    </script>
@endsection
