<?php

namespace A1tem\KnowledgeBase\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 *
 * @package A1tem\KnowledgeBase\Models
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class BaseModel extends Model
{
    /**
     * BaseModel constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('knowledge-base.table_prefix') . $this->getTable());
    }
}
