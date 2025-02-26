@extends('layouts.app')
@section('content')
    <section>

        <h1 class="h4 mb-4">
            Tableau de bord
        </h1>


        <div class="row">
            <div class="col-lg-4">
                <div class="card-dash mb-4" style="height: 200px;">
                    <h6>
                        Chiffre d'affaires
                    </h6>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card-dash mb-4" style="height: 200px;">
                    <h6>
                        Rendez-vous

                    </h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card-dash mb-4" style="height: 200px;">
                    <h6>
                        Top clients

                    </h6>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card-dash mb-4" style="height: 200px;">
                    <h6>
                        Les prestations les plus réservées

                    </h6>
                </div>
            </div>
        </div>

    </section>
@endsection
