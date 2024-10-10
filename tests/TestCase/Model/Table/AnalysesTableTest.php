<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AnalysesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AnalysesTable Test Case
 */
class AnalysesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AnalysesTable
     */
    protected $Analyses;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Analyses',
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
        $config = $this->getTableLocator()->exists('Analyses') ? [] : ['className' => AnalysesTable::class];
        $this->Analyses = $this->getTableLocator()->get('Analyses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Analyses);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AnalysesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
