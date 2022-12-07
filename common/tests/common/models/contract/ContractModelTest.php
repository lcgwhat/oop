<?php
/**
 * @author: liuchg
 *
 */

namespace common\models\contract;

use PHPUnit\Framework\TestCase;

class ContractModelTest extends TestCase
{

    public function testCreateOfficialContract()
    {
        $attrs = [
            "name" => "lisam",
            "money" => 12.3,
            "mobi" => 13444
        ];
        $res = ContractModel::createOfficialContract($attrs);
        $this->assertTrue(true, "duidui");
        var_dump($res);
        $this->assertArrayHasKey("params", $res);
    }
}
