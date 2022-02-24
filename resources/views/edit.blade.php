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
                  <p  id="pickup_address">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Drop off location</label>
                  <p id="delivery_address">
                </div>
              </div>
            </div>
            <div class="row" id="pickup_row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Pickup time</label>
                  <input type="text" id="pickup_time">
                </div>
              </div>
            </div>
            <div class="row" id="delivery_row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Delivery Time</label>
                  <input type="text" id="delivery_time">
                </div>
              </div>
            </div>

            <div class="row" >
              <div class="col-md-4">
                <div class="text-center">
                  <button type="button" class="btn btn-lg btn-primary btn-lg w-200 mt-4 mb-0 btn-submit">Update</button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    
  </div>
  @endsection
  @section('scripts')

        <script type="text/javascript">
        $('#pickup_time').datetimepicker({
          mask:'9999/19/39 29:59',
          minDate: 'yesterday'
        });

        $('#delivery_time').datetimepicker({
          mask:'9999/19/39 29:59',
          minDate: 'yesterday'
        });

          $(document).ready(function () {
          $('#pickup_row,#delivery_row').hide();
           $.ajax({
             type: 'GET',
             dataType: 'json',
             url: '/api/parcel/{{$id}}',
             headers: {"Authorization": "Bearer " + getuserData().token},
            success:function(response) {
              if (response.data.status == 'waiting') {
                alert('parcel not assigned');
                return false;
              } else {
                $('#pickup_address').text(response.data.pickup_address);
                $('#delivery_address').text(response.data.delivery_address);
              }
              if(response.data.status == 'selected') {
                $('#pickup_row').show();
              }
              if(response.data.status == 'picked') {
                $('#delivery_row').show();
              }
            },
            error:function (error) {
              $('#error-field').addClass('show');
              $('#error-field .alert-text').html(error.responseJSON.message)
            }
          });
        });

        $('.btn-submit').click(function() {
          $.ajax({
            type: 'PUT',
            dataType: 'json',
             url: '/api/parcel/{{$id}}',
             data: {"pickup_time" : $('#pickup_time').val(), "delivery_time": $('#delivery_time').val()},
             headers: {"Authorization": "Bearer " + getuserData().token},
            success:function(response) { 
              window.location.href = "/biker";
            },
            error:function (error) {
              $('#error-field').addClass('show');
              $('#error-field .alert-text').html(error.responseJSON.message)
            }
          })
        });
        </script>


@stop