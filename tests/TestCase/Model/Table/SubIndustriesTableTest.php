<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubIndustriesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubIndustriesTable Test Case
 */
class SubIndustriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SubIndustriesTable
     */
    protected $SubIndustries;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.SubIndustries',
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
        $config = $this->getTableLocator()->exists('SubIndustries') ? [] : ['className' => SubIndustriesTable::class];
        $this->SubIndustries = $this->getTableLocator()->get('SubIndustries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->SubIndustries);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SubIndustriesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\SubIndustriesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
