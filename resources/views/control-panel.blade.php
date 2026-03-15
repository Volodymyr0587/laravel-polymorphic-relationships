<!DOCTYPE html>
<html>

<head>
    <title>Learning Control Panel</title>

    <style>
        body {
            font-family: monospace;
            padding: 40px;
            background: #f8f9fa;
        }

        .card {
            background: white;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 25px;
        }

        h2 {
            margin-top: 0;
        }

        input,
        select {
            padding: 6px;
            margin-top: 5px;
        }

        button {
            padding: 6px 10px;
        }

        a {
            display: inline-block;
            padding: 10px 15px;
            background: #0a58ca;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 30px;
        }

        a:hover {
            background: #084298;
        }
    </style>

</head>

<body>

    <h1>Polymorphic Relationships Control Panel</h1>

    <p>
        <a href="{{ url('/') }}">
            Back To Main Page
        </a>
    </p>

    {{-- Create Product --}}

    <div class="card">

        <h2>Create Product</h2>

        <form method="POST" action="/products">
            @csrf

            <input name="title" placeholder="Product title">
            <button>Create</button>

        </form>

    </div>

    {{-- Create Article --}}

    <div class="card">

        <h2>Create Article</h2>

        <form method="POST" action="/articles">
            @csrf

            <input name="title" placeholder="Article title">
            <button>Create</button>

        </form>

    </div>

    {{-- Create Tag --}}

    <div class="card">

        <h2>Create Tag</h2>

        <form method="POST" action="/tags">
            @csrf

            <input name="name" placeholder="Tag name">
            <button>Create</button>

        </form>

    </div>

    {{-- Create Comment --}}

    <div class="card">

        <h2>Add Comment</h2>

        <form method="POST" action="/comments">
            @csrf

            <input name="comment" placeholder="Comment">

            <br><br>

            <select name="type">
                <option value="product">Product</option>
                <option value="article">Article</option>
            </select>

            <select name="model_id">

                @foreach ($products as $product)
                    <option value="{{ $product->id }}">
                        Product: {{ $product->title }}
                    </option>
                @endforeach

                @foreach ($articles as $article)
                    <option value="{{ $article->id }}">
                        Article: {{ $article->title }}
                    </option>
                @endforeach

            </select>

            <button>Add Comment</button>

        </form>

    </div>

    <div class="card">

        <h2>All Comments</h2>

        <table border="1" cellpadding="6">

            <tr>
                <th>ID</th>
                <th>Comment</th>
                <th>Type</th>
                <th>Parent</th>
                <th>Action</th>
            </tr>

            @foreach ($comments as $comment)
                <tr>

                    <td>{{ $comment->id }}</td>

                    <td>{{ $comment->comment }}</td>

                    <td>{{ class_basename($comment->commentable_type) }}</td>

                    <td>{{ $comment->commentable->title ?? '-' }}</td>

                    <td>

                        <form method="POST" action="/comments/{{ $comment->id }}">
                            @csrf
                            @method('DELETE')

                            <button>Delete</button>

                        </form>

                    </td>

                </tr>
            @endforeach

        </table>

    </div>

    {{-- Attach Tag --}}

    <div class="card">

        <h2>Attach Tag</h2>

        <form method="POST" action="/attach-tag">
            @csrf

            <select name="tag_id">

                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">
                        {{ $tag->name }}
                    </option>
                @endforeach

            </select>

            <select name="type">
                <option value="product">Product</option>
                <option value="article">Article</option>
            </select>

            <select name="model_id">

                @foreach ($products as $product)
                    <option value="{{ $product->id }}">
                        Product: {{ $product->title }}
                    </option>
                @endforeach

                @foreach ($articles as $article)
                    <option value="{{ $article->id }}">
                        Article: {{ $article->title }}
                    </option>
                @endforeach

            </select>

            <button>Attach Tag</button>

        </form>

    </div>

    <div class="card">

        <h2>Detach Tag</h2>

        <form method="POST" action="/detach-tag">
            @csrf

            <select name="tag_id">

                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach

            </select>

            <select name="type">
                <option value="product">Product</option>
                <option value="article">Article</option>
            </select>

            <select name="model_id">

                @foreach ($products as $product)
                    <option value="{{ $product->id }}">
                        Product: {{ $product->title }}
                    </option>
                @endforeach

                @foreach ($articles as $article)
                    <option value="{{ $article->id }}">
                        Article: {{ $article->title }}
                    </option>
                @endforeach

            </select>

            <button>Detach Tag</button>

        </form>

    </div>

    <div class="card">

        <h2>Pivot Table: taggables</h2>

        <table border="1" cellpadding="6">

            <tr>
                <th>tag_id</th>
                <th>taggable_type</th>
                <th>taggable_id</th>
            </tr>

            @foreach ($taggables as $row)
                <tr>

                    <td>{{ $row->tag_id }}</td>

                    <td>{{ class_basename($row->taggable_type) }}</td>

                    <td>{{ $row->taggable_id }}</td>

                </tr>
            @endforeach

        </table>

    </div>

</body>

</html>
