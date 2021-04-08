<select name="{{ $field ?? 'channel_id' }}" id="{{ $field ?? 'channel_id' }}"> {{--Specify field variable to add on the @include--}}
    @foreach ($channels as $channel)
        <option value="{{$channel->id}}">{{$channel->name}}</option>
    @endforeach
</select>
