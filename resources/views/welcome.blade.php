<x-layout>
    <x-slot name='title'>Rapido - Homepage</x-slot>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Welcome to Rapido</h1>
            </div>
        </div>
        <div class="row">
            @foreach($ads as $ad)
            <div class="col-12 col-md-4">
                <div class="card mb-5">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"> {{$ad->title}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{$ad->price}}</h6>
                        <p class="card-text"> {{$ad->body}}</p>
                        <div class="card-subtitle mb-2">
                            <strong><a href="#">#{{$ad->category->name}}</a></strong>
                            <i>{{$ad->created_at->format('d/m/Y')}}</i>
                        </div>
                        <div class="card-subtitle mb-2">
                            <small>{{ $ad->user->name }}</small>
                        </div> 
                        <a href="#" class="btn btn-primary">Show</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


</x-layout>
