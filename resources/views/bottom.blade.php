


<p class="move">
        <a href={{ route('article.list') }} class='btn btn-outline-primary'>一覧に戻る</a>
        <a href={{ route('article.edit', ["id" =>  $article->id]) }} class='btn btn-outline-primary'>編集</a>
        <a href={{ route('article.cancel', ["id" =>  $article->id]) }} class='btn btn-outline-primary'>取り消し</a>
        <a href={{ route('article.done', ["id" =>  $article->id]) }} class='btn btn-outline-primary'>記録</a>
        <a href={{ route('article.delete', ["id" =>  $article->id]) }} class='btn btn-outline-secondary'>削除</a>
</p>