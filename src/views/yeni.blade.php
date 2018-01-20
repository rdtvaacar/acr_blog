@extends('acr_blog.blog')
@section('header')
    {!! Acr_fl::css() !!}
@stop
@section('acr_blog')
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
                <h3>Galeri Ekle</h3>
                <div style="float: left;">{!! Acr_fl::form() !!}</div>
                <div style="float: right;" onclick="acr_blog_dosya_sec({{$blog->id}})" class="btn btn-primary btn-sm">Dosyalardan Seç</div>
                {!! Acr_fl::files_galery($acr_file_id,$blog->files) !!}

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

        function acr_blog_dosya_sec(blog_id) {
            window.open('/acr/blog/file/select?blog_id=' + blog_id, "popupwindowname", "toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no, width=1050,height=750,left=200 ,top=200");
        }
    </script>
@stop
