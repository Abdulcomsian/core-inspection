  
        <div class = "row col-md-4" style = "padding-left:35px;">
        <div class="sender-info d-flex align-items-center">
            @if(isset($chatDetails->userDetails->avatar) && !empty($chatDetails->userDetails->avatar))
            <img src="{{ URL::asset('images/' . $chatDetails->userDetails->avatar) }}" data-src="{{ URL::asset('images/' . $chatDetails->userDetails->avatar) }}" alt="" class="lazy-img logo chat-round-avatar" style = "max-width:30%;">
            @else
            <img src="{{asset('assets/images/human-avatar.png')}}" data-src="{{asset('assets/images/human-avatar.png')}}" alt="" class="lazy-img logo chat-round-avatar" style = "max-width:30%;">
            @endif            
            <div class="ps-3">
                @if($type == 0)
                <div class="sender-name">You</div>
                @else
                <div class="sender-name">
                {{$chatDetails->userDetails->first_name ?? ''}}
                {{$chatDetails->userDetails->first_name ?? ''}}
                </div>
                @endif
                <!-- <div class="sender-email">{{$conversations->employer->email ?? ''}}</div> -->
            </div>
        </div>
        </div>
        <div class="ps-4 pe-4 ps-xxl-5 pe-xxl-5">
            <p>{!! $chatDetails->message !!}</p>
        </div>
        <div class="ps-4 pe-4 ps-xxl-5 pe-xxl-5">
            <div class="attachments mb-30 d-flex">
                @isset($chatDetails->chatFiles)
                @foreach($chatDetails->chatFiles as $file)
                <a href="javascript:void(0)" class="file tran3s d-flex align-items-center mt-10" onclick= "downloadFile('{{asset($file->file_path)}}', '{{$file->original_name}}')">
                    <div class="icon rounded-circle d-flex align-items-center justify-content-center"><img src="{{asset($file->file_path)}}" data-src="{{asset($file->file_path)}}" alt="" class="lazy-img"></div>
                    <div class="ps-2">
                        <div class="file-name">{{$file->original_name}}</div>
                        {{--<div class="file-size">2.3mb</div>--}}
                    </div>
                </a> 
                @endforeach
                @endisset
            </div>
            <p class = "text-center" style = "font-size:12px">{{date('d M, g:i A',strtotime($chatDetails->created_at))}}</p>
        </div>