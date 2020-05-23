<?php

namespace A1tem\KnowledgeBase\Tests;

use A1tem\KnowledgeBase\Models\Category;
use A1tem\KnowledgeBase\Models\Field;
use A1tem\KnowledgeBase\Requests\FieldRequest;

/**
 * Class CategoriesTest
 *
 * @package A1tem\KnowledgeBase\Tests
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class CategoriesTest extends TestCase
{
    /**
     * @return array of fields
     */
    public function fieldsDataProvider(): array
    {
        return [
            [
                Field::TYPE_TEXT, 'test text field', '', true, []
            ],
            [
                Field::TYPE_TEXT, 'test text field', 'default value', true, []
            ],
            [
                Field::TYPE_CHECKBOX, 'test checkbox field', '1', false, []
            ],
            [
                Field::TYPE_DATE, 'test date field', '', true, []
            ],
            [
                Field::TYPE_NUMBER, 'test number field', '5', false, []
            ],
            [
                Field::TYPE_TEXTAREA, 'test textarea field', 'default textarea text', false, []
            ],
            [
                Field::TYPE_SELECT, 'test select field', 'one', false, ['values' => ['one', 'two', 'three']]
            ],
        ];
    }

    /** @test */
    public function it_returns_correct_response_structure(): void
    {
        $this->signIn();

        create(Category::class, [], 5);

        $this->getJson(route('categories.get-all'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_can_create_a_category(): void
    {
        $this->signIn();

        $this->post(route('category.create', [
            'name' => 'test1',
        ]));

        $this->assertDatabaseHas(Category::getTableName(), [
            'name' => 'test1',
            'user_id' => $this->user->id
        ]);
    }

    /** @test */
    public function it_can_update_a_category(): void
    {
        $this->signIn();

        $category = create(Category::class, ['name' => 'test']);

        $this->put(route('category.update', [
            'category' => $category->id,
            'name' => 'test1',
        ]));

        $this->assertDatabaseHas(Category::getTableName(), [
            'name' => 'test1',
            'user_id' => $this->user->id
        ]);
    }

    /** @test */
    public function it_can_delete_a_category(): void
    {
        $this->signIn();

        $category = create(Category::class, ['name' => 'test']);

        $this->delete(route('category.delete', [
            'category' => $category->id,
        ]));

        $this->assertDatabaseMissing(Category::getTableName(), [
            'id' => $category->id
        ]);
    }

    /** @test */
    public function it_can_copy_a_category(): void
    {
        $this->signIn();

        $category = create(Category::class, ['name' => 'test']);

        $this->put(route('category.copy', [
            'category' => $category->id,
        ]))->assertStatus(200);

        $this->assertDatabaseHas(Category::getTableName(), [
            'name' => 'test copy'
        ]);

        $this->assertDatabaseHas(Category::getTableName(), [
            'name' => 'test'
        ]);
    }

    /**
     * @test
     * @dataProvider fieldsDataProvider
     *
     * @param string $fieldType
     * @param string $fieldLabel
     * @param string $defaultValue
     * @param bool $isRequired
     * @param array $metaData
     */
    public function it_can_add_text_field_to_category(
        string $fieldType,
        string $fieldLabel,
        string $defaultValue,
        bool $isRequired,
        array $metaData
        ): void
    {
        $this->signIn();

        $category = create(Category::class, ['name' => 'test']);

        $this->post(route('field.create', ['category' => $category->id]), [
            FieldRequest::FIELD_TYPE => $fieldType,
            FieldRequest::FIELD_LABEL => $fieldLabel,
            FieldRequest::FIELD_DEFAULT_VALUE => $defaultValue,
            FieldRequest::FIELD_IS_REQUIRED => $isRequired,
            FieldRequest::FIELD_META_DATA => $metaData,
        ])->assertStatus(200);

        $this->assertDatabaseHas(Field::getTableName(), [
            'category_id' => $category->id,
            'type' => $fieldType,
            'label' => $fieldLabel,
            'is_required' => $isRequired
        ]);
    }

    /** @test */
    public function it_can_update_category_field(): void
    {
        $field = create(Field::class, [
            FieldRequest::FIELD_TYPE => Field::TYPE_TEXT,
            FieldRequest::FIELD_LABEL => 'text',
            FieldRequest::FIELD_DEFAULT_VALUE => 'default value',
            FieldRequest::FIELD_IS_REQUIRED => true,
            FieldRequest::FIELD_META_DATA => [],
        ]);

        $this->put(route('field.update', ['field' => $field->id]), [
            FieldRequest::FIELD_TYPE => Field::TYPE_TEXT,
            FieldRequest::FIELD_LABEL => 'text updated',
            FieldRequest::FIELD_DEFAULT_VALUE => 'default value updated',
            FieldRequest::FIELD_IS_REQUIRED => false,
            FieldRequest::FIELD_META_DATA => [],
        ])->assertStatus(200);

        $this->assertDatabaseHas(Field::getTableName(), [
            'id' => $field->id,
            'type' => Field::TYPE_TEXT,
            'label' => 'text updated',
            'is_required' => false,
            'default_value' => 'default value updated'
        ]);
    }

    /** @test */
    public function it_can_delete_category_field(): void
    {
        $field = create(Field::class);

        $this->delete(route('field.delete', ['field' => $field->id]))
            ->assertStatus(200);

        $this->assertDatabaseMissing(Field::getTableName(), [
            'id' => $field->id
        ]);
    }
}
