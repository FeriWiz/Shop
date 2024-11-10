<div class="mt-5 row">
    @foreach($galleries as $gallery)
        <div class="p-2 border col-md-4 d-flex justify-content-around align-items-center border-danger">
            <img src="{{url('/images/admin/products/big/'.$gallery->image)}}" style="width: 100px;" alt="">
            <div>
                <form action="{{ route('product.gallery.delete', $gallery->id) }}" method="POST" onsubmit="return confirm('آیا مطمئن هستید؟');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-info"><i class="fa fa-trash"></i></button>
                </form>
            </div>
        </div>
    @endforeach
</div>
