@extends ('layouts/all')
@include('essencials/nav')

@section('sidebar')
<div id="mySidebar">
    <div class="row">
        <a href="#">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
    </div>
</div>

@endsection


@section('banner')
<div class="row">
    <div class="col">
        <div id="calendar"></div>
    </div>

    <div class="col">
    
    </div>

</div>

@endsection 



@include('essencials/footer')