@extends('layout.MasterPage')
@section('title', 'Anasayfa')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sepetim</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Marka</th>
                        <th>Adet</th>
                        <th>Km</th>
                        <th>Fiyat</th>
                        <th>Renk</th>
                        <th style="width:150px">İşlemler</th>
                    </tr>
                </thead>
                <tbody class="tbl_products">
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right products_pagination">
            </ul>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset(mix('js/home.js')) }}"></script>
@endsection
