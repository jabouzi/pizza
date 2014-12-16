<?php

class Pizzaiterator implements Iterator
{
    private $pizzas;

    public function __construct($pizzas)
    {
        $this->pizzas = $pizzas;
    }

    public function rewind()
    {
        reset($this->pizzas);
    }
  
    public function current()
    {
        $pizza = current($this->pizzas);
        return $pizza;
    }
  
    public function key() 
    {
        $pizza = key($this->pizzas);
        return $pizza;
    }
  
    public function next() 
    {
        $pizza = next($this->pizzas);
        return $pizza;
    }
  
    public function valid()
    {
        $key = key($this->pizzas);
        $pizza = ($key !== NULL && $key !== FALSE);
        return $pizza;
    }
}
