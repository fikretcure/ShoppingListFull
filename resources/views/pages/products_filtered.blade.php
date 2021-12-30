@extends('layout.MasterPage')
@section('title', 'Ürün Filtreleme')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Filtrelenmiş Ürünler</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Km</label>
                        <div class="input-group">
                            <select class="form-control km_if">
                                <option value="">Seçim Yapınız</option>
                                <option>&equals;</option>
                                <option>&lt;&equals;</option>
                                <option>&gt;&equals;</option>
                                <option>&lt;</option>
                                <option>&gt;</option>
                            </select>
                            <input type="number" class="form-control km" placeholder="Km">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Adet</label>
                        <div class="input-group">
                            <select class="form-control quantity_if">
                                <option value="">Seçim Yapınız</option>
                                <option>&equals;</option>
                                <option>&lt;&equals;</option>
                                <option>&gt;&equals;</option>
                                <option>&lt;</option>
                                <option>&gt;</option>
                            </select>
                            <input type="number" class="form-control quantity" placeholder="Adet">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Fiyat</label>
                        <div class="input-group">
                            <select class="form-control price_if">
                                <option value="">Seçim Yapınız</option>
                                <option>&equals;</option>
                                <option>&lt;&equals;</option>
                                <option>&gt;&equals;</option>
                                <option>&lt;</option>
                                <option>&gt;</option>
                            </select>
                            <input type="number" class="form-control price" placeholder="Fiyat">
                        </div>
                    </div>
                </div>




                <div class="col-md-3">
                    <div class="form-group">
                        <label>Renk</label>
                        <select class="form-control renk">

                        </select>
                    </div>
                </div>






            </div>
            <div class="row">
                <div class="col">
                    <button type="button" id="filtered" class="btn btn-success btn-sm w-100">FİLTRELE</button>
                </div>
            </div>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Marka</th>
                        <th>Adet</th>
                        <th>Km</th>
                        <th>Fiyat</th>
                        <th>Renk</th>
                        <th>İşlemler</th>
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
    <script src="{{ asset(mix('js/products_filtered.js')) }}"></script>
@endsection
