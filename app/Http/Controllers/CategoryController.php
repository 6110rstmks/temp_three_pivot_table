<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::latest()->get();

        return view('index')
            ->with(['categories' => $categories]);
    }

    /**
     *
     */
    public function show(Category $category)
    {

        $categories = Category::latest()->get();

        return view('posts.show')
            ->with([
                'category' => $category,
                'categories' => $categories,
            ]);
    }

    public function store(CategoryRequest $request)
    {
        $authed_user = Auth::user();

        $category = new Category();

        $category->title = $request->title;

        $category->save();

        // categories()にエラーがでてるけどちゃんとうまくpivot tableに格納されてる。
        $authed_user->categories()->attach($category->id, ['recipe_id' => null]);

        return redirect()->route('categories.index');

        // return response()->json(['id' => Category::max('id')]);

    }

    /**
     * ajaxで実装できるはず。recipe一覧も非同期で実装する
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->title = $request->title;
        $category->save();
    }

    public function destroy(Category $category)
    {
        $authed_user = Auth::user();
        $authed_user->categories()->detach($category->id);
        $category->delete();

        // そもそも非同期で作成してたからここはおきるはずなかった。
        return redirect()
            ->route('categories.index');
    }

    public function purge()
    {
        // これが全削除ができるやつらしい
        DB::table('categories')->delete();

        // そもそも非同期で作成してたからここはおきるはずなかった。
        return redirect()
            ->route('categories.index');
    }
}
