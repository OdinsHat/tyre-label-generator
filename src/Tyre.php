<?php

namespace OdinsHat\EuTyreLabel;

/**
 * Undocumented class
 */
class Tyre
{
    protected $fuel;
    protected $wet;
    protected $noiseDb;
    protected $noiseClass;

    /**
     * Constructor for building a vehicle tyre that ca be consumed by the Label class
     * for generating labels. Accepts all variables used in EU tyre labels.
     *
     * @param string  $fuel         Fuel economy rating
     * @param string  $wet          Wet performance rating
     * @param integer $noiseDb      Noise level in decibels
     * @param integer $noiseClass   Noise classification
     */
    public function __construct(string $fuel, string $wet, int $noiseDb, int $noiseClass)
    {
        $this->fuel = $fuel;
        $this->wet = $wet;
        $this->noiseDb = $noiseDb;
        $this->noiseClass = $noiseClass;
    }

    /**
     * Get the value of fuel
     */ 
    public function getFuel()
    {
        return $this->fuel;
    }

    /**
     * Set the value of fuel
     *
     * @return  self
     */ 
    public function setFuel($fuel)
    {
        $this->fuel = $fuel;

        return $this;
    }

    /**
     * Get the value of wet
     */ 
    public function getWet()
    {
        return $this->wet;
    }

    /**
     * Set the value of wet
     *
     * @return  self
     */ 
    public function setWet($wet)
    {
        $this->wet = $wet;

        return $this;
    }

    /**
     * Get the value of noiseDb
     */ 
    public function getNoiseDb()
    {
        return $this->noiseDb;
    }

    /**
     * Set the value of noiseDb
     *
     * @return  self
     */ 
    public function setNoiseDb($noiseDb)
    {
        $this->noiseDb = $noiseDb;

        return $this;
    }

    /**
     * Get the value of noiseClass
     */ 
    public function getNoiseClass()
    {
        return $this->noiseClass;
    }

    /**
     * Set the value of noiseClass
     *
     * @return  self
     */ 
    public function setNoiseClass($noiseClass)
    {
        $this->noiseClass = $noiseClass;

        return $this;
    }
}
