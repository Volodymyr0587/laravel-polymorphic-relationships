<!DOCTYPE html>
<html>

<head>
    <title>Polymorphic Relationships Visualization</title>

    <style>
        body {
            font-family: monospace;
            background: #f8f9fa;
            padding: 40px;
        }

        h1 {
            margin-bottom: 30px;
        }

        .section {
            margin-bottom: 50px;
        }

        .card {
            background: white;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        .tree {
            margin-left: 20px;
        }

        .node {
            margin: 4px 0;
        }

        .type {
            color: #666;
        }

        .comment {
            color: #444;
        }

        .tag {
            color: #0a58ca;
        }

        hr {
            margin: 50px 0;
        }
    </style>

</head>

<body>

    <h1>Laravel Polymorphic Relationships – Visual Learning Page</h1>

    <hr>

    <div class="section">

        <h2>Products → Comments & Tags</h2>

        @foreach ($products as $product)
            <div class="card">

                <strong>Product:</strong> {{ $product->title }}

                <div class="tree">

                    @forelse($product->comments as $comment)
                        <div class="node comment">
                            ├─ Comment: "{{ $comment->comment }}"
                        </div>

                    @empty
                        <div class="node">├─ No comments</div>
                    @endforelse

                    @forelse($product->tags as $tag)
                        <div class="node tag">
                            └─ Tag: {{ $tag->name }}
                        </div>

                    @empty
                        <div class="node">└─ No tags</div>
                    @endforelse

                </div>

            </div>
        @endforeach

    </div>

    <hr>

    <div class="section">

        <h2>Articles → Comments & Tags</h2>

        @foreach ($articles as $article)
            <div class="card">

                <strong>Article:</strong> {{ $article->title }}

                <div class="tree">

                    @forelse($article->comments as $comment)
                        <div class="node comment">
                            ├─ Comment: "{{ $comment->comment }}"
                        </div>

                    @empty
                        <div class="node">├─ No comments</div>
                    @endforelse

                    @forelse($article->tags as $tag)
                        <div class="node tag">
                            └─ Tag: {{ $tag->name }}
                        </div>

                    @empty
                        <div class="node">└─ No tags</div>
                    @endforelse

                </div>

            </div>
        @endforeach

    </div>

    <hr>

    <div class="section">

        <h2>Tags → Related Models</h2>

        @foreach ($tags as $tag)
            <div class="card">

                <strong>Tag:</strong> {{ $tag->name }}

                <div class="tree">

                    @forelse($tag->products as $product)
                        <div class="node">
                            ├─ Product: {{ $product->title }}
                        </div>

                    @empty
                        <div class="node">├─ No products</div>
                    @endforelse

                    @forelse($tag->articles as $article)
                        <div class="node">
                            └─ Article: {{ $article->title }}
                        </div>

                    @empty
                        <div class="node">└─ No articles</div>
                    @endforelse

                </div>

            </div>
        @endforeach

    </div>

    <hr>

    <div class="section">

        <h2>Concept Summary</h2>

        <pre>
ONE TO MANY POLYMORPHIC

Product
  ├─ Comment
  └─ Comment

Article
  └─ Comment


MANY TO MANY POLYMORPHIC

Product
  └─ Tag

Article
  └─ Tag

Tag
  ├─ Product
  └─ Article
</pre>

    </div>

</body>

</html>
