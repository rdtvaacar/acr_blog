@foreach($dosyalar as $dosya)
    <?php $img = empty(@$dosya->file_name) ? '/img/tmp_tb.png' : '/acr/fl/get_file/' . $dosya->acr_file_id . '/' . @$dosya->file_name . '/thumbs'?>
    <div
            style="float: left; width: 140px; margin: 3px; cursor:pointer; position:relative;">
        <img style="height: 140px;" id="py_id_{{$dosya->id}}" @if(in_array($dosya->id,$p_dosya_ids)) class="border_red" onclick="bf_dont_select({{$dosya->id}},{{$blog_id}})" @else onclick="bf_select({{$dosya->id}},{{$blog_id}})" @endif
        src="{!! $img !!}"
             class="img-thumbnail">
        {{$dosya->file_name_org}}
        <a target="_blank" href="/acr/fl/get_file/{{$dosya->acr_file_id}}/'{{@$dosya->file_name}}/zero" class=" btn btn-block btn-primary btn-sm">İncele</a>
    </div>
@endforeach
<div style="clear:both;"></div>
{{$dosyalar->appends(['blog_id'=>$blog_id,'kw'=>$kw])->links()}}