@extends("be/layout")
@section("content")
<!-- form start -->
<div class="container-fluid ">
    <div class="row ">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h2 class="card-title">Add Account</h2>
                </div>
                <!-- form start -->
                <form action="{{ route('be.accountadd') }}" method="post" enctype="multipart/form-data" id="addAccountForm">
                    @csrf
                    <div class="card-body ">
                        <div class="form-group col-md-10">
                            <label>Full Name</label>
                            <input type="text" name="fullname" class="form-control" value="{{old('name')}}"
                                placeholder="Please input name ">
                            {!!$errors->first('name','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="{{old('email')}}"
                                placeholder="Please input type id ">
                            {!!$errors->first('email','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="text" name="password" class="form-control" value="{{old('password')}}"
                                placeholder=" Please input password">
                            {!!$errors->first('password','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group col-md-10">
                            <label for="exampleInputPassword1">Role Value</label>
                            <input type="text" name="role_value" class="form-control" value="{{old('role_value')}}"
                                placeholder=" Please input role_value">
                            {!!$errors->first('role_value','<div class="text-danger">:message</div>')!!}
                        </div>
                        <div class="form-group mb-0 col-md-10">
                            <label for="exampleInputPassword1">Status</label> &nbsp; &nbsp;
                            <input type="radio" name="status" checked value=1> Active
                            <input type="radio" name="status" value=0> Hide
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> ADD</button>
                        <button type="button" class="btn btn-secondary" onclick="resetForm()"><i class="fa fa-undo"></i>
                            Reset</button>
                        <a href="{{route('be.account')}}" class="btn btn-danger"><i
                                class="fa fa-arrow-circle-left"></i> Back</a>
                        
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
        document.getElementById("addAccountForm").reset();
    }
</script>

@endsection