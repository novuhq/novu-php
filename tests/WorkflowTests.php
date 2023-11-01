<?php

namespace Tests;

use Novu\SDK\Novu;
use Novu\SDK\Resources\Workflow;
use PHPUnit\Framework\TestCase;

class WorkflowTests extends Testcase
{
    /**
     * @var \Novu\SDK\Novu
     */
    private $novu;

    protected function setUp(): void
    {
        $this->novu = new Novu([getenv('NOVU_API_KEY')]);
    }

    public function testCreateWorkflow()
    {
        $workflow = $this->novu->createWorkflow(
            [
                'name'                => 'Onboarding Workflow',
                'notificationGroupId' => '5f5f5f5f5f5f5f5f5f5f5f5f',
                'steps'               => [
                    [
                        'active'           => true,
                        'shouldStopOnFail' => false,
                        'uuid'             => '78ab8c72-46de-49e4-8464-257085960f9e',
                        'name'             => 'Chat',
                        'filters'          => [
                            [
                                'value'    => 'AND',
                                'children' => [
                                    [
                                        'field'    => '{{chatContent}}',
                                        'value'    => 'flag',
                                        'operator' => 'NOT_IN',
                                        'on'       => 'PAYLOAD',
                                    ],
                                ],
                            ],
                        ],
                        'template' => [
                            'type'      => 'chat',
                            'active'    => true,
                            'subject'   => '',
                            'variables' => [
                                [
                                    'name'     => 'chatContent',
                                    'type'     => 'STRING',
                                    'required' => true,
                                ],
                            ],
                            'content'     => '{{chatContent}}',
                            'contentType' => 'editor',
                        ],
                    ],
                ],
                'description' => 'Onboarding workflow to trigger after user sign up',
//                'active'      => true,
//                'draft'       => false,
//                'critical'    => false,
            ]
        );
        $this->assertNotNull($workflow->id);
        $this->assertEquals('Onboarding Workflow', $workflow->name);
        $this->assertEquals(false, $workflow->active);
        $this->assertEquals(true, $workflow->draft);
        $this->assertEquals(false, $workflow->critical);

        return $workflow;
    }

    /**
     * @depends testCreateWorkflow
     */
    public function testGetWorkflow(Workflow $workflow)
    {
        $workflow = $this->novu->getWorkflow($workflow->id);
        $this->assertNotNull($workflow->id);
        $this->assertEquals('Onboarding Workflow', $workflow->name);
        $this->assertFalse($workflow->active);
        $this->assertTrue($workflow->draft);
        $this->assertFalse($workflow->critical);

        return $workflow;
    }

    public function testGetWorkflows()
    {
        $workflows = $this->novu->getWorkflows();
        $this->assertNotNull($workflows);
    }

    /**
     * @depends testCreateWorkflow
     */
    public function testUpdateWorkflows(Workflow $workflow)
    {
        $workflow = $this->novu->updateWorkflow($workflow->id, [
            'name'                => 'Test Workflow',
            'active'              => true,
            'draft'               => false,
            'critical'            => false,
            'isBlueprint'         => false,
            'notificationGroupId' => '5f5f5f5f5f5f5f5f5f5f5f5f',
            'tags'                => ['test', 'test2'],
            'steps'               => [
                [
                    'type'      => 'email',
                    'name'      => 'test',
                    'email'     => 'test@test.com',
                    'active'    => true,
                ],
            ],
        ]);
        $this->assertNotNull($workflow->id);
        $this->assertEquals('Test Workflow', $workflow->name);
        $this->assertEquals(true, $workflow->active);
        $this->assertEquals(false, $workflow->draft);
        $this->assertEquals(false, $workflow->critical);
    }

    /**
     * @depends testCreateWorkflow
     */
    public function testUpdateWorkflowStatus(Workflow $workflow)
    {
        $workflow = $this->novu->updateWorkflowStatus($workflow->id, [
            'active'              => true,
            'draft'               => false,
            'critical'            => false,
        ]);
        $this->assertNotNull($workflow->id);
        $this->assertEquals('Test Workflow', $workflow->name);
        $this->assertTrue($workflow->active);
        $this->assertFalse($workflow->draft);
        $this->assertFalse($workflow->critical);
    }

    /**
     * @depends testCreateWorkflow
     */
    public function testDeleteWorkflow(Workflow $workflow)
    {
        $workflow = $this->novu->deleteWorkflow($workflow->id);
       $this->assertTrue($workflow);
    }
}
