@extends('layouts.userApp')

@section('title', 'Online Shop Contact')

@section('content')
  <div class="d-flex flex-column w-100 h-100 mt-4">

    <div class="d-flex flex-row w-100 h-25 justify-content-center mt-2  p-2" >
      <div id="infoBar" class="container d-flex flex-row border bg-light w-50 p-0">
        
        <div  class="container d-flex flex-row align-items-center w-25 me-0 ">
          <a id="backButtonSearch" class="d-flex flex-row-reverse link-primary w-100 h-75 border-end border-primary fs-4 ms-2 align-items-center" href="{{ route('user.index') }}">
            <i id="backButtonIcon" class="bi bi-backspace-fill me-2" style="font-size: 2rem;"></i>
          </a>
        </div>
      
        <div class="container d-flex flex-row align-items-center w-75 ms-0">
          <h5 id="textSearch" class="d-flex flex-column align-items-center p-2 mt-1">Results based on your search</h5>
        </div>
  
      </div>
    </div>
  
  
  </div>

  <div class="d-flex flex-row w-100 h-100  mt-4 justify-content-center ">

    <ul class="list-group list-group-flush m-4 ">
      <li class="list-group-item">SERVICII PENTRU CLIENTI</li>
      <li class="list-group-item">Deschiderea coletului la livrare</li>
      <li class="list-group-item">30 de zile drept de retur</li>
      <li class="list-group-item">Plata cu cardul indisponibila</li>
      <li class="list-group-item">Plata efectuata doar ramburs</li>
      <li class="list-group-item">Garantii si service</li>
      <li class="list-group-item">Black Friday Store Online</li>
    </ul>

    <ul class="list-group list-group-flush m-4 ">
      <li class="list-group-item">SERVICII PENTRU CLIENTI</li>
      <li class="list-group-item">Livrarea comenzilor</li>
      <li class="list-group-item">Store Online Corporate</li>
      <li class="list-group-item">Store Online Marketplace</li>
      <li class="list-group-item">Modalitati de plata</li>
    </ul>

    <ul class="list-group list-group-flush m-4 ">
      <li class="list-group-item">Formular reparatie produs</li>
      <li class="list-group-item">Formular returnare produs</li>
      <li class="list-group-item">Contact (235) 887-6818</li>
      <li class="list-group-item">Conditii generale privind furnizarea serviciilor postale</li>
      <li class="list-group-item">ANPC</li>
      <li class="list-group-item">ANPC - SAL</li>
    </ul>

    <ul class="list-group list-group-flush m-4 ">
      <li class="list-group-item">Vreau sa vand pe Store Online</li>
      <li class="list-group-item">Termene si conditii</li>
      <li class="list-group-item">Prelucrarea datelor cu caracter persona</li>
      <li class="list-group-item">Politica de utilizare cookie-uri</li>
      <li class="list-group-item">Solutionarea Online a litigiilor</li>
    </ul>

  </div>

  <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center mt-4">
    <div class="d-flex flex-row w-75 h-100 bg-light shadow-sm justify-content-center align-items-center p-2 m-4 rounded-1">
      <p class="fs-4 ">Latest products in Store Online</p>
    </div>
  </div>
    
    @if($products)
      <div class="d-flex flex-row w-100 h-100 justify-content-center">
      <div class="d-flex flex-row w-75 h-100 flex-wrap m-4  justify-content-center">
      @foreach ($products as $product)
      <div class="d-flex flex-column border m-4 bg-light rounded-1 shadow " style="width:170px; height:300px;">
        <a class="d-flex flex-column align-items-center w-100" style="height: 270px;" href=" {{ route('user.show', $product->id) }}">
          <div class="d-flex flex-column align-items-center justify-content-center w-100" style="height: 220px;">
            Image
          </div>
          <div class="d-flex " style="height: 25px">
            {{ $product->name }}
          </div>
          <div class="d-flex flex-row ustify-content-center "style="height: 25px">
            {{ $product->price }}
            <h4>Lei</h4>
          </div>
        </a>
        <form class="d-flex flex-row justify-content-center w-100" style="height: 30px" action="{{ route('user.index.addCart', $product->id) }}" method="POST">
          @csrf
          <input class="btn btn-warning w-100 h-100 text-white " type="submit" value="Add Cart">
        </form>
      </div>
      @endforeach
      </div>
    </div>
    @endif
  @endsection