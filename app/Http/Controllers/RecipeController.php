<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Support\Facades\Log;

class RecipeController extends Controller
{

    public function list()
    {
        // $recipes = Task::latest()->get();
        $recipes = Recipe::paginate(2);

        return view('recipe')
            ->with(['recipes' => $recipes]);
    }

    /**
     * save a recipe and sync it with a post
     */
    public function store(Request $request, Category $category)
    {
        // countermeasure for multiple submission

        $request->session()->regenerateToken();

        $request->validate([
            'body' => 'required',
        ]);

        $recipe = new Recipe();

        $recipe->body = $request->body;

        $recipe->save();

        // https://laravel.com/docs/9.x/eloquent-relationships#inserting-and-updating-related-models
        // 変わりにこれを使うのもよさげ

        $category->recipes()->syncWithoutDetaching($recipe->id);

        return redirect()
            ->route('posts.show', $category);
    }

    /**
     *
     */
    public function destroy(Recipe $recipe)
    {

        // $recipe->postsをデバッグを使用してなんとかidをrouteに渡せたけども
        // これは正規のやり方ではないはず。
        //　正しいやり方はまた後で調べます。

        $aaa = $recipe->posts[0]->id;

        $recipe->delete();

        Log::debug($aaa);

        return redirect()
            ->route('posts.show', $aaa);

    }
}
