<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Footer extends Composer
{
    protected static $views = [
        'partials.footer',
        'sections.footer',
    ];

    public function with(): array
    {
        $bottom = get_field('bottom', 'option') ?: [];

        $title    = $bottom['title'] ?? '';

        // obraz może być tablicą (return_format=array) albo stringiem (url)
        $img      = $bottom['image'] ?? null;
        $imageUrl = is_array($img) ? ($img['url'] ?? '') : (is_string($img) ? $img : '');
        $imageAlt = is_array($img) ? ($img['alt'] ?? '') : '';

        return compact(
            'bottom',
            'title',
            'imageUrl',
            'imageAlt',
        );
    }
}
