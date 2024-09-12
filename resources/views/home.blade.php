@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Dashboard')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
@section('styles')
    <style>
        .stretch-card>.card {
            width: 100%;
            min-width: 100%
        }

        body {
            background-color: #f9f9fa
        }

        .flex {
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto
        }

        @media (max-width:991.98px) {
            .padding {
                padding: 1.5rem
            }
        }

        @media (max-width:767.98px) {
            .padding {
                padding: 1rem
            }
        }

        .padding {
            padding: 3rem !important
        }

        .card-sub {
            cursor: move;
            border: none;
            -webkit-box-shadow: 0 0 1px 2px rgba(0, 0, 0, 0.05), 0 -2px 1px -2px rgba(0, 0, 0, 0.04), 0 0 0 -1px rgba(0, 0, 0, 0.05);
            box-shadow: 0 0 1px 2px rgba(0, 0, 0, 0.05), 0 -2px 1px -2px rgba(0, 0, 0, 0.04), 0 0 0 -1px rgba(0, 0, 0, 0.05)
        }

        .card-img-top {
            width: 100%;
            height: 180px;
            border-top-left-radius: calc(.25rem - 1px);
            border-top-right-radius: calc(.25rem - 1px)
        }

        .card-block {
            padding: 1.25rem;
            background-color: #fff !important
        }
    </style>
@endsection
@section('content')
    <div class="page-content page-container content d-flex flex-column flex-column-fluid" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="container mt-4">
                                <div class="row" id="sortable">
                                    <div class="col-md-6 mb-4">
                                        <div class="card h-100">
                                            <div class="text-right">
                                                <div class="edit-cog" data-toggle="modal" data-target="#customizeModal" onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                            </div>
                                            <img class="card-img-top img-fluid" src="{{asset('assets/media/books/card1.jpeg')}}" alt="Product 1">
                                            <div class="card-body">
                                                <h4 class="card-title">Product 1</h4>
                                                <p class="card-text">For what reason would it be advisable for me to think about business content?</p>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-md-6 mb-4">
                                        <div class="card h-100">
                                            <div class="text-right">
                                                <div class="edit-cog" data-toggle="modal" data-target="#customizeModal" onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                            </div>
                                            <img class="card-img-top img-fluid" src="{{asset('assets/media/books/card1.jpeg')}}" alt="Product 2">
                                            <div class="card-body">
                                                <h4 class="card-title">Product 2</h4>
                                                <p class="card-text">For what reason would it be advisable for me to think about business content?</p>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-md-6 mb-4">
                                        <div class="card h-100">
                                            <div class="text-right">
                                                <div class="edit-cog" data-toggle="modal" data-target="#customizeModal" onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                            </div>
                                            <img class="card-img-top img-fluid" src="{{asset('assets/media/books/card1.jpeg')}}" alt="Product 3">
                                            <div class="card-body">
                                                <h4 class="card-title">Product 3</h4>
                                                <p class="card-text">For what reason would it be advisable for me to think about business content?</p>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-md-6 mb-4">
                                        <div class="card h-100">
                                            <div class="text-right">
                                                <div class="edit-cog" data-toggle="modal" data-target="#customizeModal" onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                            </div>
                                            <img class="card-img-top img-fluid" src="{{asset('assets/media/books/card1.jpeg')}}" alt="Product 12">
                                            <div class="card-body">
                                                <h4 class="card-title">Product 4</h4>
                                                <p class="card-text">For what reason would it be advisable for me to think about business content?</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="card h-100">
                                            <div class="text-right">
                                                <div class="edit-cog" data-toggle="modal" data-target="#customizeModal" onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                            </div>
                                            <img class="card-img-top img-fluid" src="{{asset('assets/media/books/card1.jpeg')}}" alt="Product 1">
                                            <div class="card-body">
                                                <h4 class="card-title">Product 5</h4>
                                                <p class="card-text">For what reason would it be advisable for me to think about business content?</p>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-md-6 mb-4">
                                        <div class="card h-100">
                                            <div class="text-right">
                                                <div class="edit-cog" data-toggle="modal" data-target="#customizeModal" onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                            </div>
                                            <img class="card-img-top img-fluid" src="{{asset('assets/media/books/card1.jpeg')}}" alt="Product 2">
                                            <div class="card-body">
                                                <h4 class="card-title">Product 6</h4>
                                                <p class="card-text">For what reason would it be advisable for me to think about business content?</p>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-md-6 mb-4">
                                        <div class="card h-100">
                                            <div class="text-right">
                                                <div class="edit-cog" data-toggle="modal" data-target="#customizeModal" onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                            </div>
                                            <img class="card-img-top img-fluid" src="{{asset('assets/media/books/card1.jpeg')}}" alt="Product 3">
                                            <div class="card-body">
                                                <h4 class="card-title">Product 7</h4>
                                                <p class="card-text">For what reason would it be advisable for me to think about business content?</p>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-md-6 mb-4">
                                        <div class="card h-100">
                                            <div class="text-right">
                                                <div class="edit-cog" data-toggle="modal" data-target="#customizeModal" onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                            </div>
                                            <img class="card-img-top img-fluid" src="{{asset('assets/media/books/card1.jpeg')}}" alt="Product 12">
                                            <div class="card-body">
                                                <h4 class="card-title">Product 8</h4>
                                                <p class="card-text">For what reason would it be advisable for me to think about business content?</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="card h-100">
                                            <div class="text-right">
                                                <div class="edit-cog" data-toggle="modal" data-target="#customizeModal" onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                            </div>
                                            <img class="card-img-top img-fluid" src="{{asset('assets/media/books/card1.jpeg')}}" alt="Product 1">
                                            <div class="card-body">
                                                <h4 class="card-title">Product 9</h4>
                                                <p class="card-text">For what reason would it be advisable for me to think about business content?</p>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-md-6 mb-4">
                                        <div class="card h-100">
                                            <div class="text-right">
                                                <div class="edit-cog" data-toggle="modal" data-target="#customizeModal" onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                            </div>
                                            <img class="card-img-top img-fluid" src="{{asset('assets/media/books/card1.jpeg')}}" alt="Product 2">
                                            <div class="card-body">
                                                <h4 class="card-title">Product 10</h4>
                                                <p class="card-text">For what reason would it be advisable for me to think about business content?</p>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-md-6 mb-4">
                                        <div class="card h-100">
                                            <div class="text-right">
                                                <div class="edit-cog" data-toggle="modal" data-target="#customizeModal" onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                            </div>
                                            <img class="card-img-top img-fluid" src="{{asset('assets/media/books/card1.jpeg')}}" alt="Product 3">
                                            <div class="card-body">
                                                <h4 class="card-title">Product 11</h4>
                                                <p class="card-text">For what reason would it be advisable for me to think about business content?</p>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-md-6 mb-4">
                                        <div class="card h-100">
                                            <div class="text-right">
                                                <div class="edit-cog" data-toggle="modal" data-target="#customizeModal" onclick="setCurrentGrid('grid1')"><i class="fa fa-cog"></i></div>
                                            </div>
                                            <img class="card-img-top img-fluid" src="{{asset('assets/media/books/card1.jpeg')}}" alt="Product 12">
                                            <div class="card-body">
                                                <h4 class="card-title">Product 12</h4>
                                                <p class="card-text">For what reason would it be advisable for me to think about business content?</p>
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
