@extends ('layout')
@section('content')
    <h1>Property name {{ $property->name }}</h1>
    <form action="{{ url()->previous() }}" class="d-flex justify-content-around my-3" method="GET">
        <button type="submit" class="btn btn-primary btn-sm">Go Back</button>
        @if ($property->status != 'sold out')
            <a href="{{ route('property.gosoldout', $property->id) }}" class="btn btn-primary btn-sm">sold out</a>
        @endif
        <a href="{{ route('property.shares', $property->id) }}" class="btn btn-primary btn-sm">shares</a>
    </form>
    <div class="slideshow-container border border-black">
        @foreach ($property->images as $key => $image)
            <div class="mySlides faded">
                <div class="numbertext">{{ $key + 1 }} / {{ count($property->images) }}</div>
                <img src="{{ url('uploads/' . $image) }}" style="width:100%">
            </div>
        @endforeach
        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>
    <!-- The dots/circles -->
    <div style="text-align:center">
        @for ($i = 0; $i < count($property->images); $i++)
            <span class="dot" onclick='currentSlide({{ $i + 1 }})'></span>
        @endfor
    </div>
    <hr>
    <p>{{ $property->description }}</p>
    <hr>
    <p>estimated Annualised return = {{ $property->estimated_annualised_return }}%</p>
    <p>estimated Annual appreciation = {{ $property->estimated_annual_appreciation }}%</p>
    <p>estimated projected gross yield = {{ $property->estimated_projected_gross_yield }}%</p>
    <p>annual gross yield = {{ $property->percent }}%</p>
    <hr>
    <p>funded date = {{ $property->funded_date }}</p>
    <hr>
    <p>current rent = {{ $property->current_rent }}</p>
    <p>Service charge = {{ $property->service_charge }}</p>
    <p>rental income paid = {{ $property->rental_income }}</p>
    <p>purchase price = {{ $property->purchase_price }}</p>
    <p>property price = {{ $property->property_price_total }}</p>
    <p>share price = {{ $property->property_price }}</p>
    <hr>
    @if ($property->timelines->count() > 0)
        <div class="timeline">
            <h3 class="mb-5">timelines</h3>
            @foreach ($property->timelines as $timeline)
                <div class="">
                    <h3>{{ $timeline->date }}</h3>
                    <h1>{{ $timeline->title }}</h1>
                    <p>{{ $timeline->description }}</p>
                </div>
            @endforeach
        </div>
    @endif
    </div>
@endsection
