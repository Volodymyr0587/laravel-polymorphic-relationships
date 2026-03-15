<!DOCTYPE html>
<html>

<head>
    <title>Laravel Polymorphic Relationships - Learning Page</title>
    <style>
        body {
            background-color: lightblue;
        }

        h1 {
            color: navy;
        }
    </style>
</head>

<body>

    <h1>Laravel Polymorphic Relationships (One To Many)</h1>

    <hr>

    <h2>Database Structure</h2>

    <h3>products</h3>
    <ul>
        <li>id</li>
        <li>title</li>
    </ul>

    <h3>articles</h3>
    <ul>
        <li>id</li>
        <li>title</li>
    </ul>

    <h3>comments</h3>
    <ul>
        <li>id</li>
        <li>comment</li>
        <li>commentable_id</li>
        <li>commentable_type</li>
    </ul>

    <p>
        Both <strong>Product</strong> and <strong>Article</strong> can have comments using the same table.
    </p>

    <hr>

    <h2>Products → Comments</h2>

    @foreach ($products as $product)
        <div style="margin-bottom:20px">

            <strong>Product:</strong> {{ $product->title }}

            <br>
            <strong>Comments:</strong>

            <ul>
                @forelse ($product->comments as $comment)
                    <li>
                        {{ $comment->comment }}

                        <br>

                        <small>
                            commentable_type: {{ $comment->commentable_type }}
                            |
                            commentable_id: {{ $comment->commentable_id }}
                        </small>
                    </li>

                @empty
                    <li>No comments</li>
                @endforelse
            </ul>

        </div>
    @endforeach


    <hr>

    <h2>Articles → Comments</h2>

    @foreach ($articles as $article)
        <div style="margin-bottom:20px">

            <strong>Article:</strong> {{ $article->title }}

            <br>
            <strong>Comments:</strong>

            <ul>
                @forelse ($article->comments as $comment)
                    <li>
                        {{ $comment->comment }}

                        <br>

                        <small>
                            commentable_type: {{ $comment->commentable_type }}
                            |
                            commentable_id: {{ $comment->commentable_id }}
                        </small>
                    </li>

                @empty
                    <li>No comments</li>
                @endforelse
            </ul>

        </div>
    @endforeach


    <hr>

    <h2>All Comments → Parent Model (commentable)</h2>

    <table border="1" cellpadding="6">

        <tr>
            <th>Comment</th>
            <th>Type</th>
            <th>ID</th>
            <th>Parent Title</th>
        </tr>

        @foreach ($comments as $comment)
            <tr>
                <td>{{ $comment->comment }}</td>

                <td>{{ class_basename($comment->commentable_type) }}</td>

                <td>{{ $comment->commentable_id }}</td>

                <td>
                    {{ $comment->commentable->title ?? 'N/A' }}
                </td>
            </tr>
        @endforeach

    </table>

    <hr>

    <h2>Relationship Explanation</h2>

    <p><strong>Product model</strong></p>

    <pre>
public function comments()
{
    return $this->morphMany(Comment::class, 'commentable');
}
</pre>

    <p><strong>Article model</strong></p>

    <pre>
public function comments()
{
    return $this->morphMany(Comment::class, 'commentable');
}
</pre>

    <p><strong>Comment model</strong></p>

    <pre>
public function commentable()
{
    return $this->morphTo();
}
</pre>

    <hr>

    <h2>How Laravel stores polymorphic relationships</h2>

    <p>
        Instead of storing <code>product_id</code> or <code>article_id</code>, Laravel stores:
    </p>

    <ul>
        <li><strong>commentable_id</strong> → id of the parent</li>
        <li><strong>commentable_type</strong> → model class name</li>
    </ul>

    <p>Example records:</p>

    <pre>
id | comment           | commentable_id | commentable_type
---------------------------------------------------------
1  | Great product     | 1              | App\Models\Product
2  | Helpful article   | 2              | App\Models\Article
</pre>

</body>

</html>
