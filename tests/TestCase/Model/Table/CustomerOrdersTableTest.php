<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustomerOrdersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomerOrdersTable Test Case
 */
class CustomerOrdersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CustomerOrdersTable
     */
    protected $CustomerOrders;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.CustomerOrders',
        'app.Customers',
        'app.ProductTypes',
        'app.Industries',
        'app.SubIndustries',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CustomerOrders') ? [] : ['className' => CustomerOrdersTable::class];
        $this->CustomerOrders = $this->getTableLocator()->get('CustomerOrders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CustomerOrders);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CustomerOrdersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CustomerOrdersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
