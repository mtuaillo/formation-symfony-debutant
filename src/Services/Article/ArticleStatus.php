<?php

namespace App\Services\Article;

enum ArticleStatus: string
{
    case DRAFT = 'DRAFT';
    case PUBLISHED = 'PUBLISHED';
}
