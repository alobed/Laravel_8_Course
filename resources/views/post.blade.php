@extends ('layout')

@section('content')
<article>
    <div>
        {!!  $post->title !!}
    </div>    
   

        <div>
            {!! $post->body !!}
    </div>
    </article>

    <a href="/">Go Back</a>
@endsection
