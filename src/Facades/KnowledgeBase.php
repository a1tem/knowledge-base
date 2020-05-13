<?php

namespace A1tem\KnowledgeBase\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class KnowledgeBase
 *
 * @package A1tem\KnowledgeBase\Facades
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class KnowledgeBase extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'knowledge-base';
    }
}
