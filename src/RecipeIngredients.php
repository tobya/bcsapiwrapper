<?php


namespace Bcsapi;


class RecipeIngredients extends Recipe
{



    public function RecipeIngredients($RecipeID)
    {
        //$apipath = '/{apikey}/list/ingredients/{list}';
        $apipath = '/recipe/ingredients/{recipe_id}';
        $APIFields = ['{recipe_id}' => $RecipeID];
        return $this->CallAPI($apipath, $APIFields);
    }


    public function RecipeListIngredients($PathID)
    {
        $apipath = '/{apikey}/list/ingredients/{path_id}';

        $APIFields = ['{path_id}' => $PathID];
        return $this->CallAPI($apipath, $APIFields);
    }



}

