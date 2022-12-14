<?php

namespace Recca0120\LaravelErdGo\Tests\Templates;

use Doctrine\DBAL\Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Recca0120\LaravelErdGo\ErdFinder;
use Recca0120\LaravelErdGo\Templates\DDL;
use Recca0120\LaravelErdGo\Tests\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

class DDLTest extends TestCase
{
    use RefreshDatabase;
    use MatchesSnapshots;

    protected function setUp(): void
    {
        parent::setUp();
        $this->template = new DDL();
    }

    /**
     * @throws Exception
     */
    public function test_find_er_model_in_directory(): void
    {
        $finder = $this->givenFinder();

        $this->assertMatchesSnapshot(
            $this->render($finder->find())
        );
    }

    private function givenFinder(): ErdFinder
    {
        return $this->app->make(ErdFinder::class)->in(__DIR__ . '/../fixtures');
    }

    private function render(Collection $results): string
    {
        return $this->template->render($results);
    }
}