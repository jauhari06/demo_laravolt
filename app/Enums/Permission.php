<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @extends Enum<string>
 */
final class Permission extends Enum
{
    

    // Permissions untuk News
    const NEWS_VIEW   = 'news.view';   
    const NEWS_CREATE = 'news.create'; 
    const NEWS_EDIT   = 'news.edit'; 
    const NEWS_EDIT_OWN = 'news.edit-own';  
    const NEWS_DELETE = 'news.delete'; 
    const NEWS_PUBLISH= 'news.publish';
    const NEWS_FLAG   = 'news.flag';

    // Permissions untuk Topics
    const TOPIC_VIEW   = 'topic.view';
    const TOPIC_CREATE = 'topic.create';
    const TOPIC_EDIT   = 'topic.edit';
    const TOPIC_DELETE = 'topic.delete';
}
