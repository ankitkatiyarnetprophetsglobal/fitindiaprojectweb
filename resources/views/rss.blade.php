{{-- {{ dd(987654) }} --}}
<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
    <channel>
        <title><![CDATA[ fitindia ]]></title>
        <link><![CDATA[ https://fitindia.gov.in/feed ]]></link>
        <description><![CDATA[ fitindia.gov.in ]]></description>
        <language>en</language>
        <pubDate>{{ now()->toRssString() }}</pubDate>        
  
        @foreach($posts as $post)
            {{-- {{ dd($post->id) }} --}}
            <item>
                <title>{{ $post->title }}</title>
                {{-- <link>{{ $post->slug }}</link> --}}
                {{-- <link>{{ url('api/get-post-details-view/'.$post->id) }}</link> --}}
                <link>{{ url('api/get-post-details-rss-view/'.encrypt($post->id)) }}</link>                
                <description><![CDATA[{!! mb_strimwidth($post->description, 0, 200, "..."); !!}]]></description>
                <category>{{ $post->category }}</category>
                {{-- <author>Pavel Zaněk</author> --}}
                {{-- <guid>{{ $post->id }}</guid> --}}
                <pubDate>{{ $post->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach

        
    </channel>
</rss>