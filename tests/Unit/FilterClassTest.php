<?php
namespace Tests\Unit;

use App\Contracts\Adapters\DataProviderXAdapterClass;
use App\Utilities\Filter\BalanceFilterClass;
use App\Utilities\Filter\CurrencyFilterClass;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class FilterClassTest extends TestCase
{
    protected $balanceClass;
    protected $currencyFilter;
    protected $collection;

    protected function setUp(): void
    {
        parent::setUp();
        $this->collection = new Collection([
            ['id' => 1, 'amount' => 100,'currency' => 'USD'],
            ['id' => 2, 'amount' => 200,'currency' => 'USD'],
            ['id' => 3, 'amount' => 300,'currency' => 'AED'],
            ['id' => 4, 'amount' => 400,'currency' => 'AED'],
        ]);

        $this->balanceClass = new BalanceFilterClass($this->collection);
        $this->currencyFilter = new CurrencyFilterClass($this->collection);

    }

    public function testHandleWithBalanceInRange()
    {
        $request = [
            'balanceMin' => 200,
            'balanceMax' => 300,
        ];

        $result = $this->balanceClass->handle($request);
        $this->assertCount(2, $result);
        $this->assertEquals([['id' => 2, 'amount' => 200,'currency' => 'USD'], ['id' => 3, 'amount' => 300,'currency' => 'AED']],
            array_values($result->toArray()));
    }

    public function testHandleWithEmptyBalanceRange()
    {
        $request = [];
        $result = $this->balanceClass->handle($request);

        $this->assertCount(4, $result);
        $this->assertEquals($this->collection->toArray(), array_values($result->toArray()));
    }

    public function testHandleWithCurrency()
    {

        $request = ['currency' => 'USD'];

        $result = $this->currencyFilter->handle($request);

        $this->assertCount(2, $result);
        $this->assertEquals([['id' => 1,'amount'=>100, 'currency' => 'USD'], ['id' => 2,'amount'=>200,'currency' => 'USD']], array_values($result->toArray()));
    }


}
