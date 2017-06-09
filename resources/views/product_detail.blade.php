@extends('layouts.side')

@section('title', 'Create Product')

@section('content')

    <div class="content">
      <div class="container">
        <div class="row">
          <center>
            <div class="col-sm-10">
              <div class="text-center">
                  <a href="index.html" class="logo"><span>NEKANEKA</span></span></a>
                  <h5 class="text-muted m-t-0 font-600">Product</h5><br/>
                </div>
                <div class="col-sm-offset-2 col-sm-7">
                  <form class="form-horizontal" role="form" method="POST" action="{{ URL('createproduct/submit') }}" accept-charset="UTF-8">
                                    {{ csrf_field() }}
                    <div class="form-group">
                      <label class="col-md-2 control-label">Nomor ID</label>
                        <div class="col-md-10">
                          <input type="text" name="nomorid" class="form-control" placeholder="Agent ID">
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">Title</label>
                      <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" placeholder="Title">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Kategori</label>
                        <div class="col-md-10">
                          <select class="form-control" name="kategori" id="kategori">
                            <option>1</option>
                          </select>
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-2">Date Range</label>
                        <div class="col-sm-10">
                          <div class="input-daterange input-group" id="date-range">
                            <input type="text" name="start_date" class="form-control" name="start" />
                              <span class="input-group-addon bg-primary b-0 text-white">to</span>
                                <input type="text" name="end_date" class="form-control" name="end" />
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                      <label class="col-sm-2 control-label">Provinsi</label>
                        <div class="col-md-10">
                          <select class="form-control" name="provinsi" id="provinsi">
                            <option>1</option>
                          </select>
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Kota</label>
                        <div class="col-md-10">
                          <select class="form-control" name="kota" id="kota">
                            <option>1</option>
                          </select>
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">Pickup Point</label>
                      <div class="col-sm-10">
                        <input type="text" name="pickuppoint" class="form-control" placeholder="Pickup Point">
                      </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">End Point</label>
                      <div class="col-sm-10">
                        <input type="text" name="endpoint" class="form-control" placeholder="End Point">
                      </div>
                    </div>

                       <div class="form-group">
                        <label class="col-md-2 control-label">Itinerary</label>
                        <div class="col-md-10">
                            <textarea class="form-control" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">Peserta</label>
                      <div class="col-sm-10">
                        <input type="text" name="peserta" class="form-control" placeholder="">
                      </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">Price</label>
                      <div class="col-sm-10">
                        <input type="text" name="price" id="price" class="form-control" placeholder=""><p id="harga"></p>
                      </div>
                    </div>

                    <div class="container">
                      <div class="row">
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Foto</label>
                          <div class="col-sm-10">
                              <div class="card-box">
                                <input type="file" name="foto" class="dropify" data-height="200" />
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">Description</label>
                      <div class="col-sm-10">
                        <input type="text" name="description" class="form-control" placeholder="Description">
                      </div>
                    </div>
                    </div>                    
                    <div class="form-group text-center">
                      <div class="col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-xs-6 col-sm-6 col-md-6 tombol-submit">
                        <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">
                          Submit
                        </button>
                      </div>
                    </div>

                  </form>
                </div>
            </div>
          </center>
        </div>
      </div>
@stop