@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Dashboard')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
@section('content')
    <div class="page-content page-container content d-flex flex-column flex-column-fluid mt-5" id="page-content">
        <div class="row container d-flex justify-content-center">
            <div class="col-sm-12 mt-5">
                <div class="card mt-5">
                    <div class="card-block">
                        <div class="container">
                            <div class="row" id="sortable">
                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="text-right">
                                            <div class="edit-cog" data-toggle="modal" data-target="#customizeModal"
                                                onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Please configure this card</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="text-right">
                                            <div class="edit-cog" data-toggle="modal" data-target="#customizeModal"
                                                onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Please configure this card</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="text-right">
                                            <div class="edit-cog" data-toggle="modal" dbata-target="#customizeModal"
                                                onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Please configure this card</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="text-right">
                                            <div class="edit-cog" data-toggle="modal" data-target="#customizeModal"
                                                onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Please configure this card</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="text-right">
                                            <div class="edit-cog" data-toggle="modal" data-target="#customizeModal"
                                                onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Please configure this card</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="text-right">
                                            <div class="edit-cog" data-toggle="modal" data-target="#customizeModal"
                                                onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Please configure this card</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="text-right">
                                            <div class="edit-cog" data-toggle="modal" data-target="#customizeModal"
                                                onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Please configure this card</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="text-right">
                                            <div class="edit-cog" data-toggle="modal" data-target="#customizeModal"
                                                onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Please configure this card</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="text-right">
                                            <div class="edit-cog" data-toggle="modal" data-target="#customizeModal"
                                                onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Please configure this card</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="text-right">
                                            <div class="edit-cog" data-toggle="modal" data-target="#customizeModal"
                                                onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Please configure this card</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="text-right">
                                            <div class="edit-cog" data-toggle="modal" data-target="#customizeModal"
                                                onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Please configure this card</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="text-right">
                                            <div class="edit-cog" data-toggle="modal" data-target="#customizeModal"
                                                onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Please configure this card</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('scripts')
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            $("#sortable").sortable();
            $("#sortable").disableSelection();
        });
    </script>
@endsection
@endsection
