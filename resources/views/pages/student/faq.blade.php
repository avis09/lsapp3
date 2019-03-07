@extends('layouts.dashboard-master')

@section('title')
    <title>Users | ITD Bros</title>
@endsection

@section('css')
    <style>
        .modal-title{
            font-size: 18px;
            font-weight: 500;
        }
        .card-faq{
            cursor: pointer;
        }
    </style>
@endsection

@section('content')

<main class="app-content">
        <div class="app-title">
          <div>
            <h1><i class="fa fa-dashboard"></i> FAQs</h1>
            {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">FAQs</a></li>
          </ul>
        </div>
       <div class="container mb-5">
            <div class="row">
                <div class="col-md-12">
                        <div id="accordion" class="faq-section" role="tablist" aria-multiselectable="true">
    
                                <div class="card">
                                  <div class="card-header  card-header-accordion card-faq" id="heading1"  data-toggle="collapse" data-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                    <h5 class="faq-question mb-0">
                                        Question 1
                                    </h5>
                                  </div>

                                  <div id="faq1" class="collapse" aria-labelledby="heading1">
                                    <div class="card-body">
                                        Answer 1
                                    </div>
                                  </div>
                                </div>
                        </div>
                        <div id="accordion" class="faq-section" role="tablist" aria-multiselectable="true">
    
                                <div class="card">
                                  <div class="card-header  card-header-accordion card-faq" id="heading1"  data-toggle="collapse" data-target="#faq2" aria-expanded="true" aria-controls="faq2">
                                    <h5 class="faq-question mb-0">
                                        Question 1
                                    </h5>
                                  </div>

                                  <div id="faq2" class="collapse" aria-labelledby="heading2">
                                    <div class="card-body">
                                        Answer 1
                                    </div>
                                  </div>
                                </div>
                        </div>
                </div>
            </div>
        </div>
</main>
    
    @endsection

    @section('scripts')
    <script>
        $(document).ready(function(){
            $('#menu-faqs').addClass('active'); 
        });
    </script>
    @endsection


