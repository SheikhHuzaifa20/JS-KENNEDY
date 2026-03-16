@component('mail::message')
# {{ $blog->name }}

{{ $blog->short_detail }}

@isset($blog->image)
<img src="{{ url($blog->image) }}" alt="{{ $blog->name }}" style="max-width:100%; height:auto; margin-top:10px;">
@endisset

@component('mail::button', ['url' => url('/blog-detail/' . $blog->id)])
Read Full Blog
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent