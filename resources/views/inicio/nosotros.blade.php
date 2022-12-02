@extends('layouts.common')
@section('headers')
@endsection
@section('content')
<!-- Page Heading -->
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nosotros
        </h2>
    </div>
</header>

<!-- Page Content -->
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="row">
                    <div class="col-sm-12 col-lg-6" style="display: inline-block;">
                        <img class="col-lg-12" style="border: 2px solid #700000; height:200px; width:auto; margin:0 auto; box-shadow: 0px 6px 16px 0px rgba(0,0,0,0.48);"  src="{{asset('storage/images/logo_davids.jpeg')}}">
                    </div>
                    <div class="col-sm-12 col-lg-6" style="display: inline-block;">
                        <img class="col-lg-12" style="border: 2px solid #700000; height:200px; width:auto; margin:0 auto; box-shadow: 0px 6px 16px 0px rgba(0,0,0,0.48);" src="{{asset('storage/images/logo.png')}}">
                    </div>
                </div>
                <h5 class="separtor"></h5>
                <div class="row">
                    <div class="col-sm-12 col-lg-6"  style="display: inline-block;">
                        <!--Carrusel de fotos DAVID's -->
                        <div id="carouselExampleControlsD" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                              
                              <div class="carousel-item active">
                                <img class="d-block w-100" src="{{asset('storage/images/fotosdavids/mision2.png')}}" alt="Second slide">
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset('storage/images/fotosdavids/vision2.png')}}" alt="fourth slide">
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset('storage/images/fotosdavids/politica_calidad_davids.png')}}" alt="Fifth slide">
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset('storage/images/fotosdavids/objetivos.png')}}" alt="Fifth slide">
                              </div>
                                                         
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControlsD" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControlsD" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                          </div>
    
                    </div>  
                    <div class="col-sm-12 col-lg-6" style="display: inline-block;">                        
                        <!--Carrusel de fotos ECEX -->
                        <div id="carouselExampleControlsE" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img class="d-block w-100" src="{{asset('storage/images/fotosecex/mision2.png')}}" alt="Second slide">
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset('storage/images/fotosecex/vision2.png')}}" alt="Fourth slide">
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset('storage/images/fotosecex/politica_calidad_ecex.png')}}" alt="5th slide">
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset('storage/images/fotosdavids/objetivos.png')}}" alt="Fifth slide">
                              </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControlsE" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControlsE" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                          </div>
                </div>
            </div><!--Este es el último-->
        </div>
    </div>
</div>

@endsection