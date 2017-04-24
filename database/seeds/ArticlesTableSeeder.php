<?php

use Illuminate\Database\Seeder;
use App\Article;
class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $article = new Article;

        $article->id = 1;
		$article->user_id = 4;
		$article->name = "Nike Shoes";
		$article->description = "Shoes from Nike";
		$article->quantity = 50;
		$article->sold_in_bulk = false;
		$article->sold_in_pieces = true;
		$article->unit = "piece";
		$article->type = "";
		$article->color = "red";

		$article->save();

		$article = new Article;
        $article->id = 2;
		$article->user_id = 4;
		$article->name = "Ice skating outfits";
		$article->description = "";
		$article->quantity = 50;
		$article->sold_in_bulk = false;
		$article->sold_in_pieces = true;
		$article->unit = "piece";
		$article->type = "";
		$article->color = "blue";

		$article->save();

    }
}
