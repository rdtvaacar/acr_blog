@foreach($blogs as $key=> $blog)
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border"><strong>{{$blog->name}}</strong></div>
            <div class="box-body">
                <div style="text-align: center; width: 100%">
                    <a href="/acr/blog/oku?id={{$blog->id}}"> {!! Acr_fl::views_image($blog->acr_file_id,$blog->file,'thumbs') !!}</a>
                </div>
                <div style="clear:both;"></div>
                <div style="padding-top: 10px; text-indent:25px;">{{$my->sayYaz(200,$blog->icerik)}}</div>
            </div>
            <div class="box-footer">
                <span class="text-muted" style="font-size: 9pt;">{{date('d/m/Y H:i',strtotime($blog->created_at))}}</span>
                <a style="float: right" class="btn btn-xs btn-info" href="/acr/blog/oku?id={{$blog->id}}">Detay>></a>
            </div>
        </div>
    </div>
    @if(($key+1)%3 ==0)<br>
    <div style="clear:both;"></div>
    @endif
@endforeach