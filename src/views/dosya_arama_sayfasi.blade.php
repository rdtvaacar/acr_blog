@extends('acr_blog.yazdir')
@section('header')
    <style>
        .border_red {
            border: 2px solid red;
        }
    </style>
@stop
@section('acr_blog')
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border"> Dosyalar
                <input class="form-control"
                       style="margin-right:40px; width: 200px;
                       float: right;" size="50"
                       name="anacakDosya"
                       placeholder="Dosyalarda Ara..."
                       id="anacakDosya"
                       type="text"/>
            </div>
            <div class="box-body">
                <div id="dosyaSonuc"></div>
                <div id="tumDosyalar">
                    {!! $dosyalar !!}
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer')
    <script>
        $(document).ready(function () {
            $("#anacakDosya").keyup(function () {
                var kw = $("#anacakDosya").val();
                var kwLen = kw.length;
                if (kwLen >= 3) {
                    if (kw != '') {
                        $.ajax
                        ({
                            type: "POST",
                            url: "/acr/blog/file/search",
                            data: "kw=" + kw + "&blog_id={{$blog_id}}",
                            success: function (option) {
                                $("#tumDosyalar").hide();
                                $("#dosyaSonuc").html(option).show();
                            }
                        });
                    }
                    else {
                        $("#tumDosyalar").show();
                        $("#dosyaSonuc").hide();
                    }
                    return false;
                } else {
                    $("#tumDosyalar").show();
                    $("#dosyaSonuc").hide();
                }
            });


        });

        function bf_select(file_id, blog_id) {
            $.ajax
            ({
                type: "POST",
                url: "/acr/blog/file/add",
                data: "file_id=" + file_id + "&blog_id=" + blog_id,
                success: function (option) {
                    $('#py_id_' + file_id).addClass('border_red')
                }
            });
        }

        function bf_dont_select(file_id, blog_id) {
            $.ajax
            ({
                type: "POST",
                url: "/acr/blog/file/delete",
                data: "file_id=" + file_id + "&blog_id=" + blog_id,
                success: function (option) {
                    $('#py_id_' + file_id).removeClass('border_red');
                    $('#py_id_' + file_id).removeClass('border_red')

                }
            });
        }
    </script>
@stop