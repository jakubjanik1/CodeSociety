<?php

namespace Services;

use Cocur\Slugify\Slugify;
use Core\App;

class Slug
{
    public static function createSlug($title, $id = 0)
    {
        $slug = (new Slugify)->slugify($title);

        $allSlugs = self::getRelatedSlugs($slug, $id);

        if (! in_array($slug, $allSlugs))
        {
            return $slug;
        }

        for ($i = 1; $i <= 10; $i++)
        {
            $newSlug = "{$slug}-{$i}";
            if (! in_array($newSlug, $allSlugs))
            {
                return $newSlug;
            }
        }
    }   

    private static function getRelatedSlugs($slug, $id = 0)
    {
        return App::get('database')->table('article')
            ->whereRegexp('slug', "/$slug.*/")
            ->whereNot('id', $id)
            ->value('slug')
            ->get();
    }
}