<?php
namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\MesasBehavior;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\MesasBehavior Test Case
 */
class MesasBehaviorTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Behavior\MesasBehavior
     */
    public $Mesas;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Mesas = new MesasBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Mesas);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
