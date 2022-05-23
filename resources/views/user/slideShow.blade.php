


<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    @if($productImage)
    @if($productImage->pathOne)
    <div class="carousel-item active w-100">
      <img id="imageIndex" src="{{ Storage::disk('s3')->url($productImage->pathOne) }}" class="d-block " style="height: 400px; width:400px;" alt="...">
    </div>
    @endif
    @if($productImage->pathTwo)
    <div class="carousel-item">
      <img id="imageIndex" src="{{ Storage::disk('s3')->url($productImage->pathTwo) }}" class="d-block " style="height: 400px; width:400px;" alt="...">
    </div>
    @endif
    @if($productImage->pathThree)
    <div class="carousel-item">
      <img id="imageIndex" src="{{ Storage::disk('s3')->url($productImage->pathThree) }}" class="d-block " style="height: 400px; width:400px;" alt="...">
    </div>
    @endif
    @endif
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
