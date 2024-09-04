@foreach($countries as $country)
    <option value="{{$country->id}}">{{$country->country_name}}</option>
@endforeach