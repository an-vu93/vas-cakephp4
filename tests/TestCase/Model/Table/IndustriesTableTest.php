<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IndustriesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IndustriesTable Test Case
 */
class IndustriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\IndustriesTable
     */
    protected $Industries;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Industries',
        'app.CustomerOrders',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Industries') ? [] : ['className' => IndustriesTable::class];
        $this->Industries = $this->getTableLocator()->get('Industries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Industries);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\IndustriesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
