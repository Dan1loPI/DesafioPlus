<?php
namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\ReservasBehavior;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\ReservasBehavior Test Case
 */
class ReservasBehaviorTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Behavior\ReservasBehavior
     */
    public $Reservas;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Reservas = new ReservasBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Reservas);

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
