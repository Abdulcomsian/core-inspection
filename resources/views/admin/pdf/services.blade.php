<!DOCTYPE html>
<html>
<head>

</head>
<body>
<table class="table table-hover">
    <thead>
      <tr>
        <th >Support Service</th>
        <th >Date</th>
        <th >Time</th>
        <th >Location</th>
        <th >User</th>
        <th >Service Provider</th>
        <th >Price</th>
        <th >Status</th>
      </tr>
    </thead>
    <tbody>
    @isset($allAppointments)
    @foreach($allAppointments as $index=>$appointment)
    <tr>
        <td>{{$appointment->serviceDetails->serviceCategory->name ?? ''}}</td>
        <td>{{date('d/m/Y',strtotime($appointment->start_date))}}-{{date('d/m/Y',strtotime($appointment->end_date))}}</td>
        <td>{{date("h:i A",strtotime($appointment->start_time)) ?? ''}}-{{date("h:i A",strtotime($appointment->end_time)) ?? ''}}</td>
        <td>{{$appointment->location ?? ''}}</td>
        <td>{{$appointment->user->first_name ?? ''}} {{$appointment->user->last_name ?? ''}}</td>
        <td>{{$appointment->serviceProvider->first_name ?? ''}} {{$appointment->serviceProvider->last_name ?? ''}}</td>
        <td>${{$appointment->serviceDetails->price ?? ''}}</td>
        @if(isset($appointment->disbursementDetails))
            @if($appointment->disbursementDetails->status == 2 )
            <td ><span >Admin Approved & Withdrawn</span></td>
            @elseif($appointment->disbursementDetails->status == 1 )
            <td ><span >User Approved</span></td>
            @else
            <td ><span >Provider Requested</span></td>
            @endif
        @elseif(isset($appointment->collectionDetails))
        <td ><span >Payment Initiated</span></td> 
        @else
        <td >
        <span >Pending</span>
        </td> 
    </tr> 
        @endif
        @endforeach                                    
        @endisset
    </tbody>
  </table>
</body>
</html>