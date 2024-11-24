{{-- Add required CSS & JS to the frontend stack --}}
@pushOnce('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">
@endPushOnce
@pushOnce('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>
        hljs.highlightAll()
    </script>
@endPushOnce

<div>
    <pre>
        <code class="language-{{ $language }}">{{ $code }}</code>
    </pre>
</div>