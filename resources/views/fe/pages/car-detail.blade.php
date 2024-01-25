@extends('fe/layout')

@section('content')
<div class="row">
   <div class="col-12">
      <div class="row">
         <div class="offset-3 col-lg-4 mb-5">
            <h1>{{$car->name}}</h1>
         </div>
      </div>
      <div class="row">
         <div class="offset-3 col-lg-4 mb-5">
            <div class="bg-light p-5">
               <h3 class="text-primary text-center mb-4">Schedule</h3>
               <form action="" method="post" class="col-12">
                  @csrf
                  <div class="form-group row">
                     <label class="col-2 col-form-label" for="">
                        <h6>Pickup Date</h6>
                     </label>
                     <div class="schedule col-9" id="date1" data-target-input="nearest">
                        <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Pickup Date"
                           name="pickup_date" data-target="#date1" data-toggle="datetimepicker"
                           onkeydown="return false" />
                        {!!$errors->first("pickup_date",'<div class="text-danger">:message</div>')!!}
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-2 col-form-label" for="">
                        <h6>Return Date</h6>
                     </label>
                     <div class="schedule col-9" id="date2" data-target-input="nearest">
                        <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Return Date"
                           name="return_date" data-target="#date2" data-toggle="datetimepicker"
                           onkeydown="return false" />
                        {!!$errors->first("return_date",'<div class="text-danger">:message</div>')!!}
                     </div>
                  </div>
                  <div class="row">
                     <button type="submit" class="btn btn-primary">Book</button>
                  </div>
               </form>
            </div>
         </div>
      </div>

   </div>
</div>
@endsection

@section('content2')
<script>
   $(document).ready(function () {
      // Tạo mảng rỗng chứa ngày tháng không có xe
      var dateArray = [];
      // Lấy dữ liệu ngày tháng truyền vô từ controller
      var xday = {!! json_encode($dsd->toArray()) !!};
      xday.forEach(element => {
      var startDate = new Date(element.pickup_date);
      var endDate = new Date(element.return_date);
      while (startDate <= endDate) {
         dateArray.push(moment(startDate).format('YYYY-MM-DD'));
         startDate.setDate(startDate.getDate() + 1);
      }
      });
      console.log(dateArray);
      $('.schedule').datetimepicker({
         format: 'YYYY-MM-DD',
         minDate: new Date(),
         disabledDates: dateArray
      });
   })
   
</script>
@endsection