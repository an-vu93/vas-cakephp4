<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustomerScoresTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomerScoresTable Test Case
 */
class CustomerScoresTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CustomerScoresTable
     */
    protected $CustomerScores;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.CustomerScores',
        'app.Customers',
        'app.Indicators',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CustomerScores') ? [] : ['className' => CustomerScoresTable::class];
        $this->CustomerScores = $this->getTableLocator()->get('CustomerScores', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CustomerScores);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CustomerScoresTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CustomerScoresTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
