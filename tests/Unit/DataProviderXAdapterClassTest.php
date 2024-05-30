<?php
namespace Tests\Unit;

use App\Contracts\Adapters\DataProviderXAdapterClass;
use App\Utilities\Filter\BalanceFilterClass;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class DataProviderXAdapterClassTest extends TestCase
{

    protected $dataProvider;

    protected function setUp(): void
    {
        parent::setUp();
        $this->dataProvider = new DataProviderXAdapterClass();
    }


    public function testPrepareDataWithValidItem()
    {
        $item = (object)[
            'parentIdentification' => '123456',
            'parentEmail' => 'test@example.com',
            'parentAmount' => 500,
            'Currency' => 'USD',
            'statusCode' => 1,
            'registerationDate' => '2022-05-31',
        ];

        $result = $this->dataProvider->prepareData($item);

        $this->assertInstanceOf(\stdClass::class, $result);

        // Assert that the properties of the result match the expected values
        $this->assertEquals('123456', $result->id);
        $this->assertEquals('test@example.com', $result->email);
        $this->assertEquals(500, $result->amount);
        $this->assertEquals('USD', $result->currency);
        $this->assertEquals('authorised', $result->status);
        $this->assertEquals('2022-05-31', $result->created_at);
        $this->assertEquals('DataProviderX', $result->provider);


    }


}
