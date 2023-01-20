When doing CRUD across multiple pages like this time,
implementing ajax with vanilla js without vue.js will be full of bugs.
So I don't implement ajax in laravel-recipehouse.

## about database
a pivot table is composite key(category_id, recipe_id, user_id)
I dared to configure db without foreign key constraint.

## functional requirement

pagination
many-to-many(user-category-recipe)

レシピ一覧リストにおいて、ajaxのdeleteができる（☓ボタンが表示される）（自分が作成したレシピの場合）
管理者の場合、pruneができる。

レシピ一覧リストからカテゴリを選択してレシピをajaxで追加することができる。（ログイン時のみレシピを登録できるようにする）

