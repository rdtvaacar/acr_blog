@extends('index')
@section('header')
    {!! Acr_fl::css() !!}
@stop
@section('acr_index')
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">BLOG
                <a class="btn btn-primary btn-sm" style="float: right;" href="/acr/blog/yeni">YENİ</a></div>
            <div class="box-body">
                @if(!empty($blog->file))
                    {!! Acr_fl::files_galery($acr_file_id) !!}
                    <div style="display: none" id="file">
                        {!! Acr_fl::form_one() !!}
                    </div>
                @else
                    {!! Acr_fl::form_one() !!}
                @endif
                <form method="post" enctype="multipart/form-data" action="/acr/blog/create">
                    {{csrf_field()}}

                    <label>İsim</label>
                    <input class="form-control" name="name" value="{{@$blog->name.old('name')}}"/>
                    <label>İçerik</label>
                    <textarea id="editor1" class="form-control" name="icerik">{{@$blog->icerik.old('icerik')}}</textarea>
                    <br>
                    <input type="hidden" name="id" value="{{@$blog->id}}">

                    <br>
                    <button class="btn btn-block btn-primary">BİLGİLERİ KAYDET</button>
                    <br>
                </form>
            </div>
        </div>
    </div>
@stop
@section('footer')
    {!! Acr_fl::js($fl_data) !!}
    <script src="/bower_components/ckeditor/ckeditor.js"></script>
    <script>
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor1')
            //bootstrap WYSIHTML5 - text editor
        })
    </script>
@stop
