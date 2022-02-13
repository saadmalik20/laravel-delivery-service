@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Parcels</h1>
        <h1 class="pull-right">
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table" id="parcels-table">
                        <thead>
                        <tr>
                            <th>Pick Up</th>
                            <th>Status</th>
                            <th>Assigned to</th>
                            <th>Assigned at</th>
                            <th>Pickup at</th>
                            <th>Delivered at</th>
                        </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
@section('scripts')
@stop

