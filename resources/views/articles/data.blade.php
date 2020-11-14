@foreach($articles as $article)
	<div class="card" style="margin-bottom: 50px;">
	    <div class="card-header">
	        <h3>{{ $article->title }}</h3>
	    </div>
	    <div class="card-body">
	       <p> {{ $article->body }}</p>
	       <span>{{ $article->author }}</span>
	       <div>
	       		<button class="btn btn-success">Read More...</button>
	       </div>
	    </div>
	</div>
@endforeach