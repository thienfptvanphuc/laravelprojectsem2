@extends("be/layout")
@section("content")
<!-- form start -->
<div class="container-fluid ">
    <div class="row ">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h2 class="card-title">Edit Product</h2>
                </div>
                <!-- form start -->
                <form action="{{route('be.productedit',$load->id)}}" method="post" enctype="multipart/form-data"
                    id="addProductForm">
                    @csrf
                    <div class="card-body ">
                        <div class="form-group col-md-10">
                            <label>Brand</label>
                            <input type="text" class="form-control" name="brand"
                                value="{{old('brand',isset($load)?$load->brand:null)}}">
                            {!!$errors->first('brand','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name"
                                value="{{old('name',isset($load)?$load->name:null)}}">
                            {!!$errors->first('name','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label>Type Id</label>
                            <select name="type_id" class="form-control ">
                                @foreach( $dm as $item)
                                <option value="{{$item->id}}" @if($item->id==$load->type_id) selected @endif
                                    >{{$item->name}}</option>
                                @endforeach
                            </select>
                            {!!$errors->first('type_id','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label>Color</label>
                            <input type="text" class="form-control" name="color"
                                value="{{old('color',isset($load)?$load->color:null)}}">
                            {!!$errors->first('color','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label>Price</label>
                            <input type="text" class="form-control" name="price"
                                value="{{old('price',isset($load)?$load->price:null)}}">
                            {!!$errors->first('price','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label>Year</label>
                            <input type="text" class="form-control" name="year"
                                value="{{old('year',isset($load)?$load->year:null)}}">
                            {!!$errors->first('year','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label>Capacity</label>
                            <input type="text" class="form-control" name="capacity"
                                value="{{old('capacity',isset($load)?$load->capacity:null)}}">
                            {!!$errors->first('capacity','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label for="exampleInputPassword1">Image</label>
                            <input type="file" name="image" class="form-control" placeholder="Image">
                            {!!$errors->first('image','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group mb-0 col-md-10">
                            <label for="exampleInputPassword1">Product Status</label> &nbsp; &nbsp;
                            <input type="radio" name="product_status" <?php if($load->product_status ==1) {echo
                            "checked"; }else {echo "";} ?>
                            value=1> Active
                            <input type="radio" name="product_status" <?php if($load->product_status ==0) {echo
                            "checked"; }else {echo "";} ?>
                            value=0> Hide
                        </div>
                        <div class="form-group col-md-10">
                            <label>Overview</label>
                            <textarea name="overview" id="overview" class="form-control"></textarea>
                            <script>
                                CKEDITOR.replace('overview');
                            </script>
                            {!!$errors->first('overview','<div class="text-danger">:message</div>')!!}
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        <button type="button" class="btn btn-secondary" onclick="resetForm()"><i class="fa fa-undo"></i>
                            Reset</button>
                        <a href="{{route('be.product')}}" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i>
                            Back</a>

                    </div>
                </form>
                <!-- form end -->
            </div>
        </div>
        <div class="col-md-6">
        </div>
    </div>
</div>

<script>
    function resetForm() {
        document.getElementById("addProductForm").reset();
    }
</script>

@endsection