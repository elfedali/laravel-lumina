@extends('layouts.app')
@section('content')
    <section>

        <h1 class="h4 mb-4">
            Dashboard
        </h1>


        <div class="row">
            <div class="col-lg-4">
                <div class="card-dash mb-4" style="height: 200px;">
                    <h6>
                        Revenue
                    </h6>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card-dash mb-4" style="height: 200px;">
                    <h6>
                        Appointments

                    </h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card-dash mb-4" style="height: 200px;">
                    <h6>
                        Top Clients

                    </h6>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card-dash mb-4" style="height: 200px;">
                    <h6>
                        Most Booked Services

                    </h6>
                </div>
            </div>
        </div>

    </section>
@endsection
