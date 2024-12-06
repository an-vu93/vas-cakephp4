<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OricohSeriesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OricohSeriesTable Test Case
 */
class OricohSeriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OricohSeriesTable
     */
    protected $OricohSeries;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.OricohSeries',
        'app.ProductTypes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OricohSeries') ? [] : ['className' => OricohSeriesTable::class];
        $this->OricohSeries = $this->getTableLocator()->get('OricohSeries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->OricohSeries);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OricohSeriesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\OricohSeriesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
