<?php

use PHPUnit\Framework\TestCase;
use App\Entity\Product;

class ProductTest extends TestCase
{
    public function testGetAndSetName()
    {
        $product = new Product();
        $name = "Test Product";

        $product->setName($name);
        $this->assertEquals($name, $product->getName());
    }

    public function testGetAndSetValue()
    {
        $product = new Product();
        $value = 100;

        $product->setValue($value);
        $this->assertEquals($value, $product->getValue());
    }

    public function testGetId()
    {
        $product = new Product();

        $reflectionClass = new \ReflectionClass($product);
        $property = $reflectionClass->getProperty('id');
        $property->setAccessible(true);

        $property->setValue($product, 1);
        $this->assertEquals(1, $product->getId());
    }
}
