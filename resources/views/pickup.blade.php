@extends('layouts.app')


@section('content')


  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <p class="text-uppercase text-sm">Parsel details</p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Username</label>
                  <input class="form-control" type="text" value="lucky.jesse">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Email address</label>
                  <input class="form-control" type="email" value="jesse@example.com">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">First name</label>
                  <input class="form-control" type="text" value="Jesse">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Last name</label>
                  <input class="form-control" type="text" value="Lucky">
                </div>
              </div>
            </div>
            <hr class="horizontal dark">
            <p class="text-uppercase text-sm">Contact Information</p>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Address</label>
                  <input class="form-control" type="text" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">City</label>
                  <input class="form-control" type="text" value="New York">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Country</label>
                  <input class="form-control" type="text" value="United States">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Postal code</label>
                  <input class="form-control" type="text" value="437300">
                </div>
              </div>
            </div>
            <hr class="horizontal dark">
            <p class="text-uppercase text-sm">About me</p>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">About me</label>
                  <input class="form-control" type="text" value="A beautiful Dashboard for Bootstrap 5. It is Free and Open Source.">
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
              $.ajax({
                type:'GET',
                dataType:'json',
                url:"api/parcels",
                headers: {"Authorization": "Bearer " + getuserData().token},
                success:function(response){
                  populateParcels(response.data);
                },
                error:function (error) {
                  alert(error);
                }
              });
          });

          function populateParcels(response)
          {
            var innerHtml = '';
            if(!response.length) {
              innerHtml = `<tr><td colspan="8" align="center">No more parcels</td></tr>`;
            } else {
              $.each(response, function (index, value) {
                innerHtml += `<tr id=${value.id}>
                <td>${value.pickup_address}</td>
                <td>${value.delivery_address}</td>
                <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm bg-gradient-success">${value.status}</span>
                </td>
                <td>${value.biker_id ? value.biker_id : 'Not Picked'}</td>
                <td>${value.pickup_time ? value.pickup_time: '-'}</td>
                </tr>`;
              });
              $('#parcels-table tbody').html(innerHtml);
            }
            $('#parcels-table tbody').html(innerHtml);
          }

        </script>


@endsection