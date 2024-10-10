<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IndicatorWeightsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IndicatorWeightsTable Test Case
 */
class IndicatorWeightsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\IndicatorWeightsTable
     */
    protected $IndicatorWeights;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.IndicatorWeights',
        'app.Analyses',
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
        $config = $this->getTableLocator()->exists('IndicatorWeights') ? [] : ['className' => IndicatorWeightsTable::class];
        $this->IndicatorWeights = $this->getTableLocator()->get('IndicatorWeights', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->IndicatorWeights);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\IndicatorWeightsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\IndicatorWeightsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
