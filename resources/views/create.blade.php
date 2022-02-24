@extends('layouts.app')


@section('content')


  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <p class="text-uppercase text-sm">Parcel details</p>

            <div class="alert alert-danger alert-dismissible fade" id=error-field role="alert">
                <span class="alert-icon"><i class=""></i></span>
                <span class="alert-text"></span>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Pick up location</label>
                  <input class="form-control" type="text" id="pickup_address">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Drop off location</label>
                  <input class="form-control" type="text" id="delivery_address">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="text-center">
                  <button type="button" class="btn btn-lg btn-primary btn-lg w-200 mt-4 mb-0 btn-submit">Create</button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    
  </div>

        <script type="text/javascript">

          $(document).ready(function () {
            $('.btn-submit').click(function() {
               $.ajax({
                 type: 'POST',
                 dataType: 'json',
                 data: {"pickup_address" : $('#pickup_address').val(), "delivery_address": $('#delivery_address').val()},
                 url:'/api/parcel',
                 headers: {"Authorization": "Bearer " + getuserData().token},
                 success:function(response) {
                   alert("parcel created successfully");
                  window.location.href = '/sender'
                 },
                 error:function (error) {
                   $('#error-field').addClass('show');
                   $('#error-field .alert-text').html(error.responseJSON.message)
                }
               });
            });
          });
        </script>


@endsection