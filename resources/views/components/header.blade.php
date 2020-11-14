<div>
    <h1>Hello {{ $name }}</h1>
    @foreach($fruits as $fruit)
    	<p>{{ $fruit }}</p>
    @endforeach
</div>