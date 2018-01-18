@extends('index')
@section('header')
    <link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
@stop
@section('acr_index')
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                BLOG
                <a class="btn btn-primary btn-sm" style="float: right;" href="/acr/blog/yeni">YENİ</a></div>
            <div class="box-body">
                <table class="table" id="data_table">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>İşlem</th>
                        <th>İsim</th>
                        <th>Oluşturma</th>
                        <th>Son Güncelleme</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($blogs as $blog)
                        <tr id="{{$blog->id}}">
                            <td>{{$blog->id}}</td>
                            <td>
                                <a style="font-size: 14pt; margin-right: 15px;" href="/acr/blog/yeni?id={{$blog->id}}" class="glyphicon  glyphicon-edit"></a>
                                <span onclick="sil({{$blog->id}})" style="font-size: 14pt; cursor: pointer;" class="glyphicon glyphicon-trash"></span>
                            </td>
                            <td>{{$blog->name}}</td>
                            <td>{{$blog->created_at}}</td>
                            <td>{{$blog->updated_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
@section('footer')
    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>


    <script>
        $('#data_table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "language": {
                "sProcessing": "İşleniyor...",
                "lengthMenu": "Sayfada _MENU_ satır gösteriliyor",
                "zeroRecords": "Gösterilecek sonuç yok.",
                "info": "Toplam _PAGES_ sayfadan _PAGE_. sayfa gösteriliyor",
                "infoEmpty": "Gösterilecek öğe yok",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Arama yap",
                "oPaginate": {
                    "sFirst": "İlk",
                    "sPrevious": "Önceki",
                    "sNext": "Sonraki",
                    "sLast": "Son"
                }

            }
        });

        function sil(id) {
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