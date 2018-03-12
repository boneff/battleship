<?php
/**
 * Created by PhpStorm.
 * User: boneff
 * Date: 3/12/18
 * Time: 12:31 AM
 */

namespace Battleships\Tests\Models;

use Battleships\Config\Config;
use Battleships\Models\Board;
use Battleships\Models\BoardGenerator;
use PHPUnit\Framework\TestCase;

class BoardGeneratorTest extends TestCase
{
    public function testGenerateBoard()
    {
        $mockConfig = $this->createMock(Config::class);
        $boardGenerator = new BoardGenerator($mockConfig);

        $this->assertInstanceOf(Board::class, $boardGenerator->generateBoard());
    }
}
