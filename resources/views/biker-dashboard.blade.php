@extends('layouts.app')


@section('content')

        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Parcels List</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0" id="parcels-table">
                <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sender</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pick Up</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Drop off</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-secondary opacity-7">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                </tr>
                </tbody>
              </table>
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
                if(value.status  == 'picked')
                  var statusClass = 'bg-gradient-success';
                else
                  var statusClass = 'bg-gradient-secondary';

                innerHtml += `<tr id=${value.id}>
                <td>${value.sender_name}</td>
                <td>${value.pickup_address}</td>
                <td>${value.delivery_address}</td>
                <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm ${statusClass}">${value.status}</span>
                </td>
                <td class="align-middle text-center ">
                    <a href="#_" onclick="return confirm('Do you want to pick this order?')? pickorder('${value.id}'):'';" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Pick Now">
                      ${value.pickup_time ? '': 'Pick Now'}
                    </a>
                  </td>
                </tr>`;
              });
              $('#parcels-table tbody').html(innerHtml);
            }
            $('#parcels-table tbody').html(innerHtml);
          }

          function pickorder(id)
          {
            if(id != undefined || id != null) {
              $.ajax({
                type: 'PUT',
                url: "api/parcel/pick/" + id,
                headers: {"Authorization": "Bearer " + getuserData().token},
                success: function (response) {
                  alert(response.message);
                  window.location.reload();
                },
                error: function (error) {
                  alert(error);
                }
              });
            }
            else
            {
              alert("Invalid pickup order");
            }
          }

        </script>


@endsection