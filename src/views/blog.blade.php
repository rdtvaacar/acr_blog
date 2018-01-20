@extends('acr_blog.blog')
@section('acr_blog')
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border"><strong>{{$blog->name}}</strong></div>
            <div class="box-body">

                <?php $img = empty(@$blog->file->file_name) ? '/img/tmp_tb.png' : '/acr/fl/get_file/' . $blog->acr_file_id . '/' . @$blog->file->file_name . '/thumbs'?>
                <img style="float: left; margin: 10px; width: 300px;" class="img-thumbnail" src="{!! $img !!}"/>
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
@section('footer')
    <script>
        function acr_blog_sil(id) {
            if (confirm('Silmek istediğinizden eminmisiniz?')) {
                $.ajax({
                    type: 'post',
                    url: '/acr/blog/delete',
                    data: 'id=' + id + '&_token={{csrf_token()}}',
                    success: function () {
                        $('#' + id).hide(400);
                    }
                });
            }
        }
    </script>
@stop