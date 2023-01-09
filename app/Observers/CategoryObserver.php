<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function creating(Category $category)
    {
        /*$category->slug = Str::slug($category->name, '-', 'ru');

        $category->save();*/
        /*DB::table('categories')
            ->where('id', '=', $category->id)
            ->update([
                'slug' => Str::slug($category->name, '-', 'ru'),
            ]);*/
        $category->slug = Str::slug($category->name, '-', 'ru');

        //$category->save();
    }

    /**
     * Handle the Category "updated" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function updating(Category $category)
    {
        $category->slug = Str::slug($category->name, '-', 'ru');

        //$category->save();
    }

    public function updated(Category $category)
    {
        dd($category);
    }

    /**
     * Handle the Category "deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
