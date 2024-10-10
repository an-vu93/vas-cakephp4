<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IndicatorsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IndicatorsTable Test Case
 */
class IndicatorsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\IndicatorsTable
     */
    protected $Indicators;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Indicators',
        'app.IndicatorWeights',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Indicators') ? [] : ['className' => IndicatorsTable::class];
        $this->Indicators = $this->getTableLocator()->get('Indicators', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Indicators);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\IndicatorsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
