<{{ $level }} @class([
    'font-bold leading-tight',
    'font-3xl' => $level == 'h1',
    'font-2xl' => $level == 'h2',
    'font-xl' => $level == 'h3',
    'font-lg' => $level == 'h4',
    'font-base' => $level == 'h5',
    'font-sm' => $level == 'h6',
])>{{ $content }}</{{ $level }}>