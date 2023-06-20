<?php

declare(strict_types = 1);

namespace BristolianTest\DataType;

use Bristolian\DataType\Migration;
use VarMap\ArrayVarMap;
use BristolianTest\BaseTestCase;

/**
 * @coversNothing
 */
class MigrationTest extends BaseTestCase
{
    /**
     * @group wip
     * @covers \Bristolian\DataType\Migration
     */
    public function testWorks()
    {
        $unique = date("Ymdhis").uniqid();

        $id = 12;
        $description = 'this is a description ' . $unique;
         $checksum ="f2f0f464ae13c9d7835f16088d8eef8b67ae21f982227605f7883a9836ae861f";
         $created_at = "2023-05-24 11:29:37" ;

        $data = [ 
            'id' => $id,
            'description' => $description,
            'checksum' => $checksum,
            'created_at'=> $created_at,
        ];

        $Migration = Migration::createFromArray(($data));

        $this->assertSame($id, $Migration->id);
        $this->assertSame($description, $Migration->description);
     $this->assertSame($checksum, $Migration->checksum);
        $this->assertSame($created_at,$Migration->created_at->format('Y-m-d H:i:s'));


    }

    } 

