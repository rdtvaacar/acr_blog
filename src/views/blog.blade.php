@extends('index')
@section('acr_index')
    <div class="col-lg-8">
        <div class="box box-primary">
            <div class="box-header with-border"><strong>{{$blog->name}}</strong></div>
            <div class="box-body">
                <?php $img = empty($blog->file->file_name) ? '/img/tmp_tb.png' : '/acr_files/' . $blog->acr_file_id . '/thumbs/' . $blog->file->file_name . '.' . $blog->file->file_type ?>
                <img style="float: left; margin: 10px; width: 300px;" class="img-thumbnail" src="/acr/blog/get_file/{{$blog->acr_file_id}}/{{$blog->file->file_name}}/med"/>
                {!! $blog->icerik !!}
            </div>
        </div>
    </div>
    <!-- Sidebar Widgets Column -->
    <div class="col-md-4">
        <div class="card my-4">
            <div class="box box-primary">
                <div class="box-header with-border"><strong>Diğer Yazılar</strong></div>
                <div class="box-body">
                    <ul>

                    </ul>
                    <div class="box-group" id="accordion">
                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                        @foreach($blogs as $key=> $blog)
                            <div class="panel box box-info">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$blog->id}}" aria-expanded="false" class="collapsed">
                                            {{$blog->name}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_{{$blog->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="box-body">
                                        {{$my->sayYaz(250,$blog->icerik)}}
                                        <a style="float: right" class="btn btn-xs btn-info" href="/acr/blog/oku?id={{$blog->id}}">Detay>></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
