<x-layout>
    <x-slot name='title'>Rapido - {{$category->name}} ads</x-slot>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Ads by category: {{$category->name}}</h1>
            </div>
        </div>
        <div class="row">
            @forelse($category->ads()->latest()->get() as $ad)
            <div class="col-12 col-md-4">
                <div class="card mb-5">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"> {{$ad->title}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{$ad->price}}</h6>
                        <p class="card-text"> {{$ad->body}}</p>
                        <div class="card-subtitle mb-2">
                            <strong><a href="#">#{{$category->name}}</a></strong>
                            <i>{{$ad->created_at->format('d/m/Y')}}</i>
                        </div>
                        <div class="card-subtitle mb-2">
                            <small>{{ $ad->user->name }}</small>
                        </div> 
                        <a href="#" class="btn btn-primary">Show</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <h2>Woops.. No ads found by this category</h2>
                <a href="{{route('ads.create')}}" class="btn btn-success">Sell your first item</a> or <a href="{{route('home')}}" class="btn btn-primary">Back to home</a> 
            </div>
            @endforelse
        </div>
    </div>
</x-layout>
