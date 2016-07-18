<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CalculateTest extends TestCase
{
    /**
     * @test
     *
     * testing calculate result
     */
    public function testPostApi()
    {
        $response = $this->action('POST', 'CalculateController@calculate',[],
            ['firstNumber'=>3, 'secondNumber'=>6, 'calculateSymbol'=>'x']);
        $this->assertResponseStatus(200);
        $result = json_decode($response->getContent(), true);
        $this->assertEquals($result['result'], 4);

        $response = $this->action('POST', 'CalculateController@calculate',[],
            ['firstNumber'=>3, 'secondNumber'=>6, 'calculateSymbol'=>'+']);
        $this->assertResponseStatus(200);
        $result = json_decode($response->getContent(), true);
        $this->assertEquals($result['result'], 2);


        $response = $this->action('POST', 'CalculateController@calculate',[],
            ['firstNumber'=>3, 'secondNumber'=>6, 'calculateSymbol'=>'-']);
        $this->assertResponseStatus(200);
        $result = json_decode($response->getContent(), true);
        $this->assertEquals($result['result'], -3);

        //if the second number is null
        $response = $this->action('POST', 'CalculateController@calculate',[],
            ['firstNumber'=>3, 'secondNumber'=>null, 'calculateSymbol'=>'+']);
        $this->assertResponseStatus(200);
        $result = json_decode($response->getContent(), true);
        $this->assertEquals($result['result'], 3);


        $response = $this->action('POST', 'CalculateController@calculate',[],
            ['firstNumber'=>3, 'secondNumber'=>null, 'calculateSymbol'=>'x']);
        $this->assertResponseStatus(200);
        $result = json_decode($response->getContent(), true);
        $this->assertEquals($result['result'], 0);


        $response = $this->action('POST', 'CalculateController@calculate',[],
            ['firstNumber'=>3, 'secondNumber'=>0, 'calculateSymbol'=>'-']);
        $this->assertResponseStatus(200);
        $result = json_decode($response->getContent(), true);
        $this->assertEquals($result['result'], 3);
    }
}
