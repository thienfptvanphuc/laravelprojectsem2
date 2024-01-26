@extends('be/layout')

@section('content1')
<style>
   .to-display {
      display: block;
      width: 100%;
      height: calc(2.25rem + 2px);
      padding: .375rem .75rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #495057;
      background-color: #fff;
      background-clip: padding-box;
      box-shadow: inset 0 0 0 transparent;
      transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
   }

   .to-edit {
      display: none;
   }
</style>
@endsection

@section('content')
{{-- <div class="row"> --}}
   <div class="col-md-9 col-sm-12">
      <div class="card">
         <div class="card-header">
            <h1>Rental Order No. {{$rental->id}}</h1>
         </div>
         <form action="{{route('be.rental-detail',$rental->id)}}" method="post" class="form-horizontal">
            @csrf
            <div class="card-body">
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">User ID</label>
                  <div class="col-sm-10">
                     <span class="to-display">{{$rental->account_id}}</span>
                     <input name="account_id" type="text" class="form-control to-edit to-edit"
                        value="{{$rental->account_id}}" />
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Car</label>
                  <div class="col-sm-10">
                     <span class="to-display">{{$rental->account_id}}</span>
                     <select name="car_id" class="form-control to-edit">
                        @foreach ($car_type as $type)
                        <optgroup label="{{$type->name}}">
                           @foreach ($cars as $car)
                           @if ($type->id==$car->type_id)
                           <option value="{{$car->id}}" @if ($rental->car_id==$car->id) selected @endif
                              >{{$car->name}}
                           </option>
                           @endif
                           @endforeach
                        </optgroup>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Pickup Date</label>
                  <div class="col-sm-10">
                     <span class="to-display">{{$rental->account_id}}</span>
                     <input name="pickup_date" type="text" class="form-control to-edit"
                        value="{{$rental->pickup_date}}" />
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Return Date</label>
                  <div class="col-sm-10">
                     <span class="to-display">{{$rental->account_id}}</span>
                     <input name="return_date" type="text" class="form-control to-edit"
                        value="{{$rental->return_date}}" />
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Note</label>
                  <div class="col-sm-10">
                     <span class="to-display">{{$rental->account_id}}</span>
                     <input name="note" type="text" class="form-control to-edit" value="{{$rental->note}}" />
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Process</label>
                  <div class="col-sm-10">
                     <span class="to-display">{{$rental->account_id}}</span>
                     <select name="processing" class="form-control to-edit">
                        <option value="3" @if ($rental->processing==3) selected @endif>Waiting</option>
                        <option value="2" @if ($rental->processing==2) selected @endif>Confirmed</option>
                        <option value="1" @if ($rental->processing==1) selected @endif>Picked up</option>
                        <option value="0" @if ($rental->processing==0) selected @endif>Completed</option>
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-10">
                     <span class="to-display">{{$rental->account_id}}</span>
                     <select name="status" class="form-control to-edit">
                        <option value="1" @if ($rental->status==1) selected @endif>Active</option>
                        <option value="0" @if ($rental->status==0) selected @endif>Canceled</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="card-footer">
               <button type="submit" class="btn btn-info">Sign in</button>
               <button type="submit" class="btn btn-default float-right">Cancel</button>
            </div>
         </form>
      </div>
   </div>
   <div class="col-md-3 col-sm-12">
      <div class="card">
         <div class="card-header">
            <h3>Action</h3>
         </div>
         <div class="card-body">
            <div class="row">
               <button type="button" id="enableEdit" class="btn btn-warning">Edit</button>
            </div>
         </div>
      </div>
   </div>
   {{--
</div> --}}
@endsection


{{-- <div class="col-md-4 col-sm-12">
   <div class="row mb-3">
      Processsing:
      <a href="" class="btn btn-primary">Confirm</a>
   </div>
   <div class="row">
      <button type="button" id="enableEdit" class="btn btn-warning">Edit</button>
   </div>
</div> --}}


@section('content2')
<script>
   $(document).ready(function(){
      $("#enableEdit").click(function(){
         $(".to-display").toggle();
         $(".to-edit").toggle();
         $(this).text(function(i, v){ return v === 'Edit' ? 'Done' : 'Edit' })
      });
   });
</script>
@endsection